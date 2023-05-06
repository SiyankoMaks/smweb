<?php

include('functions.php');

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE['init'])){
  DEL_COOKIE();
  header("Location: admin.php");
  exit();
}

if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}
else{
  $db=DB_Connect();
  $chk = DB_Admins($db, $_SERVER['PHP_AUTH_USER']);
  $pass = $_SERVER['PHP_AUTH_PW'];
  $p = false;
  foreach($chk as $cout){
    if(password_verify($pass,$cout["pass"])){
      $p = true;
    }
  }

  if(!$p){
    header('HTTP/1.1 401 Unanthorized');
    header('WWW-Authenticate: Basic realm="My site"');
    print('<h1>401 Требуется авторизация</h1>');
    exit();
  }
  else{
    $users = DB_Users($db);
    
    ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 6</title>
    <link rel="stylesheet" href="work6.css" />
  </head>

  <body>
    <a><b>Вы успешно авторизовались и видите все защищенные данные.</b></a>
    <br><br>
    <a><b>Статистика:<b></a>
    <table>
        <tr>
          <th>Суперспособность</th>
          <th>Кол-во человек</th>
        </tr>
      <?php
        $k = Kol_1($db);
        echo "<tr><td>immortality</td><td class='center'>$k</td>";
        $k =  Kol_2($db);
        echo "<tr><td>passing through walls</td><td class='center'>$k</td>";
        $k =  Kol_3($db);
        echo "<tr><td>levitation</td><td class='center'>$k</td>";
      ?>
    </table>
    <br><br>
    <a><b>Пользователи:</b></a>
      <table>
        <tr>
          <th>id</th>
          <th>login</th>
        </tr>
        <?php
        foreach($users as $cout){
          $id = $cout['id'];
          $login = $cout['login'];
          echo 
          "<tr><td>$id</td>
          <td>$login</td>";
          echo 
          "<td><form action='index.php' method='GET'>
          <button type='submit'  name='btn' value='$id'>Изменить данные</button>
          </form></td>";
          echo 
          "<td><form action='del.php' method='POST' target: '_blank'>
          <button type='submit' name='btn' value='$id'>Удалить данные</button>
          </form></td></tr>";
        }
        ?>
      </table>
  </body>
</html>
    <?php
    exit();    
  }
}
?>