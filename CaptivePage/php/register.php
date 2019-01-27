<?php
  include 'conexao.php';

  $name_user   = $_POST['name'];
  $email_user  = $_POST['email'];
  $birth_user  = $_POST['birth'];
  $gender_user = $_POST['gender'];
  date_default_timezone_set('Australia/Brisbane');
  $date        = date("Y-m-d");
  $date2       = date('Y-m-d H:i:s');

  $sql = "SELECT * FROM customers WHERE email='$email_user' ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $id_customer = $row['id_customer'];

  if( $row['email'] != $email_user ){
    $query = "INSERT INTO customers (id_facebook, user,email, picture_url, gender, birth_date, first_access) VALUES ('', '$name_user','$email_user', '', '$gender_user', '$birth_user', '$date')";
    $insert = mysqli_query($conn, $query);

    if(mysqli_affected_rows($conn) != 0){
?>
      <script>window.location.href = "https://www.instagram.com/burleighpavilion/";</script>
<?php
    }else{
      header('Location: index.html?msg="userDataFailed"'); 
    }
  }else{
    $query = "INSERT INTO customers_access (fk_id_customer, date_access) VALUES ('$id_customer','$date2')";
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