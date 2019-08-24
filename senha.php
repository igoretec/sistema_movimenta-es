<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="img/icon.png" type="image/png" />
		<meta charset="utf-8">
		<title>Senha | Sistema IGOR</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	</head>
	<body style="font-family: helvetica;">
		<?php
			include('conn.php');
			session_start();
			date_default_timezone_set('UTC');
			if(isset($_GET['id']) && $_GET['id'] == 'alterar'){
				if(empty($_SESSION['cod'])){
					header("location: index.php");
				}
			}
			else{
				if(!empty($_SESSION['cod'])){
					header("location: home.php");
				}
			}
		?>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<form method="post">
					<legend align="center"><h2>
					<?php
						if(isset($_GET['id']) && $_GET['id'] == 'alterar'){
							echo "Alterar ";
						}
						else{
							echo "Recuperar ";
						}
					?>
					Senha</h2></legend><br>
					<div class="input-group">
	    				<span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
	    				<input type="text" name="cpf" class="cpf form-control" id="cpf" placeholder="CPF" required="">
	  				</div><br>
	  				<?php
						if(isset($_GET['id']) && $_GET['id'] == 'alterar'){
							echo '<div class="input-group">
      					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    				<input type="text" name="senha" class="form-control" id="senha" placeholder="Senha atual" required="">
	  				</div><br><div class="input-group">
      					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    				<input type="text" name="nsenha" class="form-control" id="senha" placeholder="Nova senha" required="">
	  				</div><br>';
						}
						else{
							echo '<div class="input-group">
      					<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
	    				<input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required="">
	  				</div><br>';
						}
					?>
	  				<center><button type="submit" class="btn btn-primary">
	  				<?php
						if(isset($_GET['id']) && $_GET['id'] == 'alterar'){
							echo "Alterar ";
						}
						else{
							echo "Receber ";
						}
					?>
	  				senha</button>
	  					<button type="reset" class="btn btn-danger">Limpar</button></center>
	  			</form>
			</div>
		</div><br>
		<div class="row">
			<?php
				if(isset($_GET['id']) && $_GET['id'] == 'alterar'){
					if(isset($_POST['cpf'])){
						$cpf = $_POST['cpf'];
						$senha = md5($_POST['senha']);
						$nsenha = md5($_POST['nsenha']);
						$cod = $_SESSION['cod'];
						$sql = "SELECT * from tb_usuario where vl_cpf = '$cpf' and cd_usuario = '$cod' and ds_senha = '$senha'";
						$result = $mysqli->query($sql);
						if($result->num_rows > 0){
							$row = $result->fetch_object();
							if($nsenha != $row->ds_senha){
								$sql = "UPDATE tb_usuario set ds_senha = '$nsenha' where cd_usuario = ".$row->cd_usuario;
								if(!$mysqli->query($sql)){
									printf("error %s\n" , $mysqli->error);
								}
								else{
									echo "<script type='text/javascript'>alert('Senha alterada com sucesso!'); window.location.href = 'home.php';</script>";
								}
							}
							else{
								echo '<div class="col-md-3"></div>';
								echo "<center><div class='col-md-6'><div class='alert alert-warning'><strong>AVISO:</strong> As senhas atual e nova não podem ser iguais. Tente novamente.</div></div></center>";
							}
						}
						else{
							echo '<div class="col-md-4"></div>';
							echo "<center><div class='col-md-4'><div class='alert alert-danger'><strong>ERRO:</strong> Senha atual e/ou CPF incorretos.</div></div></center>";
						}
					}
				}
				else{
					if(isset($_POST['cpf'])){
						$cpf = $_POST['cpf'];
						$email = $_POST['email'];
						$sql = "SELECT * from tb_usuario where vl_cpf = '$cpf' and ds_email = '$email'";
						$result = $mysqli->query($sql);
						if($result->num_rows > 0){
							$row = $result->fetch_object();
							$nsenha = substr(md5(time()), 0, 6);
							$from = $row->ds_email;
							$mensagem = 'Recebemos sua solicitação de senha!'."\n\r".'Sua nova senha é '."".$nsenha;
							$assunto = 'SISTEMA DE MOVIMENTAÇÕES';
							/*
							----------------SISTEMA EM MANUTENÇÃO (NÃO FUNCIONA EM SERVIDORES LOCAIS)---------------
							if(mail($from, $assunto, $mensagem)){
								$sql = "UPDATE tb_usuario set ds_senha = '$nsenha' where cd_usuario = ".$row->cd_usuario;
								if($mysqli->query($sql)){
								    echo "<script type='text/javascript'>alert('Sua nova senha foi enviada para o e-mail ".$from.". A nova senha estará sujeta a alterações posteriores.'); window.location.href = 'index.php';</script>";
								}
								else{
								    printf("error %s\n" , $mysqli->error);
								}
							}
							else{
							    echo "<div class='col-md-3'></div>";
							    echo "<center><div class='col-md-6'><div class='alert alert-warning'><strong>AVISO:</strong> Não foi possível enviar o e-mail de solicitação de senha.</div></div></center>";
							}
							----------------SISTEMA EM MANUTENÇÃO (NÃO FUNCIONA EM SERVIDORES LOCAIS)---------------*/
							echo "<br><center><img src='img/aviso.jpg'><br>OBS: não funciona em servidores locais.</center>";
						}
						else{
						    echo "<div class='col-md-4'></div>";
							echo "<center><div class='col-md-4'><div class='alert alert-danger'><strong>ERRO:</strong> E-mail e/ou CPF incorretos.</div></div></center>";
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