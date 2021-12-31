<?php
/*****************************createacc.php****************************** 
新增會員的頁面較簡單，只要注意上傳檔案的處理，就沒什麼大問題了 ．
************************************************************************/
include('connect.php');
if(isset($_SESSION['acc']) && $_SESSION['level']>=3){
?>
<DOCTYPE html>
<html>
<head>
<title>新增會員</title>
<link href="user.css" rel="stylesheet" type="text/css">
</head>
<body>
 <table>
  <tr class="headbar">
    <td>歡迎<?php
             echo $_SESSION['acc']; 
           ?>(<a href="logout.php" class="logout">登出</a>)
    </td>
    <td><a href="usercenter.php" class="headStr">個人資料</a></td>
    <td><a href="useradmin.php" class="headStr">會員管理</a></td>
    <td class="headNow">
      <a href="createacc.php" class="headStr">新增會員</a>
    </td>
  </tr>
 </table><br /><br />
<?php
  }else{
     echo "非法登入!";
     exit();
  }

$settime=strtotime('+7 hours');
$gettime=date('YmdHis',$settime);

if(!empty($_POST['u_acc'])){
   $u_acc=$_POST['u_acc'];
   $u_pw=md5($_POST['u_pw']);
   $u_lv=$_POST['u_lv'];
   $u_nick=$_POST['u_nick'];

   $p_name=$_FILES['u_avatar']['name'];     //檔案名稱
   $p_tmp=$_FILES['u_avatar']['tmp_name']; //檔案位置
   $p_size=$_FILES['u_avatar']['size'];     //檔案大小
   $p_type=$_FILES['u_avatar']['type'];     //檔案類別

   if(($p_type=="image/jpeg") || ($p_type=="image/png")){
       $u_avatar=$gettime.".".substr(strrchr($p_name, '.'), 1);
     }else{
       echo "檔案格式不合規定!";
       unlink($p_tmp);
       exit();
     }
     copy($p_tmp,"pic/".$u_avatar);
     unlink($p_tmp);
     $sql="INSERT INTO myuser 
           VALUE(NULL,'$u_acc','$u_pw','$u_nick','$u_lv','$u_avatar');";
     mysqli_query($link,$sql);
  }
?>
<form action="createacc.php" method="post"  enctype="multipart/form-data">
 <table class="edituser">
  <tr>
    <td class="title">帳號</td>
    <td class="content"><input name="u_acc" type="text" value="" /></td>
  </tr>
  <tr>
    <td class="title">密碼</td>
    <td class="content"><input name="u_pw" type="password" value="" /></td>
  </tr>
  <tr>
    <td class="title">暱稱</td>
    <td class="content"><input name="u_nick" type="text" value="" /></td>
  </tr>
  <tr>
    <td class="title">頭像</td>
    <td class="content"><input name="u_avatar" type="file" value="" /></td>
  </tr>
  <tr>
    <td class="title">等級</td>
    <td class="content">
      <select name="u_lv" />
        <option value="1">路人</option>
        <option value="2">客戶</option>
        <option value="3">管理者</option>
        <option value="4">Sysop</option>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center;">
      <input name="" type="submit" value="確認新增" />
    </td>
  </tr>
 </table>
</form>
</body>
</html>