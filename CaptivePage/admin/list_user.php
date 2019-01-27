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

                <?php 
                  $id_customer = $_GET['id'];
                  $page = ( isset($_GET['page']) ) ? $_GET['page'] : 1; 
                ?>
				
								<div class="row">
									<div class="col-12 h-40">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>
                          <a href="list.php" class="back">back to list</a> |
                          <a href="export_access_user.php?id=<?=$id_customer?>" class="export">export to csv</a>                         
                        </th>
                        <th></th>
                        <th class="right">
                          Welcome to admin area <strong><em><?php echo $login_session; ?></em></strong>
                          <a href="logout.php" class="logout">[Sign Out]</a>
                        </th>
                      </tr>
                    </thead>
                  </table>

                  <?php
                    $query1  = "SELECT user, first_access FROM customers WHERE id_customer = '$id_customer'";
                    $result1 = mysqli_query($conn, $query1);
                    $row1    = mysqli_fetch_assoc($result1);
                    $rows    = mysqli_num_rows($result1);
                    $user    = $row1['user'];
                    $first_access = $row1['first_access'];

                    $query = "SELECT * FROM customers_access WHERE fk_id_customer = '$id_customer'";
                    $row_customers = mysqli_query($conn,$query); 
                    $total = mysqli_num_rows($row_customers); 
                  ?>


                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th colspan="2">Customer: <?=$user;?> <br> Access: <? if($total === 0){echo "1";}else{echo $total;}?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php   
                        $i = 1;
                        
                        
                        $registers = 5; 
                        $numPages = ceil($total/$registers); 
                        $start = ($registers*$page)-$registers; 

                        $query = "SELECT * FROM customers_access WHERE fk_id_customer = '$id_customer' limit $start, $registers";
                        $row_customers = mysqli_query($conn, $query); 
                        $total = mysqli_num_rows($row_customers); 

                        if($total != 0){

                          while($result = mysqli_fetch_array($row_customers)){
                            $date_access = $result['date_access'];
                      ?>
                            <tr>
                              <th width="5%">
                                <?php 
                                  echo $i;
                                  $i = $i + 1;
                                ?>
                              </th>
                              <th><?=$date_access?></th>
                            </tr>
                      <?php
                          }
                        }else{
                      ?>
                        <tr>
                          <th width="5%">1</th>
                          <th scope="row"><?=$first_access?></th>
                        </tr>
                      <?php
                        }
                      ?>
                      <tr>
                        <th colspan="2" class="center paginacao">
                          <?php
                            for($i = 1; $i < $numPages + 1; $i++) {
                              if($page == $i){
                                echo "<a href='list_user.php?id=$id_customer&page=$i' class='active'>".$i."</a> "; 
                              }else{
                                echo "<a href='list_user.php?id=$id_customer&page=$i' class=''>".$i."</a> ";  
                              }
                            }
                          ?>
                        </th>
                      </tr>
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