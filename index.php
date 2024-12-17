<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/823a574c14.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dist/style.css" />
    <title>SignIn | SignUp</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="author" content="Anass Seghir">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="HTML, CSS, Sass JavaScript, jQuery, PHP, SEO, frontend, Backend, FullStack Develpment, login, signin, signup, user infos">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="description" content="this is a login & register system designed to store the user's informations">
    <link rel="icon" type="image/svg" sizes="32x32" href="./images/favicon-32x32.svg">
    <script src="app.js" defer></script>
    <link rel="manifest" href="manifest.json">
  </head>
  <body>
    <main class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <?php 
              include("php/config.php");
              if(isset($_POST['login_submit'])){
                $login_email = mysqli_real_escape_string($con,$_POST['login_email']);
                $login_password = mysqli_real_escape_string($con,$_POST['login_password']);

                $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$login_email' AND Password='$login_password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['age'] = $row['Age'];
                    $_SESSION['id'] = $row['Id'];
                    header("Location: home.php");
                }else{
                    echo "<div class='message-failure'>
                            <p>Wrong Username or Password</p>
                          </div> <br>";
                }
              }
              elseif(isset($_POST['signup_submit'])) {
                $signup_username = $_POST['signup_username'];
                $signup_email = $_POST['signup_email'];
                $signup_age = $_POST['signup_age'];
                $signup_password = $_POST['signup_password'];

                $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$signup_email'");

                if(mysqli_num_rows($verify_query) !=0 ){
                    echo "<div class='message-failure'>
                              <p>This email is used, Try another One Please!</p>
                          </div> <br>";
                }
                else{
                    mysqli_query($con,"INSERT INTO users(Username,Email,Age,Password) VALUES('$signup_username','$signup_email','$signup_age','$signup_password')") or die("Erroe Occured");
                    echo "<div class='message-success'>
                              <p>Registration successfully!</p>
                          </div> <br>";
                }
              }
            
            ?>
          <form action="" class="sign-in-form" method="post">
            <header>
              <h2 class="title">Sign in</h2>
            </header>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="Email" name="login_email" autocomplete="off" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="login_password" autocomplete="off" required />
            </div>
            <input type="submit" value="Login" class="btn solid" name="login_submit" autocomplete="off" required />
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          <form action="" class="sign-up-form" method="post">
            <header>
              <h2 class="title">Sign up</h2>
            </header>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="signup_username" autocomplete="off" required />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="signup_email" autocomplete="off" required />
            </div>
            <div class="input-field">
              <i class="fas fa-leaf"></i>
              <input type="number" placeholder="Age" name="signup_age" autocomplete="off" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="signup_password" autocomplete="off" required />
            </div>
            <input type="submit" class="btn" value="Sign up" name="signup_submit" autocomplete="off" required />
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <aside class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
            Welcome to our community! We're thrilled to have you join us with us. 
            Get ready to explore, connect, and thrive with us.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="images/login.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
            Welcome back! We're thrilled to have you here again. 
            Let's pick up where we left off and continue exploring together
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="images/undraw_voice_control_ofo1.svg" class="image" alt="" />
        </div>
      </aside>
    </main>
    <script>
    $(document).ready(function() {
    $('[class*="message"').each(function(index, element) {
        setTimeout(function() {
            $(element).css('opacity', '0').delay(500).hide(0);
        }, 2000);
      });
    });
  </script>
  </body>
</html>
