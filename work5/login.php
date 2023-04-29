<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 5</title>
    <link rel="stylesheet" href="work5.css">
</head>

<?php

session_start();

if(isset($_COOKIE["init"])){
    $_SESSION['login']="";
    setcookie("init", "", 1000000);
  }
  
  if(!empty($_SESSION['login'])){
    header('Location: index.php'); 
    exit();
  }
  $erLogin=""; $erPass="";
  if (isset($_COOKIE["login_error"])) {
    $erLogin=$_COOKIE["login_error"];
  }
  if (isset($_COOKIE["password_error"])) {
    $erPass=$_COOKIE["password_error"];
  }
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    

?>

<body>
    <form method="POST" action="login.php" id="form">
    <div style="color: red; font-size: 17px; <?php if(!isset($_COOKIE["info"])){echo "display: none;";} ?>">Неверный логин или пароль</div>
    <p><label> Логин: <br>
           <input type="text" name="login" placeholder = "Введите Логин"
            value = "<?php if(isset($_COOKIE["login"])){ echo $_COOKIE["login"];} ?>" />
    </label><a style="color: red; font-size: 17px;"><?php if(empty($_COOKIE["login"])) echo $erLogin?></a></p>
    <p><label> Пароль: <br>
           <input type="password" name="pass" placeholder = "Введите Пароль"
            value = "<?php if(isset($_COOKIE["pass"])){ echo $_COOKIE["pass"];} ?>" />
    </label><a style="color: red; font-size: 17px;"><?php if(empty($_COOKIE["pass"])) echo $erPass?></a></p>
    <button type="submit" id="button">Войти</button>
    <br><br>
    <a href="index.php">Вход без авторизации</a>
    </form>
</body>

</html>

<?php

}
else {
    $user = 'u52882';
    $pass = '8244733';
    $conn = new PDO('mysql:host=localhost;dbname=u52882', $user, $pass, [PDO::ATTR_PERSISTENT => true]);
    $log=$_POST["login"];
    $passw=$_POST["password"];
    $passOld=md5($passw);
    $sth = $conn->prepare("SELECT id, id_form, login, password FROM USERS where login=:login and password=:password");
    $sth->execute(['login'=>"$log", 'password'=>"$passOld"]);
    $res = $sth->fetchAll();
    setcookie("login", $log);
    setcookie("password", $passw);
    setcookie("info", "error");
  
    if(!empty($res)){
        $_SESSION['id'] = $res[0]['id'];
        $_SESSION['id_form']=$res[0]['id_form'];
        $_SESSION['login'] = $log;
        $_SESSION['password']=$passw;
        setcookie("info", "", 1000000);
    }
    header('Location: login.php');
    exit();
  }

?>