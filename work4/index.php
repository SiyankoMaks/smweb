<?php

header('Content-Type: text/html; charset=UTF-8');


// Подготовленный запрос. Не именованные метки.
if($_SERVER["REQUEST_METHOD"] == "GET"){

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
  $erName="";
  $erMail="";
  $erDate="";
  $erPowers="";
  $erContract="";
  $erBio="";

    $statement = $db->prepare("INSERT INTO Person (name, email, date, gender, limb, bio, contract) VALUES (:name, :email, :date, :gender, :limb, :bio, :contract)");
    $statement -> execute(['name'=>$_POST['name'], 'email'=>$_POST['email'], 'date'=>$_POST['date'], 'gender'=>$_POST['gender'], 'limb'=>$_POST['limb'], 'bio'=>$_POST['bio'], 'contract'=>$_POST['contract']]);
    $id_connection = $db->lastInsertId();

    $statement = $db -> prepare("INSERT INTO Connection (person_id, ability_id) VALUES (:person_id, :ability_id)");
        foreach ($_POST['Superpowers'] as $superpowers)
        {
            if ($superpowers != false)
            {
                $statement -> execute(['person_id' => $id_connection, 'ability_id' => $superpowers]);
            }
        }
  }
  setcookie('save', '1');

  header('Location: index.php');

}
?>