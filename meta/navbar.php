<?php
if(session_id() == 0) {
    session_start();
  }

  $userid = $_SESSION['idusuario'];

  $select = "SELECT idlogin, login, permissao FROM tb_decomlogin WHERE idlogin = '$userid' AND permissao = 'ALL'";
  $query = mysqli_query($conn, $select);
  $count = mysqli_num_rows($query);

  if($count > 0) {
      $permiall = 1;
  } else {
      $permiall = 0;
  }

  $select1 = "SELECT idlogin, login, permissao FROM tb_decomlogin WHERE idlogin = '$userid' AND permissao = 'ADM'";
  $query1 = mysqli_query($conn, $select1);
  $count1 = mysqli_num_rows($query1);

  if($count1 > 0) {
  	$permivisit = 1;
  } else{
  	$permivisit = 0;
  }
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div class="navbarJR" style="background-color: rgba(15, 145, 227)">
		<?php if($permiall == 1) {
		?>
		<div style="width:60px;" class="dropdownJR">
			<a href="home.php">
				<button class="btn btn-primary btn-lg"><input type=image src="img/019-home.png" height="20px"></button>
			</a>
		</div>
		<div class="dropdownJR" style="margin-right: 0px; margin-left: 0px;">
		  <button class="btn btn-primary" style="margin-right: 0px; margin-left: 0px;"><input type=image src="img/017-folder.png" height="20px"> Cadastro </button>
		  <div class="dropdownJR-content w-100" style="background-color: rgba(15, 145, 227)"><center>
		  	  <a href="cadastro.php"><button class="btn btn-primary w-100 p-100"> Usuario </button></a>
		  	  <a href="interno.php"><button class="btn btn-primary w-100 mt-2 p-2"> Interno </button></a>
		  	  <a href="externo.php"><button class="btn btn-primary w-100 mt-2 p-2"> Externo </button></a>
			  </center>
		  </div>
		</div>

		<div class="dropdownJR" style="margin-right: 0px; margin-left: 0px;">
		  <button class="btn btn-primary" style="margin-right: 0px; margin-left: 0px;"><input type=image src="img/016-file.png" height="20px"> Visualizar </button>
		  <div class="dropdownJR-content w-100" style="background-color: rgba(15, 145, 227)"><center>
		  <a href="visualizar.php"><button class="btn btn-primary"> Eventos </button></a>
		  </center></div>
		</div>

		<div class="dropdownJR" style="margin-right: 0px; margin-left: 0px;">
		  <button class="btn btn-primary" style="margin-right: 0px; margin-left: 0px;"><input type=image src="img/052-clinical.png" height="20px"> Medico </button>
		  <div class="dropdownJR-content w-100" style="background-color: rgba(15, 145, 227)">
		  	<center>
		  		<a href="agendar.php"><button class="btn btn-primary w-100 mt-2 p-2"> Agendar </button></a>
		  		<a href="visualizar_medico.php"><button class="btn btn-primary w-100 mt-2 p-2"> Conferir </button></a>
		  	</center>
		  </div>
		</div>
		
		
		<div style="float:right;width:60px;" class="dropdownJR logout">
			<a href="logout.php">
				<button class="btn btn-danger btn-lg"><input type=image src="img/045-exit.png" height="20px"></button>
			</a>
		</div>
		<?php } ?>

		<?php if($permivisit == 1){
		?>
			<div class="dropdownJR" style="margin-right: 0px; margin-left: 0px;">
		  <button class="btn btn-primary" style="margin-right: 0px; margin-left: 0px;"><input type=image src="img/016-file.png" height="20px"> Visualizar </button>
		  <div class="dropdownJR-content" style="background-color: rgba(15, 145, 227)"><center>
		  <a href="visualizar.php"><button class="btn btn-primary"> Pedidos </button></a>
		  </center></div>
		</div>
		
		<div style="float:right" class="dropdownJR">
			<a href="logout.php"><button class="btn btn-danger btn-lg" style="margin-right: 0px; margin-left: 500px;"><input type=image src="img/045-exit.png" height="20px"></button></a>
		</div>
		<?php } ?>
	</div>
</body>
</html>