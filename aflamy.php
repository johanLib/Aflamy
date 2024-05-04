<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aflamy</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="icon" type="image/svg" sizes="32x32" href="./images/favicon-32x32.svg">
    <script src="https://kit.fontawesome.com/823a574c14.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="toggle.js" defer></script>
</head>
<body>

    <header class="header" id="header">
        <nav class="nav container">
           <img class="nav__logo" src="images/logo.png" alt="logo"/>

           <div class="nav__menu" id="nav-menu">
              <ul class="nav__list">
                 <li class="nav__item">
                    <a href="#" class="nav__link">Home</a>
                 </li>

                 <li class="nav__item">
                    <a href="#" class="nav__link">About Us</a>
                 </li>

                 <li class="nav__item">
                    <a href="#" class="nav__link">Services</a>
                 </li>

                 <li class="nav__item">
                    <a href="#" class="nav__link">Featured</a>
                 </li>

                 <li class="nav__item">
                    <a href="#" class="nav__link">Contact Me</a>
                 </li>
              </ul>

              <!-- Close button -->
              <div class="nav__close" id="nav-close">
                <i class="fa-solid fa-xmark"></i>
              </div>
           </div>

           <div class="nav__actions">
              <!-- Toggle button -->
              <div class="nav__toggle" id="nav-toggle">
                <i class="fa-solid fa-bars"></i>
              </div>
           </div>
        </nav>
     </header>

    <main class="homepage-container">
        <div class="homepage-content">

            <div class="content">
                <div class="main-content">
                    <div class="main-text">
                        <h3>Top Movies</h3>
                        <h1>Aflamy</h1>
                        <p>Your ticket to endless entertainment awaits, it's all here. Get ready to immerse yourself in the ultimate movie experience.</p>
                        <a href="index.php">Get Started</a>
                        <a href="#" class="cta"><i class="fa-solid fa-play"></i>Watch Now</a>
                    </div>
                    <div class="social">
                        <a href="#"><i class="fa-brands fa-windows"></i></a>
                        <a href="#"><i class="fa-brands fa-imdb"></i></a>
                        <a href="#"><i class="fa-solid fa-n"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-google"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="homepage-bg">
                    <img src="images/minions.png" alt="minions">
                </div>
        </div>
        
        
    </main>
</body>
</html>