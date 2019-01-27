<?php
include '../php/conexao.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=customers.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('User', 'Email', 'Gender', 'Birth Date'));

$sql = "SELECT user, email, gender, birth_date FROM customers";
$rows = mysqli_query($conn, $sql);
if($rows === FALSE) { 
   die(mysqli_error());
}

while ($row = mysqli_fetch_assoc($rows)){
  fputcsv($output, $row);
}
?>