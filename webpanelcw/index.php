<?php
require_once('config/yoyi_db.php');
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        echo "<script>alert('กรุณากรอก Username')</script>";
    } else if (empty($password)) {
        echo "<script>alert('กรุณากรอก Password')</script>";
    } else {
        try {
            $check_data = $conn->prepare("SELECT * FROM admin WHERE username = :username");
            $check_data->bindParam(":username", $username);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

            if($check_data->rowCount() > 0 ){
                if($username == $row['username']){
                    if(password_verify($password, $row['password'])){
                        $_SESSION['admin_login'] = $row['id'];
                        header("location: home");
                    }else{
                        echo "<script>alert('Password ไม่ถูกต้อง')</script>";
                    }
                }else{
                    echo "<script>alert('Username ไม่ถูกต้อง')</script>";
                }
            }else{
                echo "<script>alert('Username หรือ Password ไม่ถูกต้อง')</script>";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Yo Yi Foods Co., Ltd.</title>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/shared/iconly.css">
    <link rel="shortcut icon" href="../images/logo.svg">
</head>

<body>
    <div class="login-app">
        <div class="box-login">
            <div class="header-img">
                <img src="../images/logo.svg" width="20%" alt="">
               
            </div>
            <form method="post">
                <div class="box-input">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="btn-login">
                    <button type="submit" name="submit" class="btn btn-submit">Login</button>
                </div>
            </form>
        </div>
        <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, incidunt?</p> -->
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>