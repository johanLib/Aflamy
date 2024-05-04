<?php
   session_start();

    include("../php/config.php");
    if(!isset($_SESSION['valid'])){
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/823a574c14.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.12/lottie.min.js"></script>
    <title>Dropped</title>
    <link rel="stylesheet" href="../dist/style.css">
    <link rel="icon" type="image/svg" sizes="32x32" href="../images/favicon-32x32.svg">
</head>
<body style="background-color: #f5f5fe;">
    <img class="bg-bottom" src="../images/bg-bottom.svg" alt="bg-bottom">
    <img class="bg-top" src="../images/bg-top.svg" alt="bg-top">
    <div class="nav">

    <div class="logo">
        <img src="../images/colored_whale_logo.png" alt="logo">
    </div>

    <div class="toggle">
        <button id="btn-toggle"><i class="fa-solid fa-bars"></i></button>
    </div>

    <div class="right-links">
        <a href="../home.php">Home</a>
        <a href="watching.php">Watching</a>
        <a href="completed.php">Completed</a>
        <a href="onHold.php">On-Hold</a>
        <a href="dropped.php" style="color: #763BC9;">Dropped</a>
        <a href="towatch.php">To Watch</a>
    </div>

        <div class="avatar-container">
            <button><img src="../images/madara.jpg" alt="avatar"></button>
            <div id="avatar-panel" class="avatarPanel">
                <div class="user-options">
                    <a href="../edit.php" style="margin-bottom: 0;"><i class="fa-regular fa-user"></i>Update</a>
                    <a href="favorites.php"><i class="fa-regular fa-heart"></i>Favorites</a>
                </div>
                <div class="logout-option">
                    <a href="../php/logout.php"><i class="fa-solid fa-right-from-bracket"></i>LogOut</a>
                </div>
            </div>
        </div>
    </div>
    <main style="margin: 5rem 0; text-align: center;">
        <h1 id="heading-title" style="margin-bottom: 1.5em;">Dropped List</h1>
        <div class="movies-container">
            <?php
                $user_id = $_SESSION['id'];
                $movies = "SELECT Poster, Title, Rating FROM dropped WHERE user_id = '$user_id'";
                $result = mysqli_query($con, $movies);
                if(mysqli_num_rows($result) > 0) {
                    $poster = "";
                    $title = "";
                    $rating = "";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $poster = $row['Poster'];
                        $title = $row['Title'];
                        $rating = $row['Rating'];
                        $formattedRating = ($rating == intval($rating)) ? intval($rating) : number_format($rating, 1);

                        echo "<div class='movie-container'>
                                <div class='remove-movie'><i class='fa-solid fa-xmark close'></i></div>
                                <img src='$poster' alt='$title' />
                                <span class='movie-title'>$title</span>
                                <div class='rating-movie'>$formattedRating</div>
                              </div>";
                    }
                }

            ?>
        </div>
    </main>
    <script>
        var userId = <?php echo $user_id; ?>;
        const btnToggle = document.getElementById('btn-toggle'),
        navHome = document.querySelector('.right-links');
        btnToggle.addEventListener('click', () => {
        btnToggle.childNodes[0].classList.toggle('fa-xmark');
        if (navHome.style.top !== "65px") {
            navHome.style.top = "65px";
        } else {
            navHome.style.top = "-500px";
        }
        })
    </script>
    <script src="../avatar-edit.js"></script>
    <script src="../remove-movie.js"></script>
    <script src="../msg-animation.js"></script>
</body>
</html>