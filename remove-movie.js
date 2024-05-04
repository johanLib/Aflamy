const moviesContainer = document.querySelector('.movies-container');
const tableName = document.getElementById('heading-title').textContent.replace(" List", "").toLowerCase().replaceAll(/\s/g, "");
const nothingFoundMessage = document.querySelector('.msg');

if (moviesContainer && moviesContainer.children.length > 0 && !nothingFoundMessage) {
    moviesContainer.addEventListener('click', function(event) {
        const removeButton = event.target.closest('.remove-movie');
        console.log(removeButton)
        if (removeButton) {
            const movieTitle = removeButton.nextElementSibling.getAttribute('alt');
            console.log(movieTitle);
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../php/remove_movie.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            removeButton.parentNode.remove();
                        } else {
                            console.error('Error:', response.message);
                        }
                    } catch (error) {
                        console.error('Error parsing server response:', error);
                    }
                } else {
                    console.error('Server responded with status:', xhr.status);
                }
            };
            xhr.onerror = function() {
                console.error('Error sending request to the server.');
            };
            xhr.send(`title=${encodeURIComponent(movieTitle)}&tableName=${encodeURIComponent(tableName)}&user_id=${encodeURIComponent(userId)}`);
        }
    });
} else if (moviesContainer && moviesContainer.children.length === 0) {
    moviesContainer.innerHTML = `<div class='msg'>
                                    <p>Nothing Found!</p>
                                    <div id='animation-container' class='animation-container'></div>
                                </div>`;
}
