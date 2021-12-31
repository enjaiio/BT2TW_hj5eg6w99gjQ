<?php
/*****************************useradmin.php****************************
在會員管理頁面一樣會先判斷連線者是否為會員並且是否為管理者以上等級，如果是管理
者以上的等級，則在此頁面會看到所有會員的資料，並且可以進行修改的功能，當然，未
來會員資料多的時候，可以再加上分頁的功能． 
************************************************************************/
include_once('connect.php');
$lvstr=array("無","路人","客戶","管理者","sysop");
 if(isset($_SESSION['acc']) && $_SESSION['level']>=3){
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>會員管理</title>
<link href="user.css" rel="stylesheet" type="text/css">
</head>
<body>
<table>
 <tr class="headbar">
    <td>歡迎<?php
             echo $_SESSION['acc'];
           ?>(<a href="logout.php" class="logout">登出</a>)</td>
    <td><a href="usercenter.php" class="headStr">個人資料</a></td>
    <td class="headNow"><a href="useradmin.php" class="headStr">會員管理</a></td>
    <td><a href="createacc.php" class="headStr">新增會員</a></td>
 </tr>
</table><br /><br />
<?php
}else{
    echo "非法登入!";
    exit();
}
    $sql="SELECT * FROM myuser";
    $ro=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($ro);
?>
<table class="userlist" >
<?php
do{
$editstr="u_no=".$row['u_no'].
         "&u_acc=".$row['u_acc'].
         "&u_nick=".$row['u_nick'].
         "&u_lv=".$row['u_lv'].
         "&u_avatar=".$row['u_avatar'];
?>
 <tr>
    <td rowspan="4" class="headpic">
      <img src="pic/<?php echo $row['u_avatar']; ?>" width="200px" /></td>
    <td class="title">編號 :<?php echo $row['u_no']; ?></td>
    <td rowspan="4" class="edit"><a href="editacc.php?<?php
                                                        echo $editstr; 
                                                      ?>">修改</a></td>
 <tr>
    <td class="title">帳號 :<?php echo $row['u_acc']; ?></td>
 </tr>
 <tr>
    <td class="title">暱稱 :<?php echo $row['u_nick']; ?></td>
 </tr>
 <tr>
    <td class="title">身份 :<?php echo $lvstr[$row['u_lv']]; ?></td>
 </tr>
<?php
  }while($row=mysqli_fetch_assoc($ro));
?>
</table>
</body>
</html> 