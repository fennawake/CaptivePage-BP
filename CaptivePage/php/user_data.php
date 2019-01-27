<?php

include 'conexao.php';

$id_user      = $_POST['id'];
$name_user    = $_POST['name'];
$email_user   = $_POST['email'];
$picture_user = $_POST['picture']["data"]['url'];
$date = date("Y-m-d");
//$birth_user   = $_POST['birth_user'];
//$gender_user  = $_POST['gender'];

$sql = "SELECT * FROM customers WHERE email='$email_user' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


  if( $row['email'] != $email_user ){
    $query = "INSERT INTO customers (id_facebook, user, email, picture_url, gender, birth_date, first_access) VALUES ('$id_user', '$name_user','$email_user', '$picture_user', '', '', '$date')";
    $insert = mysqli_query($conn, $query);
    
    if(mysqli_affected_rows($conn) != 0){
?>
      <script>window.location.href = "https://www.instagram.com/burleighpavilion/";</script>
<?php
    }else{
      header('Location: index.html?msg="userDataFailed"'); 
    }
  }else{
    $query = "INSERT INTO customers (id_facebook, user, email, picture_url, gender, birth_date, first_access) VALUES ('', 'JA TINHA','', '', '', '', '$date')";
    $insert = mysqli_query($conn, $query);
  
      if(mysqli_affected_rows($conn) != 0){
?>
        <script>window.location.href = "https://www.instagram.com/burleighpavilion/";</script>
<?php
      }else{
        header('Location: index.html?msg="userDataFailed"'); 
      }
  }

?>