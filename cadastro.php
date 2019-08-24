<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="img/icon.png" type="image/png" />
		<meta charset="utf-8">
		<title>Cadastro | Sistema IGOR</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	</head>
	<body style="font-family: helvetica;">
		<?php
			include('conn.php');
			date_default_timezone_set('UTC');
			session_start();
			if(!empty($_SESSION['cod'])){
				header("location: home.php");
			}
		?>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<form method="post">
					<legend align="center"><h2>Cadastro</h2></legend><br>
					<div class="input-group">
      					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	    				<input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" required="">
	  				</div><br>
	  				<div class="input-group">
	    				<span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
	    				<input type="text" name="rg" class="rg form-control" id="rg" placeholder="RG" required="">
	  				</div><br>
	  				<div class="input-group">
	    				<span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
	    				<input type="text" name="cpf" class="cpf form-control" id="cpf" placeholder="CPF" required="">
	  				</div><br>
					<div class="input-group">
	    				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
	    				<input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required="">
	  				</div><br>
	  				<div class="input-group">
	    				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    				<input type="password" name="senha" class="form-control" id="pwd" placeholder="Senha" required="">
	  				</div><br>
	  				<center><button type="submit" class="btn btn-success">Cadastrar</button>
	  				<button type="reset" class="btn btn-danger">Limpar</button></center>
	  			</form>
			</div>
		</div><br>
		<div class="row">
			<div class="col-md-3">
			</div>
			<?php
				if(isset($_POST['nome'])){
					$nome = $_POST['nome'];
					$cpf = $_POST['cpf'];
					$rg = $_POST['rg'];
					$email = $_POST['email'];
					$senha = md5($_POST['senha']);
					$date = date('Y-m-d');
					$sql = "select * from tb_usuario where vl_cpf = '$cpf' or vl_rg = '$rg' or ds_email = '$email'";
					$result = $mysqli->query($sql);
					if($result->num_rows > 0){
						$row = $result->fetch_object();
						if($row->ds_email == $email){
							echo "<div class='col-md-6'><div class='alert alert-warning'><strong>AVISO:</strong> O e-mail solicitado já se encontra em uso. Tente novamente.</div></div>";
						}
						else{
							echo "<center><div class='col-md-6'><div class='alert alert-danger'><strong>ERRO:</strong> Dados pessoais inseridos já existentes. Tente novamente.</div></div></center>";
						}
					}
					else{
						$sql = "insert into tb_usuario values(null, '$nome', '$senha', '$email', '$rg', '$cpf', '$date');";
						if(!$mysqli->query($sql)){
							printf("error %s\n" , $mysqli->error);
						}
						else{
							echo "<script type='text/javascript'>alert('Usuário cadastrado com sucesso!'); window.location.href = 'index.php';</script>";
						}
					}
				}
			?>
		</div>
	</body>
	<script type="text/javascript">
		$('.cpf').mask('000.000.000-00');
		$('.rg').mask('00.000.000-0');
	</script>
</html>