<?php
  
  include '../php/conexao.php';

  session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $myusername = mysqli_real_escape_string($conn,$_POST['username']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
    
    $sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    $count = mysqli_num_rows($result);
  
    if($count == 1) {
       $_SESSION['username']= $myusername;
       $_SESSION['login_user'] = $myusername;
       header("location: list.php");
    }else {
       $error = "Your Login Name or Password is invalid";
       echo $error;
    }
 }

?>