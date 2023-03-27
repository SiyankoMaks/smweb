<?php

// Подготовленный запрос. Не именованные метки.
if($_SERVER["REQUEST_METHOD"] == "GET"){
  include('work3.html');
  exit();
}

$user = 'u52882';
$pass = '8244733';
$db = new PDO('mysql:host=localhost;dbname=u52882', $user, $pass, [PDO::ATTR_PERSISTENT => true]);



// Проверяем ошибки.
$erName="";
$erMail="";
$erDate="";
$erPowers="";
$erContract="";
$erBio="";
$inpName="";
$inpMail="";
$inpDate="";
$inpPowers="";
<<<<<<< HEAD
=======
$inpContract="";
>>>>>>> 4d2d858f57d3f8e779e7f85f91f719c00d479b31
$inpBio="";
$errors=FALSE;

$respt="";

if (empty($_POST['name'])) {
  $erName .= '<br/>Заполните поле - Имя.<br/>';
  $errors = TRUE; 
}
else{
  $inpName=$_POST['name'];
}

if (empty($_POST['email'])) {
  $erMail .='<br/>Заполните поле - E-mail.<br/>';
  $errors = TRUE;
}
else{
  $inpMail=$_POST['email'];
}

if(empty($_POST['date'])){
  $erDate .= '<br/> Заполните поле - Год.<br/>';
  $errors = TRUE;
}
else{
  $inpDate=$_POST['date'];
}

if (empty($_POST['Superpowers'])) {
  $erPowers .='<br/>Выберите способность(-и).<br/>';
  $errors = TRUE;
}
else{
  $inpPowers=$_POST['Superpowers'];
}

if (empty($_POST['bio'])) {
  $erBio .= '<br/>Заполните поле - Биография.<br/>';
  $errors = TRUE; 
}
else{
  $inpBio=$_POST['bio'];
}

if (empty($_POST['contract'])){
  $erContract .='<br/>Заполните поле с согласием.<br/>';
  $errors = TRUE;
}
else{
  $inpContract=$_POST['contract'];
}

<<<<<<< HEAD

$manChecked = NULL;
$nonmanChecked = 'checked="checked"';
if(isset($_POST['gender'])) {
if($_POST['gender'] == 'Мужской') {
$manChecked = 'checked="checked"';
$nonmanChecked = NULL;
} else if($_POST['gender'] == 'Женский') {
$manChecked = NULL;
}
}

$l2Checked = NULL;
$l4Checked = NULL;
$l6Checked = NULL;
$l8Checked = 'checked="checked"';
if(isset($_POST['limb'])) {
if($_POST['limb'] == '2') {
$l2Checked = 'checked="checked"';
$l4Checked = NULL;
$l6Checked = NULL;
$l8Checked = NULL;
} else if($_POST['limb'] == '4') {
  $l4Checked = 'checked="checked"';
  $l2Checked = NULL;
  $l6Checked = NULL;
  $l8Checked = NULL;
}else if($_POST['limb'] == '6') {
  $l6Checked = 'checked="checked"';
  $l2Checked = NULL;
  $l4Checked = NULL;
  $l8Checked = NULL;
} else if($_POST['limb'] == '8') {
$l2Checked = NULL;
$l4Checked = NULL;
$l6Checked = NULL;
}
}

$p1Selected = NULL;
$p2Selected = NULL;
$p3Selected = NULL;
$super = $_POST['Superpowers'];
// if(isset($_POST['Superpowers'])) {
//   if($_POST['Superpowers'] == '1'&& $_POST['Superpowers'] == '2' && $_POST['Superpowers'] == '3') {
//     $p1Selected = 'selected="selected"';
//     $p2Selected = 'selected="selected"';
//     $p3Selected = 'selected="selected"';
//   } else if($_POST['Superpowers'] == '1'&& $_POST['Superpowers'] == '2') {
//     $p1Selected = 'selected="selected"';
//     $p2Selected = 'selected="selected"';
//     $p3Selected = NULL;
//   } else if($_POST['Superpowers'] == '1'&& $_POST['Superpowers'] == '3') {
//     $p1Selected = 'selected="selected"';
//     $p3Selected = 'selected="selected"';
//     $p2Selected = NULL;
//   } else if($_POST['Superpowers'] == '2'&& $_POST['Superpowers'] == '3') {
//     $p3Selected = 'selected="selected"';
//     $p2Selected = 'selected="selected"';
//     $p1Selected = NULL;
//   }

// }

if(isset($super)){
  foreach($super as $cout){
    if($cout =="1"){
      $p1Selected = 'selected="selected"';
    }
    if($cout =="2"){
      $p2Selected = 'selected="selected"';
    }
    if($cout =="3"){
      $p3Selected = 'selected="selected"';
    }
}
}

=======
>>>>>>> 4d2d858f57d3f8e779e7f85f91f719c00d479b31
// if (empty($_POST['date']) || !is_numeric($_POST['date']) || !preg_match('/^\d+$/', $_POST['date'])) {
//   print('Заполните год.<br/>');
//   $errors = TRUE;
// }

if($errors == TRUE){
  $resp = '!!!Исправьте ошибки!!!';
}
else{
  $resp="";
  $erName="";
  $erMail="";
  $erDate="";
  $erPowers="";
  $erBio="";
  $erContract="";
  $inpName="";
  $inpMail="";
  $inpDate="";
  $inpPowers="";
<<<<<<< HEAD
=======
  $inpContract="";
>>>>>>> 4d2d858f57d3f8e779e7f85f91f719c00d479b31
  $inpBio="";
  $respt="Форма отправлена!";

// $stmt = $db->prepare("INSERT INTO application SET name = ?");
  // $stmt -> execute([$_POST['name']]);
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


<<<<<<< HEAD

=======
>>>>>>> 4d2d858f57d3f8e779e7f85f91f719c00d479b31
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Задание 3</title>
    <link rel="stylesheet" href="work3.css">
</head>

<body>
    <form id="form" method="POST", action="">
    <a style="color: red; text-align: center; font-size: 23px;"><?=$resp?></a>
    <a style="color: rgb(52, 134, 71); text-align: center; font-size: 22px;"><?=$respt?></a>
         <p><label>
           Имя:
           <input type="text" name="name" placeholder = "Введите имя" value = "<?=$inpName?>" />
         </label><a style="color: red; font-size: 17px;"><?=$erName?></a></p>
         <p><label>
           E-mail:
           <input type="email" name="email" placeholder="Введите E-mail" value = "<?=$inpMail?>" />
         </label><a style="color: red; font-size: 17px;"><?=$erMail?></a></p>
         <p><label>
           Год рождения:
           <input type="text" name="date" value = "<?=$inpDate?>" />
         </label><a style="color: red; font-size: 17px;"><?=$erDate?></a></p>
         <p><label>
           Пол:
<<<<<<< HEAD
           <input type="radio" name="gender" <?php echo $manChecked;?> value="Мужской"> Мужской
          </label>
         <label>
            <input type="radio" name="gender" <?php echo $nonmanChecked;?> value="Женский"> Женский
          </label></p>
          Количество конечностей:
         <br>
         <label><input type="radio" name="limb" <?php echo $l2Checked;?> value="2"> 2</label>
         <label> <input type="radio" name="limb" <?php echo $l4Checked;?> value="4"> 4 </label>
         <label> <input type="radio" name="limb" <?php echo $l6Checked;?> value="6"> 6 </label>
         <label> <input type="radio" name="limb" <?php echo $l8Checked;?> value="8"> 8 </label>
=======
           <input type="radio" name="gender" value="Мужской" checked = "checked"> Мужской
          </label>
         <label>
            <input type="radio" name="gender" value="Женский"> Женский
          </label></p>
          Количество конечностей:
         <br>
         <label><input type="radio" name="limb" checked="checked" value="2"> 2</label>
         <label> <input type="radio" name="limb" value="4"> 4 </label>
         <label> <input type="radio" name="limb" value="6"> 6 </label>
         <label> <input type="radio" name="limb" value="8"> 8 </label>
>>>>>>> 4d2d858f57d3f8e779e7f85f91f719c00d479b31
         <br><br>
         <label>
           Сверхспособности:
           <br>
           <select multiple name="Superpowers[]" size="3">
<<<<<<< HEAD
             <option name="1" <?php echo $p1Selected;?> value="1">Бессмертие</option>
             <option name="2" <?php echo $p2Selected;?> value="2">Прохождение сквозь стены</option>
             <option name="3" <?php echo $p3Selected;?> value="3">Левитация</option>
=======
             <option value="1">Бессмертие</option>
             <option value="2">Прохождение сквозь стены</option>
             <option value="3">Левитация</option>
>>>>>>> 4d2d858f57d3f8e779e7f85f91f719c00d479b31
           </select>
         </label>
         <a style="color: red; font-size: 17px;"><?=$erPowers?></a>
         <br><br>
         <label>
           Биография:
           <br>
           <textarea name="bio" cols="25" rows="15" placeholder="Заполните поле биографии"><?=$inpBio?></textarea>
         </label>
         <a style="color: red; font-size: 17px;"><?=$erBio?></a>
         <p><label>
           С контрактом ознакомлен(-а)
<<<<<<< HEAD
           <input type="checkbox" name="contract">
=======
           <input type="checkbox" name="contract"  checked = "<?=$inpContract?>">
>>>>>>> 4d2d858f57d3f8e779e7f85f91f719c00d479b31
         </label><a style="color: red; font-size: 17px;"><?=$erContract?></a></p>
         <p><label>
           <input type="submit" value="Отправить">
         </label></p>
       </form>
</body>
</html>
