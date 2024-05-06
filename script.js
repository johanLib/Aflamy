//Initial References
let movieNameRef = document.getElementById("movie-name");
let searchBtn = document.getElementById("search-btn");
let result = document.getElementById("result");
let avatarBtn = document.querySelector('.avatar-container button');
let favoriteBtn, statusBtn, ratingBtn;
let statusContainer, ratingContainer, span;
let stars, ratingNumber, ratingDescriptor;
let poster, movieName, title, rating;
let selectedRating = -1;

//Function to fetch data from API
let getMovie = () => {
  movieName = movieNameRef.value;
  let url = `http://www.omdbapi.com/?t=${movieName}&plot=full&apikey=${key}`;
  //If input field is empty
  if (movieName.length <= 0) {
    result.innerHTML = `<h3 class="msg">Please Enter A Movie Name</h3>`;
  }
  //If input field is NOT empty
  else {
    fetch(url)
      .then((resp) => resp.json())
      .then((data) => {
        //If movie exists in database
        if (data.Response == "True") {
          poster = data.Poster;
          title = data.Title;
          rating = data.imdbRating;
          result.innerHTML = `
            <div class="info">
                <img src=${data.Poster} class="poster" id="poster">
                <div>
                    <div class="btns">
                      <button class="list_btn" id="favorite-btn">Favotite</button>
                      <button class="list_btn" id="status-btn">Status</button>
                      <div id="checkboxContainer" class="modal">
                        <div class="modal-content">
                          <div class="modal-header">      
                            <span class="header-title">Status</span class="header-title">
                            <i class="fa-solid fa-xmark close"></i>
                          </div>
                          <div class="checkbox-group">
                            <label><input type="checkbox" value="Watching"><span class="label-text">Watching</span></label>
                            <label><input type="checkbox" value="Completed"><span class="label-text">Completed</span></label>
                            <label><input type="checkbox" value="On Hold"><span class="label-text">On-Hold</span></label>
                            <label><input type="checkbox" value="Dropped"><span class="label-text">Dropped</span></label>
                            <label><input type="checkbox" value="To Watch"><span class="label-text">To Watch</span></label>
                          </div>
                        </div>
                      </div>
                      <button class="list_btn" id="rating-btn">Rating</button>
                      <div id="ratingContainer" class="modal">
                        <div class="rating-modal">
                          <div class="rating-container">
                              <i class='bx bxs-star'></i>
                              <span class="rating-number">?</span>
                          </div>          
                          <i class="fa-solid fa-xmark rating-close"></i>
                          <h4 class="rating-title">Rate this</h4>
                          <p class="rating-text">Not Rated</p>
                          <div class="stars" id="stars">
                            <i class="fa-regular fa-star" data-index="1"></i>
                            <i class="fa-regular fa-star" data-index="2"></i>
                            <i class="fa-regular fa-star" data-index="3"></i>
                            <i class="fa-regular fa-star" data-index="4"></i>
                            <i class="fa-regular fa-star" data-index="5"></i>
                            <i class="fa-regular fa-star" data-index="6"></i>
                            <i class="fa-regular fa-star" data-index="7"></i>
                            <i class="fa-regular fa-star" data-index="8"></i>
                            <i class="fa-regular fa-star" data-index="9"></i>
                            <i class="fa-regular fa-star" data-index="10"></i>
                          </div>
                          <button id="rate-btn">Rate</button>
                        </div>
                      </div>
                    </div>
                    <h2 id="movie-name">${data.Title}</h2>
                    <div class="rating">
                        <img src="images/star-icon.svg">
                        <h4 id="rating-number">${data.imdbRating}</h4>
                    </div>
                    <div class="details">
                        <span>${data.Rated}</span>
                        <span>${data.Year}</span>
                        <span>${data.Runtime}</span>
                    </div>
                    <div class="genre">
                        <div>${data.Genre.split(",").join("</div><div>")}</div>
                    </div>
                </div>
            </div>
            <div class="plot-container">
              <h3 class="plot-title">Plot</h3>
              <div class="plot-content">${data.Plot}</div>
            </div>
            <div class="plot-container">
              <h3 class="plot-title">Cast</h3>
              <div class="plot-content">${data.Actors}</div>
            </div>           
        `;
          favoriteBtn = document.getElementById('favorite-btn');
          statusBtn = document.getElementById('status-btn');
          span = document.getElementsByClassName("close")[0];
          statusContainer = document.getElementById('checkboxContainer');
          ratingContainer = document.getElementById('ratingContainer');
          stars = document.querySelectorAll('.stars i');
          ratingNumber = document.querySelector('.rating-number');
          ratingDescriptor = document.querySelector('.rating-text');
          ratingBtn = document.getElementById('rating-btn');
          favoriteBtn.addEventListener("click", addToFavorites);
          statusBtn.onclick = function() {
            statusContainer.style.display = "block";
          }
          span.onclick = function() {
            statusContainer.style.display = "none";
          }
          window.onclick = function(event) {
            if (event.target == statusContainer) {
              let checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
              let selectedOptions = [];
              checkboxes.forEach(function(checkbox) { 
                selectedOptions.push(checkbox.value);
              });
              const infos = {
                user_id: userId,
                poster: poster,
                title: data.Title,
                rating: data.imdbRating,
                options: selectedOptions
              }
              console.log(infos.options);
              fetch("php/insert_status.php", {
                method: "POST",
                headers: {
                  "content-Type": "application/json"
                },
                body: JSON.stringify(infos)
              })
              .then(response => response.json())
              .then((response) => {
                let toast = document.createElement('div');
                toast.classList.add('toast');
                if(response.status === "success") {
                  toast.innerHTML = '<i class="fa-solid fa-circle-check"></i>Added Status Successfully!';
                }
                else if(response.status === "duplicate"){
                  toast.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i>${response.message}`;
                  toast.classList.add('invalid');
                }
                else if(response.status === "empty"){
                  toast.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i>${response.message}`;
                  toast.classList.add('invalid');
                }
                else {
                  toast.innerHTML = `<i class="fa-solid fa-circle-xmark"></i>${response.message}`;
                  toast.classList.add('error');
                }
                toastbox.appendChild(toast);
                setTimeout(() => {
                  toast.remove();
                }, 3000);
              })
              .catch(error => {
                console.error("Error:" + error);
              })
              statusContainer.style.display = "none";
            }
          }
          ratingBtn.onclick = function() {
            ratingContainer.style.display = "block";
          }
          stars.forEach((star, index) => {
            star.addEventListener('mouseover', () => {
              resetStars(index);
              highlightStars(index);
          
            });
            star.addEventListener('mouseout', () => {
              resetStars(selectedRating);
              highlightStars(selectedRating);
            });
            star.addEventListener('click', () => {
              resetStars(index);
              selectedRating = index;
              highlightStars(selectedRating);
              ratingNumber.textContent = `${selectedRating + 1}`;
              ratingLabel(selectedRating + 1);
            });
          });
          
          function highlightStars(index) {
            stars.forEach((star, i) => {
              if (i <= index) {
                star.classList.add('active');
                star.classList.add('fa-solid');
              }
            });
          }
          
          function resetStars(index) {
            stars.forEach((star, i) => {
              if (i > index) {
                star.classList.remove('active');
                if (star.classList.contains('fa-solid')) {
                  star.classList.remove('fa-solid');
                }
              }
            });
          }
          
          function ratingLabel(rating) {
            switch(rating) {
              case 1:
                ratingDescriptor.textContent = "Terrible";
                break;
              case 2:
                ratingDescriptor.textContent = "Very Bad";
                break;
              case 3:
                ratingDescriptor.textContent = "Bad";
                break;
              case 4:
                ratingDescriptor.textContent = "Poor";
                break;
              case 5:
                ratingDescriptor.textContent = "Average";
                break;
              case 6:
                ratingDescriptor.textContent = "Fair";
                break;
              case 7:
                ratingDescriptor.textContent = "Good";
                break;
              case 8:
                ratingDescriptor.textContent = "Very Good";
                break;
              case 9:
                ratingDescriptor.textContent = "Excellent";
                break;
              case 10:
                ratingDescriptor.textContent = "Masterpiece";
                break;
              default:
                ratingDescriptor.textContent = "Not Rated";
                break;
            }
          }

          document.getElementsByClassName("rating-close")[0].onclick = function() {
            ratingContainer.style.display = "none";
          };
          
          document.getElementById('rate-btn').addEventListener('click', () => {
            const ratedStars = document.querySelectorAll('.stars i.active').length;
            const infos = {
              user_id: userId,
              title: data.Title,
              rating: ratedStars
            }
            console.log(infos.user_id + "\n" + infos.title + "\n" + infos.rating);
            fetch("php/edit_rating.php", {
                method: "POST",
                headers: {
                  "content-Type": "application/json"
                },
                body: JSON.stringify(infos)
              })
              .then((response) => response.json())
              .then((response) => {
                let toast = document.createElement('div');
                toast.classList.add('toast');
                if(response.status === "success") {
                  toast.innerHTML = '<i class="fa-solid fa-circle-check"></i>Rated Successfully!';
                }
                else if(response.status === "notWatched") {
                  toast.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i>${response.message}`;
                  toast.classList.add('invalid');
                }
                else {
                  toast.innerHTML = `<i class="fa-solid fa-circle-xmark"></i>${response.message}`;
                  toast.classList.add('error');
                }
                toastbox.appendChild(toast);
                setTimeout(() => {
                  toast.remove();
                }, 3000);
              })
              .catch(error => {
                console.error("Error:" + error);
              })
            ratingContainer.style.display = "none";
          });

        }
        else {
          result.innerHTML = `<h3 class='msg'>${data.Error}</h3>`;
        }
      })
      .catch(() => {
        result.innerHTML = `<h3 class="msg">Error Occured</h3>`;
      });
  }
};
const toastbox = document.getElementById('alert-box');
function addToFavorites() {
  favoriteBtn.classList.add('clicked');
  let data = {
      user_id: userId,
      poster: poster,
      title: title,
      rating: rating
  };

  // Send data to PHP backend
  fetch('php/insert_favorite.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
  })
  .then((response) => response.json())
  .then(data => {
    let toast = document.createElement('div');
    toast.classList.add('toast');
    if(data.status == "success") {
      toast.innerHTML = '<i class="fa-solid fa-circle-check"></i> Successfully Added';
    }
    else if(data.status = "duplicate") {
      toast.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> ${data.message}`;
      toast.classList.add('invalid');
    }
    else {
      toast.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Error adding movie to favorites. Please try again.';
      toast.classList.add('error');
      //alert("Error's Message: " + data.message);
    }
    toastbox.appendChild(toast);
    setTimeout(() => {
      toast.remove();
    }, 3000);
  })
  .catch(error => {
      console.error('Error:', error);
  });
}

let avatarPanel = document.getElementById('avatar-panel');

searchBtn.addEventListener("click", getMovie);
movieNameRef.addEventListener('keypress', function(event) {
  if(event.keyCode === 13) {
    getMovie();
  }
});
avatarBtn.onclick = (event) => {
  event.stopPropagation();
  if (avatarPanel.style.display === 'flex') {
    avatarPanel.style.display = 'none';
  } else {
    avatarPanel.style.display = 'flex';
  }
}
document.addEventListener('click', function(event) {
  if (!avatarPanel.contains(event.target) && event.target !== avatarBtn) {
    avatarPanel.style.display = 'none';
  }
});
window.addEventListener("load", getMovie);


