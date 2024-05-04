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
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <title>Edit Profile</title>
    <meta name="author" content="Anass Seghir">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="keywords" content="HTML, CSS, Sass JavaScript, jQuery, PHP, SEO, frontend, Backend, FullStack Develpment, login, signin, signup, user infos">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="description" content="this is a login & register system designed to store the user's informations">
    <link rel="icon" type="image/svg" sizes="32x32" href="./images/favicon-32x32.svg">
    <link rel="manifest" href="manifest.json">
    <script src="https://kit.fontawesome.com/823a574c14.js" crossorigin="anonymous"></script>
    <style>
        body {
            height: 100vh;
            width: 100vw;
        }
    </style>
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

        <?php 
        
        $id = $_SESSION['id'];
        $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

        while($result = mysqli_fetch_assoc($query)){
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $res_Age = $result['Age'];
            $res_id = $result['Id'];
        }
        ?>
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
                <a href="home.php" style="margin-bottom: 0;"><i class="fa-regular fa-user"></i>Home</a>
                <a href="status/favorites.php"><i class="fa-regular fa-heart"></i>Favorites</a>
            </div>
            <div class="logout-option">
                <a href="php/logout.php"><i class="fa-solid fa-right-from-bracket"></i>LogOut</a>
            </div>
        </div>
    </div>
    </div>
    <main class="home-container">
        <div class="form-box">
            <?php 
                $id = $_SESSION['id'];
                
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $edit_query = mysqli_query($con,"UPDATE users SET Username='$username', Email='$email', Age='$age' WHERE Id=$id ") or die("error occurred");
                if($edit_query){
                    echo "<div class='update-success'>
                            <p>Profile Updated!</p>
                          </div> <br>";
                    echo "<a href='home.php'><button class='edit-btn'>Go Home</button>";
                }
               }else{
                $query = mysqli_query($con,"SELECT * FROM users WHERE Id=$id ");
                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                }
            ?>
            <form action="" method="post" class="edit-form">
                <header>
                    <h2 class="edit-title">
                        Update Profile
                    </h2>
                </header>
                <div class="inputEdit-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="inputEdit-field">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="inputEdit-field">
                    <i class="fas fa-leaf"></i>
                    <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off" required>
                </div>
                
                <input type="submit" class="edit-btn" value="Update" name="submit" required />
                
            </form>
        </div>
        <?php } ?>
        </main>
        <script src="avatar-edit.js"></script>
        <script>
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
</body>
</html>