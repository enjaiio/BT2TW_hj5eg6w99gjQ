include('connect.php');
if(!empty($_POST['u_acc'])){
  $u_acc=$_POST['u_acc'];
  $u_pw=md5($_POST['u_pw']);
  $sql="SELECT * FROM myuser Where u_acc='$u_acc' && u_pw='$u_pw'";
  $ro=mysqli_query($link,$sql);
  $row=mysqli_fetch_assoc($ro);
  $total=mysqli_num_rows($ro);
  if($total==1){
     echo "登入成功!";
     $_SESSION['u_no']=$row['u_no'];
     $_SESSION['acc']=$row['u_acc'];
     $_SESSION['level']=$row['u_lv'];
     $_SESSION['nick']=$row['u_nick'];
     $_SESSION['avatar']=$row['u_avatar'];
     header('location:usercenter.php');
  }else{
     echo "帳密錯誤!";
  }
}
?>
<DOCTYPE html>
<html>
<head>
<title>會員登入</title>
<style>
#LoginWrap{
 border:1px solid #000;
 margin-left:auto;
 margin-top:15%;
 margin-right:auto;
 width:260px;
 height:110px;
 padding-top:40px;
 padding-left:40px;
}
</style>
</head>
<body>
<div id="LoginWrap">
<form action="login.php" method="post">
 <table width="100%">
   <tr>
      <td>帳號</td>
      <td><input name="u_acc" type="text" value="" /></td>
   </tr>
   <tr>
      <td>密碼</td>
      <td><input name="u_pw" type="password" value="" /></td>
   </tr>
   <tr>
      <td colspan="2" style="text-align:center;">
        <input name="" type="submit" value="登入" /></td>
  </tr>
 </table>
</form>
</div>
</body>
</html>