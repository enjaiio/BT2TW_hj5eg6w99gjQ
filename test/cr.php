<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>註冊頁面</title>
  </head>
  <body>
    <form class="" action="add.php" method="post"><br>
        <input type="mail" name="mail" value="" placeholder="輸入註冊信箱"><br>
        <input type="text" name="password" value=""panel placeholder="輸入密碼"><br>
        <input type="password" name="pwcheck" value=""panel placeholder="再次輸入密碼"><br>
        <input type="text" name="name" value="" placeholder="輸入姓名"><br>
        <input type="number" name="phone" value="" placeholder="輸入電話"><br>
        <input type="text" name="addr" value="" placeholder="輸入地址"><br>
        <input type="submit" name="" value="註冊"><br>
    </form>
    <?php
      ini_set("display_errors","On");
      $account = $_POST['mail'];
      $password = $_POST['password'];
      $member = $_POST['name'];
      $phone = $_POST['phone'];
      $addr = $_POST['addr'];
      require_once "../../method/connect.php";
      $insert = $connect -> prepare("INSERT INTO member(account,password,member,phone,addr)
      VALUES(?,?,?,?,?)");
      $insert -> execute(array($account,$password,$member,$phone,$addr));
      header("location:../?sig_suc=註冊成功");
    ?>
  </body>
</html>