<?php
　
/*************************logout.php************************************
logout是最簡單的功能，把變數值清空後，再unset完就導回login頁就可以了． 
***********************************************************************/
session_start();
 $_SESSION['acc']=NULL;
 $_SESSION['nick']=NULL;
 $_SESSION['level']=NULL;
 $_SESSION['avatar']=NULL;
 unset($_SESSION['acc']);
 unset($_SESSION['nick']);
 unset($_SESSION['level']);
 unset($_SESSION['avatar']);
 header('location:login.php');
?>