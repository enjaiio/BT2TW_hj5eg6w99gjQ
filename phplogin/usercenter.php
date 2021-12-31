<?php
/*****************************usercenter.php*****************************
在會員中心頁面會先判斷連線者是否為會員，所以我們會先讀入SESSION中的資料，如果有
值則判斷為會員並允許登入，接者再判斷等級，決定要顯示的內容，如果是管理者以上的等
級，則在頁面上方會多出兩個功能可以使用，否則為一般會員，只能看自己的資料．
************************************************************************/
include_once('connect.php');

$lvstr=array("無","路人","客戶","管理者","sysop");

if(isset($_SESSION['acc'])){
   $user=$_SESSION['acc'];
?>
<DOCTYPE html>
<html>
<head>
<title>會員中心</title>
<link href="user.css" rel="stylesheet" type="text/css">
</head>
<body>
 <table>
  <tr class="headbar">
    <td>歡迎 <?php echo $user; ?>(<a href="logout.php" class="logout">登出</a>)</td>
    <td class="headNow"><a href="usercenter.php" class="headStr">個人資料</a></td>
<?php
  if($_SESSION['level']>=3){
?>
    <td><a href="useradmin.php" class="headStr">會員管理</a></td>
    <td><a href="createacc.php" class="headStr">新增會員</a></td>
<?php
  }else{echo "<td></td><td></td>";}
?>
  </tr>
 </table><br /><br />
 <table class="userInfo">
  <tr>
    <td colspan="2" class="headpic"><img src="pic/<?php echo $_SESSION['avatar']; ?>"/></td>
  <tr>
    <td class="colTitle">帳號</td>
    <td class="colLeft"><?php echo $_SESSION['acc']; ?></td>
  </tr>
  <tr>
    <td class="colTitle">密碼</td>
    <td class="colLeft">*******</td>
  </tr>
  <tr>
    <td class="colTitle">暱稱</td>
    <td class="colLeft"><?php echo $_SESSION['nick']; ?></td>
  </tr>
  <tr>
    <td class="colTitle">等級</td>
    <td class="colLeft"><?php echo $lvstr[$_SESSION['level']]; ?></td>
  </tr>
 </table>
</body>
</html>
<?php
  }else{
     echo "非法登入!";
     exit();
}
?>