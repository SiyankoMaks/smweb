<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 4</title>
    <link rel="stylesheet" href="work4.css">
</head>

<?php 
$erName=""; $erMail=""; $erDate=""; $erGen=""; $erLimb=""; $erPowers=""; $erBio=""; $erContract=""; $er=false; $resp="";$respt="";
if (isset($_COOKIE["name_error"])) {
  $erName=$_COOKIE["name_error"];
  $er=true;
}
if (isset($_COOKIE["email_error"])) {
  $erMail=$_COOKIE["email_error"];
  $er=true;
}
if (isset($_COOKIE["date_error"])) {
  $erDate=$_COOKIE["date_error"];
  $er=true;
}
if (isset($_COOKIE["gen_error"])) {
  $erGen=$_COOKIE["gen_error"];
  $er=true;
}
if (isset($_COOKIE["limb_error"])) {
  $erLimb=$_COOKIE["limb_error"];
  $er=true;
}
if (isset($_COOKIE["power_error"])) {
  $erPowers=$_COOKIE["power_error"];
  $er=true;
}
if (isset($_COOKIE["bio_error"])) {
  $erBio=$_COOKIE["bio_error"];
  $er=true;
}
if (isset($_COOKIE["contract"])) {
  $erContract=$_COOKIE["contract"];
  $er=true;
}

if($er==true){
  $resp="!!!Исправьте ошибки!!!";
}
else {
  $respt="Форма отправлена!";
}

?>

<body>
    <form id="form" method="POST", action="index.php">
    <a style="color: red; text-align: center; font-size: 23px;"><?php echo $resp ?></a>
    <a style="color: rgb(52, 134, 71); text-align: center; font-size: 22px;"><?php echo $respt ?></a>
         <p><label>
           Имя:
           <input type="text" name="name" placeholder = "Введите имя"
            value = "<?php if(isset($_COOKIE["name"])){ echo $_COOKIE["name"];} ?>" />
         </label><a style="color: red; font-size: 17px;"><?php if(empty($_COOKIE["name"])) echo $erName?></a></p>
         <p><label>
           E-mail:
           <input type="email" name="email" placeholder="Введите E-mail"
            value = "<?php if(isset($_COOKIE["email"])){ echo $_COOKIE["email"];} ?>" />
         </label><a style="color: red; font-size: 17px;"><?php if(empty($_COOKIE["email"])) echo $erMail?></a></p>
         <p><label>
           Год рождения:
           <input type="text" name="date" placeholder="Введите год"
            value = "<?php if(isset($_COOKIE["date"])){ echo $_COOKIE["date"];} ?>" />
         </label><a style="color: red; font-size: 17px;"><?php if(empty($_COOKIE["date"])) echo $erDate?></a></p>
         <p><label>
           Пол:
           <input type="radio" name="gender"  value="Мужской" <?php if (isset($_COOKIE["gen"])) if ($_COOKIE["gen"]=="Мужской") echo "checked" ?> > Мужской
          </label>
         <label>
            <input type="radio" name="gender" value="Женский"  <?php if (isset($_COOKIE["gen"])) if ($_COOKIE["gen"]=="Женский") echo "checked" ?> > Женский
          </label><a style="color: red; font-size: 17px;"><?php if(empty($_COOKIE["gen"])) echo $erGen?></a></p>
          Количество конечностей:
         <br>
         <label> <input type="radio" name="limb" value="2" <?php if (isset($_COOKIE["lim"])) if ($_COOKIE["lim"]=="2") echo "checked" ?> > 2</label>
         <label> <input type="radio" name="limb" value="4" <?php if (isset($_COOKIE["lim"])) if ($_COOKIE["lim"]=="4") echo "checked" ?> > 4 </label>
         <label> <input type="radio" name="limb" value="6" <?php if (isset($_COOKIE["lim"])) if ($_COOKIE["lim"]=="6") echo "checked" ?> > 6 </label>
         <label> <input type="radio" name="limb" value="8" <?php if (isset($_COOKIE["lim"])) if ($_COOKIE["lim"]=="8") echo "checked" ?> > 8 </label>
         <a style="color: red; font-size: 17px;"><?php if(empty($_COOKIE["lim"])) echo $erLimb?></a>
         <br><br>
         <label>
           Сверхспособности:
           <br>
           <select multiple name="Superpowers[]" size="3">
             <option name="1" value="1" <?php if (isset($_COOKIE["1"])) if ($_COOKIE["1"]=="true") echo "selected" ?> >Бессмертие</option>
             <option name="2"value="2" <?php if (isset($_COOKIE["2"])) if ($_COOKIE["2"]=="true") echo "selected" ?>>Прохождение сквозь стены</option>
             <option name="3" value="3" <?php if (isset($_COOKIE["3"])) if ($_COOKIE["3"]=="true") echo "selected" ?>>Левитация</option>
           </select>
         </label>
         <a style="color: red; font-size: 17px;"><?php if(empty($_COOKIE["Superpowers"])) echo $erPowers?></a>
         <br><br>
         <label>
           Биография:
           <br>
           <textarea name="bio" cols="25" rows="15" placeholder="Заполните биографию"><?php if(isset($_COOKIE["bio"])){ echo $_COOKIE["bio"];} ?></textarea>
         </label>
         <a style="color: red; font-size: 17px;"><?php if(empty($_COOKIE["bio"])) echo $erBio?></a>
         <p><label>
           С контрактом ознакомлен(-а)
           <input type="checkbox" name="contract" >
         </label><a style="color: red; font-size: 17px;"><?php if(empty($_POST['contract'])) echo $erContract ?> </a></p>
         <p><label>
           <input type="submit" id="button" value="Отправить">
         </label></p>
       </form>
</body>
</html>
