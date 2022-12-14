<?php
session_start();
require_once '../config/bddesign_db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        echo "<script>alert('กรุณากรอก Username')</script>";
        //echo "<meta http-equiv='refresh' content='0;url=index>";
    } else if (empty($password)) {
        echo "<script>alert('กรุณากรอกรหัสผ่าน')</script>";
       // echo "<meta http-equiv='refresh' content='0;url=index>";
    } else {
        try {
            $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $check_data->bindParam(":email", $email);
            $check_data->execute();
            $row = $check_data->fetch(PDO::FETCH_ASSOC);

            if ($check_data->rowCount() > 0) {
                if ($email == $row['email']) {
                    if (password_verify($password, $row['password'])) {
                        if ($row['is_admin'] == 1) {
                            $_SESSION['admin_login'] = $row['id'];
                            header("location: index");
                            
                         } 
                    }
                }
            }else {
                    echo "<script>alert('คุณไม่ใช่ Admin')</script>";
                    // echo "<meta http-equiv='refresh' content='0;url=login>";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD Design</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/login.css?v=<?php echo time(); ?>">
</head>

<body style="font-family: 'Kanit', sans-serif;">
    <div class="pos">
        <div class="form" id="form-pos">
            <img src="../images/logo.webp">
            <form action="login" method="POST" style="margin: 0 auto;">
                <span>BD Design - Login</span>
                <div class="opt-group">
                    <label>E-mail</label>
                    <input type="text" class="form-control email" name="email" >
                </div>
                <div class="opt-group">
                    <label>Password</label>
                    <input type="password" class="form-control pass" name="password" >
                </div>
                <div class="opt-group">

                </div>
                <input type="submit" name="login" class="login" value="Login">
            </form>
        </div>
    </div>
</body>

</html>