<?php
    
    require_once ('config.php');

    $gSettings = new Settings;
    $gSettings->GetGeneralSetting(['status', '=', 1]);
    $query  = $gSettings->query;
    $result = $query->fetch_assoc();
    $footer = (isset($result['footer_text'])) ? $result['footer_text'] : null;
    $logo   = (isset($result['logo'])) ? $result['logo'] : null;
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }
    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>
<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <?php
  
                
            if(isset($_POST['submit']) && $_POST['submit'] === 'Sign in'){

                $name       = $_POST['name'];
                $pass       = $_POST['pass'];
                $hash_pass  = hash('sha512', $pass);

                $login      = new Login;
                $isLoged    = $login->userLogin($name, $hash_pass);

                $messages   = [];

                if(isset($name,$pass)){

                    if(empty($name) && empty($pass)){

                        $messages[] = 'All Fileds is Required';
                    }else{

                        if(empty($name)){
                            $messages[] = 'User Name is Required';  
                        }elseif (empty($pass)) {
                            $messages[] = 'Password is Required';
                        }elseif ($isLoged === false) {
                            $messages[] = 'Your Email or Password is Incorrect';
                        }   
                    }

                    if(!empty($messages)){

                        $_SESSION['messages']   = $messages;
                        $_SESSION['class_name'] = 'alert-danger';

                        require_once ('messages.php');
                    }else{

                        $messages[] = 'Successfully Login';

                        $_SESSION['front_user'] = $name;

                        $_SESSION['messages']   = $messages;
                        $_SESSION['class_name'] = 'alert-success';

                        require_once ('messages.php');

                        echo "<script>
                            setTimeout(function(){
                                window.location.href = 'dashboard.php';
                            }, 2000);
                        </script>";
                    }
                }
            }
        ?>
        <div class="card ">
            <div class="card-header text-center"><a href="index.php"><img class="logo-img" width="100px;" src="images/logo/<?php echo $logo;?>" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="name" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="pass"  type="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <input type="submit" name="submit" value="Sign in" class="btn btn-primary btn-lg btn-block">
                </form>
            </div>
            <div class="card-footer bg-white p-0">
                <div class="card-footer-item card-footer-item-bordered ">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
 
</html>