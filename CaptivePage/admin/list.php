<?php
   include('session.php');
   include '../php/conexao.php';
?>
<!doctype html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/custom-style.css">

		<link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">

		<title>Burleigh Pavilion - Mailing list</title>
	</head>
	
	<body>
		<div class="container">			
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 center-content h-20">
						<div class="jumbotron border rounded">
								<div class="row">
									<div class="col-12">
										<img src="../img/logo.png" class="mx-auto d-block" alt="Burleigh Pavilion">
									</div>
								</div>
				
								<div class="row">
									<div class="col-12 h-40">	
									<table class="table">
                    <thead>
                      <tr>
                        <th>
                          <a href="export.php" class="export">export to csv</a>                         
                        </th>
                        <th></th>
                        <th class="right">
                          Welcome to admin area <strong><em><?php echo $login_session; ?></em></strong>
                          <a href="logout.php" class="logout">[Sign Out]</a>
                        </th>
                      </tr>
                    </thead>
                  </table>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th class="center" scope="col">Gender</th>
												<th class="center" scope="col">Birth</th>
												<th class="center" scope="col">Access</th>
												<th class="center" scope="col">First Access</th>
												<th class="center" scope="col">Last Access</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $query = sprintf("SELECT * FROM customers");
                        $result = mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												$i = 1;
												
  
                        if($row != 0){
                          do {

														$id_customer 	= $row['id_customer'];
														$user					= $row['user'];
														$email 				= $row['email'];
														$gender				= $row['gender'];
														$birth				= $row['birth_date'];
														$first_access = $row['first_access'];
                      ?>
                            <tr>
                              <th scope="row">
																<?php 
                                  echo $i;
                                  $i = $i + 1;
                                ?>
															</th>
                              <th><a class="color-gray no-bold" href="list_user.php?id=<?=$id_customer;?>&page=1"><?=$user?></a></th>
                              <th><?=$email?></th>
                              <th class="center"><?=$gender?></th>
															<th class="center"><?=$birth?></th>
															<th class="center">
																<?php

																	$sql_access = "SELECT * FROM customers_access WHERE fk_id_customer='$id_customer'";
																	$result_access = mysqli_query($conn, $sql_access);
																	$num_rows_access = mysqli_num_rows($result_access);
																	if($num_rows_access != 0){
																		echo $num_rows_access;
																	}else{
																		echo "1";
																	}
																?>
															</th>
															<th class="center"><?=$first_access?></th>

															<?php
																$sql_date = "SELECT date_access FROM customers_access WHERE fk_id_customer='$id_customer' ORDER BY date_access DESC LIMIT 1 ";
																$result_date = mysqli_query($conn, $sql_date);
																$row_date = mysqli_fetch_assoc($result_date);
																$date_access = $row_date['date_access'];
															?>

															<th class="center"><?=$date_access;?></th>
                            </tr>
                      <?php
                          }while($row = mysqli_fetch_assoc($result));
                        }
                      ?>

                    </tbody>
                  </table>
									</div>
								</div>
						</div>
				</div>

			</div>
		</div>
	
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	</body>
</html>