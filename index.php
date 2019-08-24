<!DOCTYPE html>	
<html>
	<head>
		<link rel="shortcut icon" href="img/icon.png" type="image/png" />
		<meta charset="utf-8">
		<title>Login | Sistema IGOR</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	</head>
	<body style="font-family: helvetica;">
		<?php
			session_start();
			include('conn.php');
			if(!empty($_SESSION['cod'])){
				header("location: home.php");
			}
		?>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<form method="post">
					<legend align="center"><h2>Login</h2></legend><br>
					<div class="input-group">
      					<span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
	    				<input type="text" name="cpf" class="cpf form-control" id="cpf" placeholder="CPF" required="">
	  				</div><br>
	  				<div class="input-group">
	    				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    				<input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" required="">
	  				</div><br>
	  				<center><button type="submit" class="btn btn-primary" title="Entrar">Entrar</button>
	  				<button type="reset" class="btn btn-danger" title="Limpar">Limpar</button></center><br>
	  				<p align="center"><a href="senha.php">Esqueci minha senha</a>. | <a href="cadastro.php">Sou novo e desejo me cadastrar</a>.</p>
	  			</form>
			</div>
		</div><br>
		<div class="row">
			<div class="col-md-4">
			</div>
			<?php
				if(isset($_POST['cpf'])){
					$cpf = $_POST['cpf'];
					$senha = md5($_POST['senha']);
					$sql = "select * from tb_usuario usu where vl_cpf = '$cpf' and ds_senha = '$senha'";
					$result = $mysqli->query($sql);
					if($result->num_rows == 0){
						echo "<center><div class='col-md-4'><div class='alert alert-danger'><strong>ERRO:</strong> Dados incorretos. Tente novamente.</div></div></center>";
					}
					else{
						$row = $result->fetch_object();
						$_SESSION['cod'] = $row->cd_usuario;
						echo "<script type='text/javascript'>window.location.href = 'home.php'; alert('Bem-vindo(a), ".$row->nm_usuario."!'); </script>";
					}
				}
			?>
		</div>
	</body>
	<script type="text/javascript">
		$('.cpf').mask('000.000.000-00');
	</script>
</html>