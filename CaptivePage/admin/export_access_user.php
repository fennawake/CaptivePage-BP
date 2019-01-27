<?php
include '../php/conexao.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=customer_access.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('User', 'Email', 'Gender', 'Birth Date'));


$id_customer = $_GET['id'];
$sql = "SELECT user, email, gender, birth_date FROM customers WHERE id_customer = '$id_customer'";
$rows = mysqli_query($conn, $sql);
if($rows === FALSE) { 
   die(mysqli_error());
}else{
  $sql2 = "SELECT date_access FROM customers_access WHERE fk_id_customer = '$id_customer'";
  $rows2 = mysqli_query($conn, $sql2);
  if($rows2 === FALSE) { 
    die(mysqli_error());
  }
}

$row = mysqli_fetch_assoc($rows);
fputcsv($output, $row);

$output3 = fopen('php://output', 'w');
fputcsv($output3, array(' ', ' '));

$output2 = fopen('php://output', 'w');
fputcsv($output2, array('data_access'));

while ($row2 = mysqli_fetch_assoc($rows2)){
  fputcsv($output2, $row2);
}

fclose($output);
fclose($output2);
fclose($output3);
?>