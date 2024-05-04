<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/style.css">
    <title>Aflamy</title>
    <meta name="author" content="Anass Seghir">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="keywords" content="HTML, CSS, Sass JavaScript, jQuery, PHP, SEO, frontend, Backend, FullStack Develpment, login, signin, signup, user infos">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="description" content="this is a login & register system designed to store the user's informations">
    <link rel="icon" type="image/svg" sizes="32x32" href="./images/favicon-32x32.svg">
    <link rel="manifest" href="manifest.json">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/823a574c14.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body class="home">
    <div class="nav">

        <div class="logo">
            <img src="images/colored_whale_logo.png" alt="logo">
        </div>

        <div class="toggle">
            <button id="btn-toggle"><i class="fa-solid fa-bars"></i></button>
        </div>

        <div class="right-links">
            <a href="home.php" style="color: #763BC9;">Home</a>
            <a href="status/watching.php">Watching</a>
            <a href="status/completed.php">Completed</a>
            <a href="status/onHold.php">On-Hold</a>
            <a href="status/dropped.php">Dropped</a>
            <a href="status/towatch.php">To Watch</a>
        </div>

        <div class="avatar-container">
            <button><img src="images/madara.jpg" alt="avatar"></button>
            <div id="avatar-panel" class="avatarPanel">
                <div class="user-options">
                    <a href="edit.php" style="margin-bottom: 0;"><i class="fa-regular fa-user"></i>Update</a>
                    <a href="status/favorites.php"><i class="fa-regular fa-heart"></i>Favorites</a>
                </div>
                <div class="logout-option">
                    <a href="php/logout.php"><i class="fa-solid fa-right-from-bracket"></i>LogOut</a>
                </div>
            </div>
        </div>

    </div>
    <main>

        <div class="main-container">
            <div class="search-container">
                <input
                type="text"
                placeholder="Enter movie name here..."
                id="movie-name"
                value="dark knight"
                />
                <button id="search-btn">Search</button>
            </div>
            <div id="result"></div>
            <div id="alert-box"></div>
        </div>

    </main>
    <script src="key.js"></script>
    <script>
        var userId = <?php echo $_SESSION['id']; ?>;
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
    <script defer src="./script.js"></script>
</body>
</html>