<?php
/*****************************editacc.php*******************************
修改會員資料的頁面其實可以和新增會員的頁面做在一起，但為了未來管理程式碼的方便，
所以還是決定拆成兩個檔案來製作，這裏比較需要注意的地方還是在於上傳相片的管理及資
料庫資料更新的同步上，另外，修改會員的功能可以同時增加對資料判斷，比如資料如果沒
有更新就不做連線資料庫的動作，或是如果沒有上傳相片也可以更新資料之類的，修改完畢
後則是直接導回會員管理頁面．
************************************************************************/
include('connect.php');
if(isset($_SESSION['acc']) && $_SESSION['level']>=3){
?>
<DOCTYPE html>
<html>
<head>
<title>修改會員資料</title>
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
   <td class="headNow"><a href="useradmin.php" class="headStr">會員管理</a></td>
   <td><a href="createacc.php" class="headStr">新增會員</a></td>
 </tr>
</table><br /><br />
<?php
}else{
  echo "非法登入!";
  exit();
 }
if(isset($_GET['u_acc'])){
  $u_no=$_GET['u_no'];
  $u_acc=$_GET['u_acc'];
  $u_lv=$_GET['u_lv'];
  $u_nick=$_GET['u_nick'];
  $u_avatar=$_GET['u_avatar']; 
}else{
  $u_no="";
  $u_acc="";
  $u_lv="";
  $u_nick="";
  $u_avatar=""; 
}
if(isset($_POST['u_acc'])){
  $u_no=$_POST['u_no'];
  $u_acc=$_POST['u_acc'];
  $u_pw=md5($_POST['u_pw']);
  $u_lv=$_POST['u_lv'];
  $u_nick=$_POST['u_nick'];
  $u_avatar=$_POST['u_avatar'];
  $p_name=$_FILES['u_upload']['name'];     //檔案名稱
  $p_tmp=$_FILES['u_upload']['tmp_name']; //檔案位置
  $p_size=$_FILES['u_upload']['size'];     //檔案大小
  $p_type=$_FILES['u_upload']['type'];     //檔案類別
   if(($p_type=="image/jpeg") || ($p_type=="image/png")){
     }else{
       echo "檔案格式不合規定!";
       unlink($p_tmp);
       exit();
     }
       copy($p_tmp,"pic/".$u_avatar);
       unlink($p_tmp);  
      $sql="UPDATE myuser
            SET u_acc='".$u_acc."',
                u_pw='".$u_pw."',
                u_lv=".$u_lv.",
                u_nick='".$u_nick."'
          WHERE u_no=".$u_no."; ";
      mysqli_query($link,$sql);
      header("location:useradmin.php");
    }
?>
<form action="editacc.php" method="post"  enctype="multipart/form-data">
<table class="edituser">
  <tr>
    <td class="title">帳號</td>
    <td class="content">
       <input name="u_acc" type="text" value="<?php echo $u_acc;?>" />
    </td>
       <input name="u_no" type="hidden" value="<?php echo $u_no;?>" />
    </td>
  </tr>
  <tr>
    <td class="title">密碼</td>
    <td class="content">
      <input name="u_pw" type="password" value="*******" />
    </td>
  </tr>
  <tr>
    <td class="title">暱稱</td>
    <td class="content">
      <input name="u_nick" type="text" value="<?php echo $u_nick;?>" />
    </td>
  </tr>
  <tr>
    <td class="title">頭像</td>
    <td class="content"><input name="u_upload" type="file" value="" />
      <input name="u_avatar" type="hidden" value="<?php echo $u_avatar;?>">
    </td>
  </tr>
  <tr>
    <td class="title">等級</td>
    <td class="content">
      <select name="u_lv" />
        <option value="1" <?php echo ($u_lv==1)?"selected":"";; ?>>路人</option>
        <option value="2" <?php echo ($u_lv==2)?"selected":"";; ?>>客戶</option>
        <option value="3" <?php echo ($u_lv==3)?"selected":"";; ?>>管理者</option>
        <option value="4" <?php echo ($u_lv==4)?"selected":"";; ?>>Sysop</option>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center;">
      <input name="" type="submit" value="確認修改" />
    </td>
  </tr>
</table>
</form>
</body>
</html>