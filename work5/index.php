<?php

$r="";

header('Content-Type: text/html; charset=UTF-8');


// Подготовленный запрос. Не именованные метки.
if($_SERVER["REQUEST_METHOD"] == "GET"){

  if(!empty(session_start() && $_COOKIE[session_name()]) && !empty($_SESSION['login']) && !isset($_COOKIE['init'])){
    if (isset($_COOKIE["name_error"])) {
      setcookie("name_error", "", 1000000);
    }
    if(isset($_COOKIE["email_error"])){
      setcookie("email_error", "", 1000000);
    }
    if(isset($_COOKIE["gen_error"])){
      setcookie("gen_error", "", 1000000);
    }
    if(isset($_COOKIE["limb_error"])){
      setcookie("limb_error", "", 1000000);
    }
    if(isset($_COOKIE["power_error"])){
      setcookie("power_error", "", 1000000);
    }
    if(isset($_COOKIE["bio_error"])){
      setcookie("bio_error", "", 1000000);
    }
    if(isset($_COOKIE["contract"])){
      setcookie("contract", "", 1000000);
    }
    $user = 'u52882';
    $pass = '8244733';
    $db = new PDO('mysql:host=localhost;dbname=u52882', $user, $pass, [PDO::ATTR_PERSISTENT => true]);
    $sth = $db->prepare("SELECT name, email, date, gender, limb, bio FROM Person where id=:id");
    $id = $_SESSION["id_form"];
    setcookie("id_form", $id);
    $sth->execute(['id'=>"$id"]);
    $res = $sth->fetchAll();
  
    setcookie("name", $res[0]['name']);
    setcookie("email", $res[0]["email"]);
    setcookie("date", $res[0]["date"]);
    setcookie("gen", $res[0]["gender"]);
    setcookie("lim", $res[0]["limb"]);
    setcookie("bio", $res[0]["bio"]);


    $sth1 = $db->prepare("SELECT ability_id FROM Connection where id=:id");
    $sth1->execute(['id'=>"$id"]);
    $res_power = $sth1->fetchAll();

    if(isset($_COOKIE["1"])){
      setcookie("1", "", 1000000);
    }
    if(isset($_COOKIE["2"])){
      setcookie("2", "", 1000000);
    }
    if(isset($_COOKIE["3"])){
      setcookie("3", "", 1000000);
    }

    
    foreach($res_power as $cout){
      if($cout['ability_id'] =="1"){
        setcookie("1","true");
      }
      if($cout['ability_id'] =="2"){
        setcookie("2","true");
      }
      if($cout['ability_id'] =="3"){
        setcookie("3","true");
      }
    }

    setcookie("init", "good");
    header('Location: index.php');
    exit();
  }

  include('form.php');
  exit();

}
else{



// Проверяем ошибки.
$erName="";
$erMail="";
$erDate="";
$erPowers="";
$erContract="";
$erBio="";
$erLogin="";
$erPass="";

$errorsInit=FALSE;
$errors=FALSE;

$respt="";

if (empty($_POST['name'])) {
  // Выдаем куку на день с флажком об ошибке в поле.
  setcookie("name_error","Заполните поле - Имя!");
  setcookie("name",$_POST["name"]);
  $errors = TRUE; 
}
else{
  // Сохраняем ранее введенное в форму значение на месяц.
  setcookie('name', $_POST['name'], time() + 30 * 24 * 60 * 60);
}

if (empty($_POST['email'])) {
  setcookie("email_error","Заполните поле - E-mail!");
  setcookie("email",$_POST["email"]);
  $errors = TRUE;
}
else{
  setcookie('email', $_POST['email'], time() + 30 * 24 * 60 * 60);
}

if(empty($_POST['date'])){
  setcookie("date_error","Заполните поле - Год!");
  setcookie("date",$_POST["date"]);
  $errors = TRUE;
}
else{
  setcookie('date', $_POST['date'], time() + 30 * 24 * 60 * 60);
}

if(empty($_POST['gender'])){
  setcookie("gen_error","Заполните поле - Пол!");
  
  $errors = TRUE;
}
else{
  setcookie("gen_error","",1000000);
  if ($_POST["gender"]=="Мужской"){
    setcookie("gen", "Мужской");
  }
  else{
    setcookie("gen", "Женский");
  }
}

if(empty($_POST['limb'])){
  setcookie("limb_error","Заполните поле - Количество конечностей!");
  $errors = TRUE;
}
else{
  setcookie("limb_error","",1000000);
  if ($_POST["limb"]=="2"){
    setcookie("lim", "2");
  }
  else if($_POST['limb']=="4"){
    setcookie("lim", "4");
  }
  else if($_POST['limb']=="6"){
    setcookie("lim", "6");
  }
  else{
    setcookie("lim", "8");
  }
}

if (empty($_POST['Superpowers'])) {
  setcookie("power_error","Заполните поле - Выберите способность(-и)!");
  setcookie("Superpowers", $_POST["Superpowers"]);
  $errors = TRUE;
}
else{
      setcookie("power_error","",1000000);
      setcookie("1","",1000000);
      setcookie("2","",1000000);
      setcookie("3","",1000000);
      $super=$_POST["Superpowers"];
      foreach($super as $cout){
        if($cout =="1"){
          setcookie("1","true");
        }
        if($cout =="2"){
          setcookie("2","true");
        }
        if($cout =="3"){
          setcookie("3","true");
        }
      }
}

if (empty($_POST['bio'])) {
  setcookie("bio_error","Заполните поле - Биография!");
  setcookie("bio",$_POST["bio"]);
  $errors = TRUE;
}
else{
  setcookie("bio_error","",1000000);
  setcookie("bio",$_POST["bio"]);
}

if (empty($_POST["contract"])){
  setcookie("contract", "Заполните поле с согласием");
  $errors = TRUE;
}
else{
  setcookie("contract", "", 100000);
}

if (empty($_POST['login'])) {
  setcookie("login_error","Заполните поле - Логин!");
  setcookie("login",$_POST["login"]);
  $errorsInit = TRUE; 
}
else{
  setcookie('login', $_POST['login'], time() + 30 * 24 * 60 * 60);
}

if (empty($_POST['password'])) {
  setcookie("password_error","Заполните поле - Пароль!");
  setcookie("password",$_POST["password"]);
  $errorsInit = TRUE; 
}
else{
  setcookie('password', $_POST['password'], time() + 30 * 24 * 60 * 60);
}

if($errorsInit){
  header('Location: index.php');
  exit();
}


if ($errors) {
  // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
  $resp = '!!!Исправьте ошибки!!!';
  header('Location: index.php');
  exit();
}
else{

      setcookie("name",$_POST["name"], time()+60*60*24*365);
      setcookie("email", $_POST["email"], time()+60*60*24*365);
      setcookie("date",$_POST["date"], time()+60*60*24*365);

      if($_POST["gender"]=="Мужской"){
        setcookie("gen", "Мужской", time()+60*60*24*365);
      }
      else{
        setcookie("gen", "Женский", time()+60*60*24*365);
      }

      if ($_POST["limb"]=="2"){
        setcookie("lim", "2", time()+60*60*24*365);
      }
      else if($_POST['limb']=="4"){
        setcookie("lim", "4", time()+60*60*24*365);
      }
      else if($_POST['limb']=="6"){
        setcookie("lim", "6", time()+60*60*24*365);
      }
      else{
        setcookie("lim", "8", time()+60*60*24*365);
      }
      setcookie("Superpowers",$_POST["Superpowers"], time()+60*60*24*365);
      foreach($super as $cout){
        if($cout =="1"){
          setcookie("1","true", time()+60*60*24*365);
        }
        if($cout =="2"){
          setcookie("2","true", time()+60*60*24*365);
        }
        if($cout =="3"){
          setcookie("3","true", time()+60*60*24*365);
        }
      }
      setcookie("bio",$_POST["bio"], time()+60*60*24*365);

  // Удаляем Cookies с признаками ошибок.
  setcookie('name_error', '', 100000);
  setcookie('email_error', '', 100000);
  setcookie('date_error', '', 100000);
  setcookie('gen_error', '', 100000);
  setcookie('limb_error', '', 100000);
  setcookie('power_error', '', 100000);
  setcookie('bio_error', '', 100000);
  setcookie('contract_error', '', 100000);
  setcookie('contract', '', 100000);

  $user = 'u52882';
  $pass = '8244733';
  $db = new PDO('mysql:host=localhost;dbname=u52882', $user, $pass, [PDO::ATTR_PERSISTENT => true]);


  $resp="";
  $respt="Форма отправлена!";
  // $erName="";
  // $erMail="";
  // $erDate="";
  // $erPowers="";
  // $erContract="";
  // $erBio="";

  if(!isset($_COOKIE["init"])){
    $с = 0;
    $statement = $db->prepare("INSERT INTO Person (name, email, date, gender, limb, bio) VALUES (:name, :email, :date, :gender, :limb, :bio)");
    $r=$statement->execute(['name'=>$_POST['name'], 'email'=>$_POST['email'], 'date'=>$_POST['date'], 'gender'=>$_POST['gender'], 'limb'=>$_POST['limb'], 'bio'=>$_POST['bio']]);
    if($r != 1){
      $с+=1;
    }
    $id_form=$db->lastInsertId();

    $statement = $db -> prepare("INSERT INTO Connection (person_id, ability_id) VALUES (:person_id, :ability_id)");
        foreach ($_POST['Superpowers'] as $superpowers)
        {
            if ($superpowers != false)
            {
                $statement -> execute(['person_id' => $id_form, 'ability_id' => $superpowers]);
                $c+=1;
            }
        }
        $byte_login = openssl_random_pseudo_bytes(4);
        $byte_pass = openssl_random_pseudo_bytes(5);
        $log = bin2hex($byte_login);
        $combin_pass = bin2hex($byte_pass);
        $pass = md5($_combinpass);
        $statement1=$db->prepare("INSERT INTO Users (id_form, login, password) VALUES (:id_form, :login, :password)");
        $r1=$statement1->execute(['id_form'=>"$id_form", 'login'=>"$log", 'password'=>"$pass"]);
        
        if($r1 != 1){
          $c+=1;
        }
        setcookie("loginNew",$log);
        setcookie("passwordNew", $combin_pass);

        if($c==0){
          setcookie("final", "true");
        }
        else{
          setcookie("final","false");
        }
  }
  else{

    $c = 0;
          $statement1 = $db->prepare("UPDATE Person SET name = :name, email = :email, date = :date, gender = :gender, limb = :limb, bio = :bio WHERE person_id = :person_id");
          $r1 = 0;
          $statement1->bindValue(":person_id", $_COOKIE['id_form']);
          $statement1->bindValue(":name", $_POST['name']);
          $statement1->bindValue(":email", $_POST['email']);
          $statement1->bindValue(":date", $_POST['date']);
          $statement1->bindValue(":gender", $_POST['gender']);
          $statement1->bindValue(":limb", $_POST['limb']);
          $statement1->bindValue(":bio", $_POST['bio']);
          $r1=$statement1->execute();
          if($r1 == 0){
            $c+=1;
          }
        
          $statement2 = $db->prepare("DELETE FROM Connection WHERE person_id = :person_id");
          $statement2->bindValue("person_id",$_COOKIE['id_form']);
          $r2 = $statement2->execute();
          if($r2 == 0){
            $c+=1;
          }

          foreach ($_POST['Superpowers'] as $superpowers)
        {
            if ($superpowers != false)
            {
                $statement3=$db->prepare("INSERT INTO Connection (person_id, ability_id) VALUES (:person_id, :ability_id)");
                $r3=$statement3->execute(['person_id'=>$_COOKIE['id_form'], 'ability_id'=>$superpowers]);
                $c+=1;
            }
        }

        if($c==0){
          setcookie("final", "true");
        }
        else{
          setcookie("final","false");
        } 
        session_destroy();

  }
    
  }
  setcookie('save', '1');

  header('Location: index.php');

}
?>