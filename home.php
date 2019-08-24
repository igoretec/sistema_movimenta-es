<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="img/icon.png" type="image/png" />
		<meta charset="utf-8">
		<title>Home | Sistema IGOR</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script> 
	</head>
	<?php
		include('conn.php');
		date_default_timezone_set('UTC');
		session_start();
		if(empty($_SESSION['cod'])){
			header("location: index.php");
		}
	?>
	<body style="font-family: helvetica;">
		<div class="row" style="padding-top: 12px;">
			<div class="col-md-2" align="center" style="padding-top: 9px;">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><button type="button" style="border-radius: 100%;" class="btn btn-default btn-lg" title="Menu"><span class="glyphicon glyphicon-home"></span></button>
       			</a>
		      	<ul class="dropdown-menu">
		      	 	<li style="padding-left: 10px;">
		      	 		<a href="#" title="Minha conta" data-toggle="modal" data-target="#myModalPerfil">Minha conta</a>
		      	 	</li>
		      	 	<li style="padding-left: 10px;"><a href="senha.php?id=alterar" title="Sair">Alterar senha</a></li>
		      	  	<li style="padding-left: 10px;"><a href="home.php?id=0" title="Sair">Sair</a></li>
		      	</ul>
		      	<div id="myModalPerfil" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
						    <div class="modal-header">
						    <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Minha conta</h4>
						    </div>
						    <div class="modal-body">
						        <p align="left">
						        	<?php
						        		$sql = "SELECT * from tb_usuario where cd_usuario = ".$_SESSION['cod'];
						        		$result = $mysqli->query($sql);
						        		$row = $result->fetch_object();
						        	?>
						        	<form>
									  	<div class="input-group">
									    	<span class="input-group-addon"><b>Nome:</b></span>
									    	<input id="nome" type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo $row->nm_usuario; ?>" readonly="">
									    	<span class="input-group-addon"><b>CPF:</b></span>
									    	<input id="msg" type="text" class="form-control cpf" name="cpf" placeholder="CPF" value="<?php echo $row->vl_cpf; ?>" readonly="">
									  	</div><br>
									  	<div class="input-group">
									  		<span class="input-group-addon"><b>E-mail:</b></span>
									    	<input id="email" type="text" class="form-control" name="email" placeholder="E-mail" value="<?php echo $row->ds_email; ?>" readonly="">
									    	<span class="input-group-addon"><b>RG:</b></span>
									    	<input id="password" type="text" class="form-control rg" name="rg" placeholder="Senha" value="<?php echo $row->vl_rg; ?>" readonly="">
									  	</div><br>
									  	<div class="input-group">
									  		<span class="input-group-addon"><b>Data de criação:</b></span>
									    	<input id="data" type="date" class="form-control" name="data" value="<?php echo $row->dt_criacao; ?>" readonly="">
									    	<span class="input-group-addon"><b>Movimentações ativas:</b></span>
									    	<input id="mov" type="text" class="form-control" name="mov" value=
									    	<?php
									    		$sql = "SELECT * from tb_movimentacao where id_usuario = ".$_SESSION['cod'];
									    		$result = $mysqli->query($sql);
									    		if($result->num_rows < 9 && $result->num_rows != 0){
									    			echo "0".$result->num_rows;
									    		}
									    		else{
									    			echo $result->num_rows;
									    		}
									    	?>
									    	readonly="">
									  	</div>
									</form>
						    	</p>
						    </div>
						    <div class="modal-footer">
						       	<button type="button" class="btn btn-default" data-dismiss="modal" title="Fechar">Fechar</button>
						    </div>
						</div>
					</div>
				</div>
			</div> 	
			<div class="col-md-3" align="left">
				<h3>Movimentações</h3>
			</div>
			<form method="post">
				<div class="col-md-3" style="margin-top: 15px;" align="right">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						<select class="form-control" name="mes" id="mes" style="width: 80%;" title="Meses do ano">
							<option value="00">Todos os meses</option>
							<option value="01">Janeiro</option>
							<option value="02">Fevereiro</option>
							<option value="03">Março</option>
							<option value="04">Abril</option>
							<option value="05">Maio</option>
							<option value="06">Junho</option>
							<option value="07">Julho</option>
							<option value="08">Agosto</option>
							<option value="09">Setembro</option>
							<option value="10">Outubro</option>
							<option value="11">Novembro</option>
							<option value="12">Dezembro</option>
						</select>
					<button type="submit" class="btn btn-default" style="margin-left: 3px;" title="Ir">Ir</button></div>
				</div>
			</form>
			<div class="col-md-3" align="right" style="padding-top: 9px;">

				<!-- Botão do modal de adicionar movimentações -->
				<button type="button" style="border-radius: 100%;" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModalMOV" title="Adicionar nova movimentação"><span class='glyphicon glyphicon-plus'></span></button>

				<!-- Modal -->
				<div id="myModalMOV" class="modal fade" role="dialog">
					<div class="modal-dialog">

						<!-- Parte que não devo editar-->
						<div class="modal-content">
							<div class="modal-header" align="center">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Adicionar Movimentação</h4>
							</div>
							<div class="modal-body">
								<p><form method='post'>
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<select class="form-control" name="bene1">
											<option value="">Selecionar beneficiario</option>
											<?php
												$sql = "SELECT * from tb_beneficiario";
												$result = $mysqli->query($sql);
												while($row = $result->fetch_object()){
													echo "<option value=".$row->cd_beneficiario.">".$row->nm_beneficiario."</option>";
												}
											?>
										</select>
										<span class='input-group-addon'><b><i>Ou</i></b></span>
										<input type='text' name='ben1' class='form-control' placeholder="Adicionar novo">
									</div><br>
									<div class='input-group'>
										<span class='input-group-addon'><i><span class='glyphicon glyphicon-list-alt'></span></i></span>
										<textarea name='movimentacao1' class='form-control' placeholder="Descrição da movimentação..."></textarea>
									</div><br>
									<div class='from-group' align="left">
										<b>Tipo de Movimentação:</b>
										<?php
											$sql = "SELECT * from tb_tipo";
											$result = $mysqli->query($sql);
											$x = 1;
											while($row = $result->fetch_object()){
												if($x == 1){
													echo "<label class='radio-inline'><input type='radio' name='tipo1' value=".$row->cd_tipo." checked>".$row->nm_tipo."</label>";
												}else{
													echo "<label class='radio-inline'><input type='radio' name='tipo1' value=".$row->cd_tipo.">".$row->nm_tipo."</label>";
												}
												$x++;
											}
										?>
									</div><br>
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
										<select class="form-control" name="cat1">
											<option value="">Selecionar categoria</option>
											<?php
												$sql = "SELECT * from tb_categoria";
												$result = $mysqli->query($sql);
												while($row = $result->fetch_object()){
													echo "<option value=".$row->cd_categoria.">".$row->nm_categoria."</option>";
												}
											?>
										</select>
										<span class='input-group-addon'><b><i>Ou</i></b></span>
										<input type='text' name='cate1' class='form-control' placeholder="Adicionar nova">
									</div><br>
									<div class='input-group'>
										<span class='input-group-addon'><i class="glyphicon glyphicon-usd"></i></span>
										<input type="text" id="dinheiro" name="dinheiro1" placeholder="Valor" class="form-control">
										<span class='input-group-addon'><i><span class='glyphicon glyphicon-calendar'></span></i></span>
										<input type='date' name='data1' class='form-control' placeholder="">
									</div><br>
									<div class='form-group' align="left">
										<b>Forma de Pagamento:</b><br><br>
										<?php
											$sql = "SELECT * from tb_forma";
											$result = $mysqli->query($sql);
											$x = 1;
											while($row = $result->fetch_object()){
												if($x == 1){
													echo "<label class='radio-inline'><input type='radio' name='forma1' value=".$row->cd_forma." checked>".$row->nm_forma."</label>";
												}
												else{
													echo "<label class='radio-inline'><input type='radio' name='forma1' value=".$row->cd_forma.">".$row->nm_forma."</label>";
												}
												if($x%3 == 0){
													echo "<br><br>";
												}
												$x++;
											}
										?>
									</div>
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> Usuário</span>
										<?php
											$sql = "SELECT * from tb_usuario where cd_usuario = ".$_SESSION['cod'];
											$result = $mysqli->query($sql);
											$row = $result->fetch_object();
											echo "<input type='text' name='usuario1' class='form-control' title='Usuário' disabled value='".$row->nm_usuario."'>";
										?>
										<span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
										<?php
											echo "<input type='text' name='cpf1' class='form-control' disabled title='CPF' value='".$row->vl_cpf."'>";
										?>
									</div>
										<!-- Parte que não devo editar-->
									</p></div>
									<div class='modal-footer'>
										<button type="submit" class="btn btn-success" title="Adicionar">Adicionar</button>
										<button type='button' class='btn btn-danger' data-dismiss='modal' title="Cancelar">Cancelar</button>
									</div></form>
								</div>
							</div>
						</div>
					<?php
						if(isset($_POST['movimentacao1'])){
							$descricao = $_POST['movimentacao1'];
							$beneficiario = $_POST['bene1'];
							$beneficiario1 = $_POST['ben1'];
							$tipo = $_POST['tipo1'];
							$categoria = $_POST['cat1'];
							$categoria1 = $_POST['cate1'];
							$data = $_POST['data1'];
							$valor = $_POST['dinheiro1'];
							$forma = $_POST['forma1'];
							$usuario = $_SESSION['cod'];
							if(!empty($beneficiario1) || !empty($categoria1)){
								if(!empty($categoria1) && !empty($beneficiario1)){
									$sql = "SELECT * from tb_beneficiario where nm_beneficiario = '".$beneficiario1."'";
									$result = $mysqli->query($sql);
									if($result->num_rows > 0){
										$row = $result->fetch_object();
										$benefinal = $row->cd_beneficiario;
									}
									else{
										$sql = "INSERT into tb_beneficiario values(null, '".$beneficiario1."')";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											$sql = "SELECT * from tb_beneficiario where nm_beneficiario = '".$beneficiario1."'";
											$result = $mysqli->query($sql);
											$row = $result->fetch_object();
											$benefinal = $row->cd_beneficiario;
										}
									}

									/*Agora unimos os códigos do beneficiário e categoria*/

									$sql = "SELECT * from tb_categoria where nm_categoria = '".$categoria1."'";
									$result = $mysqli->query($sql);
									if($result->num_rows > 0){
										$row = $result->fetch_object();
										$catfinal = $row->cd_categoria;
									}
									else{
										$sql = "INSERT into tb_categoria values(null, '".$categoria1."')";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											$sql = "SELECT * from tb_categoria where nm_categoria = '".$categoria1."'";
											$result = $mysqli->query($sql);
											$row = $result->fetch_object();
											$catfinal = $row->cd_categoria;
										}
									}

									/*Agora inserimos na tabela movimentação os dados manipulados*/

									$sql = "INSERT into tb_movimentacao values(null, '$tipo', '$catfinal', '$benefinal', '$forma', '$usuario', '$valor', '$descricao', '$data')";
									if(!$mysqli->query($sql)){
										printf("error %s\n" , $mysqli->error);
									}
									else{
										echo "<script type='text/javascript'>alert('Movimentação adicionada com sucesso!'); window.location.href = 'home.php';</script>";
									}
								}
								else if(!empty($beneficiario1)){
									$sql = "SELECT * from tb_beneficiario where nm_beneficiario = '".$beneficiario1."'";
									$result = $mysqli->query($sql);
									if($result->num_rows > 0){
										$row = $result->fetch_object();
										$sql = "INSERT into tb_movimentacao values(null, '$tipo', '$categoria', '".$row->cd_beneficiario."', '$forma', '$usuario', '$valor', '$descricao', '$data')";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											echo "<script type='text/javascript'>alert('Movimentação adicionada com sucesso!'); window.location.href = 'home.php';</script>";
										}
									}
									else{
										$sql = "INSERT into tb_beneficiario values(null, '".$beneficiario1."')";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											$sql = "SELECT * from tb_beneficiario where nm_beneficiario = '".$beneficiario1."'";
											$result = $mysqli->query($sql);
											$row = $result->fetch_object();
											$sql = "INSERT into tb_movimentacao values(null, '$tipo', '$categoria', '".$row->cd_beneficiario."', '$forma', '$usuario', '$valor', '$descricao', '$data')";
											if(!$mysqli->query($sql)){
												printf("error %s\n" , $mysqli->error);
											}
											else{
												echo "<script type='text/javascript'>alert('Movimentação adicionada com sucesso!'); window.location.href = 'home.php';</script>";
											}
										}
									}
								}
								else{
									$sql = "SELECT * from tb_categoria where nm_categoria = '".$categoria1."'";
									$result = $mysqli->query($sql);
									if($result->num_rows > 0){
										$row = $result->fetch_object();
										$sql = "INSERT into tb_movimentacao values(null, '$tipo', '".$row->cd_categoria."', '$beneficiario', '$forma', '$usuario', '$valor', '$descricao', '$data')";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											echo "<script type='text/javascript'>alert('Movimentação adicionada com sucesso!'); window.location.href = 'home.php';</script>";
										}
									}
									else{
										$sql = "INSERT into tb_categoria values(null, '".$categoria1."')";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											$sql = "SELECT * from tb_categoria where nm_categoria = '".$categoria1."'";
											$result = $mysqli->query($sql);
											$row = $result->fetch_object();
											$sql = "INSERT into tb_movimentacao values(null, '$tipo', '".$row->cd_categoria."', '$beneficiario', '$forma', '$usuario', '$valor', '$descricao', '$data')";
											if(!$mysqli->query($sql)){
												printf("error %s\n" , $mysqli->error);
											}
											else{
												echo "<script type='text/javascript'>alert('Movimentação adicionada com sucesso!'); window.location.href = 'home.php';</script>";
											}
										}
									}
								}
							}
							else{
								$sql = "INSERT into tb_movimentacao values(null, '$tipo', '$categoria', '$beneficiario', '$forma', '$usuario', '$valor', '$descricao', '$data')";
								if(!$mysqli->query($sql)){
									printf("error %s\n" , $mysqli->error);
								}
								else{
									echo "<script type='text/javascript'>alert('Movimentação adicionada com sucesso!'); window.location.href = 'home.php';</script>";
								}
							}
						}
						if(isset($_POST['movimentacao2'])){
							$descricao = $_POST['movimentacao2'];
							$beneficiario = $_POST['bene2'];
							$beneficiario1 = $_POST['ben2'];
							$tipo = $_POST['tipo2'];
							$categoria = $_POST['cat2'];
							$categoria1 = $_POST['cate2'];
							$data = $_POST['data2'];
							$valor = $_POST['dinheiro2'];
							$forma = $_POST['forma2'];
							$cod = $_POST['id'];
							$usuario = $_SESSION['cod'];
							if(!empty($beneficiario1) || !empty($categoria1)){
								if(!empty($categoria1) && !empty($beneficiario1)){
									$sql = "SELECT * from tb_beneficiario where nm_beneficiario = '".$beneficiario1."'";
									$result = $mysqli->query($sql);
									if($result->num_rows > 0){
										$row = $result->fetch_object();
										$benefinal = $row->cd_beneficiario;
									}
									else{
										$sql = "INSERT into tb_beneficiario values(null, '".$beneficiario1."')";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											$sql = "SELECT * from tb_beneficiario where nm_beneficiario = '".$beneficiario1."'";
											$result = $mysqli->query($sql);
											$row = $result->fetch_object();
											$benefinal = $row->cd_beneficiario;
										}
									}

									/*Agora unimos os códigos do beneficiário e categoria*/

									$sql = "SELECT * from tb_categoria where nm_categoria = '".$categoria1."'";
									$result = $mysqli->query($sql);
									if($result->num_rows > 0){
										$row = $result->fetch_object();
										$catfinal = $row->cd_categoria;
									}
									else{
										$sql = "INSERT into tb_categoria values(null, '".$categoria1."')";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											$sql = "SELECT * from tb_categoria where nm_categoria = '".$categoria1."'";
											$result = $mysqli->query($sql);
											$row = $result->fetch_object();
											$catfinal = $row->cd_categoria;
										}
									}

									/*Agora modificamos na tabela movimentação os dados manipulados*/

									$sql = "UPDATE tb_movimentacao set ds_movimentacao = '$descricao', id_tipo = '$tipo', id_categoria = '$catfinal', id_beneficiario = '$benefinal', id_forma = '$forma', vl_movimentacao = $valor, dt_movimentacao = '$data' where cd_movimentacao = '$cod'";
									if(!$mysqli->query($sql)){
										printf("error %s\n" , $mysqli->error);
									}
									else{
										echo "<script type='text/javascript'>alert('Dados alterados com sucesso!'); window.location.href = 'home.php';</script>";
									}
								}
								else if(!empty($beneficiario1)){
									$sql = "SELECT * from tb_beneficiario where nm_beneficiario = '".$beneficiario1."'";
									$result = $mysqli->query($sql);
									if($result->num_rows > 0){
										$row = $result->fetch_object();
										$sql = "UPDATE tb_movimentacao set ds_movimentacao = '$descricao', id_tipo = '$tipo', id_categoria = '$categoria', id_beneficiario = '".$row->cd_beneficiario."', id_forma = '$forma', vl_movimentacao = $valor, dt_movimentacao = '$data' where cd_movimentacao = '$cod'";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											echo "<script type='text/javascript'>alert('Dados alterados com sucesso!'); window.location.href = 'home.php';</script>";
										}
									}
									else{
										$sql = "INSERT into tb_beneficiario values(null, '".$beneficiario1."')";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											$sql = "SELECT * from tb_beneficiario where nm_beneficiario = '".$beneficiario1."'";
											$result = $mysqli->query($sql);
											$row = $result->fetch_object();
											$sql = "UPDATE tb_movimentacao set ds_movimentacao = '$descricao', id_tipo = '$tipo', id_categoria = '$categoria', id_beneficiario = '".$row->cd_beneficiario."', id_forma = '$forma', vl_movimentacao = $valor, dt_movimentacao = '$data' where cd_movimentacao = '$cod'";
											if(!$mysqli->query($sql)){
												printf("error %s\n" , $mysqli->error);
											}
											else{
												echo "<script type='text/javascript'>alert('Dados alterados com sucesso!'); window.location.href = 'home.php';</script>";
											}
										}
									}	
								}
								else{
									$sql = "SELECT * from tb_categoria where nm_categoria = '".$categoria1."'";
									$result = $mysqli->query($sql);
									if($result->num_rows > 0){
										$row = $result->fetch_object();
										$sql = "UPDATE tb_movimentacao set ds_movimentacao = '$descricao', id_tipo = '$tipo', id_categoria = '".$row->cd_categoria."', id_beneficiario = '$beneficiario', id_forma = '$forma', vl_movimentacao = $valor, dt_movimentacao = '$data' where cd_movimentacao = '$cod'";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											echo "<script type='text/javascript'>alert('Dados alterados com sucesso!'); window.location.href = 'home.php';</script>";
										}
									}
									else{
										$sql = "INSERT into tb_categoria values(null, '".$categoria1."')";
										if(!$mysqli->query($sql)){
											printf("error %s\n" , $mysqli->error);
										}
										else{
											$sql = "SELECT * from tb_categoria where nm_categoria = '".$categoria1."'";
											$result = $mysqli->query($sql);
											$row = $result->fetch_object();
											$sql = "UPDATE tb_movimentacao set ds_movimentacao = '$descricao', id_tipo = '$tipo', id_categoria = '".$row->cd_categoria."', id_beneficiario = '$beneficiario', id_forma = '$forma', vl_movimentacao = $valor, dt_movimentacao = '$data' where cd_movimentacao = '$cod'";
											if(!$mysqli->query($sql)){
												printf("error %s\n" , $mysqli->error);
											}
											else{
												echo "<script type='text/javascript'>alert('Dados alterados com sucesso!'); window.location.href = 'home.php';</script>";
											}
										}
									}	
								}
							}
							else{
								$sql = "SELECT * from tb_movimentacao where cd_movimentacao = '$cod'";
								$result = $mysqli->query($sql);
								$row = $result->fetch_object();
								if($row->id_tipo == $tipo && $row->id_categoria == $categoria && $row->id_beneficiario == $beneficiario && $row->id_forma == $forma && $row->id_usuario == $usuario && $row->vl_movimentacao == $valor && $row->ds_movimentacao == $descricao && $row->dt_movimentacao == $data){
									echo "<script type='text/javascript'>alert('Dados equivalentes! Alteração não concluída.'); window.location.href = 'home.php';</script>";
								}
								else{
									$sql = "UPDATE tb_movimentacao set ds_movimentacao = '$descricao', id_tipo = '$tipo', id_categoria = '$categoria', id_beneficiario = '$beneficiario', id_forma = '$forma', vl_movimentacao = $valor, dt_movimentacao = '$data' where cd_movimentacao = '$cod'";
									if(!$mysqli->query($sql)){
										printf("error %s\n" , $mysqli->error);
									}
									else{
										echo "<script type='text/javascript'>alert('Dados alterados com sucesso!'); window.location.href = 'home.php';</script>";
									}
								}
							}	
						}
						if(isset($_POST['movimentacao3'])){
							$sql = "DELETE from tb_movimentacao where cd_movimentacao = '".$_POST['movimentacao3']."'";
							if(!$mysqli->query($sql)){
								printf("error %s\n" , $mysqli->error);
							}
							else{
								echo "<script type='text/javascript'>alert('Movimentação excluída com sucesso!'); window.location.href = 'home.php';</script>";
							}
						}
					?>	
			</div>
		</div><hr>
		<div class="row" style="max-height: 500px; overflow: auto;">
			<div class="col-md-12">
				<div class="table-responsive">          
				  	<table class="table">
				    	<thead>
				      		<tr>
				       	 		<th>#</th>
				       	 		<th>Descrição</th>
				        		<th>Data</th>
				        		<th>Tipo</th>
				        		<th>Valor</th>
				        		<th>Ação</th>
				      		</tr>
				    	</thead>
				    	<tbody>
				    		<?php
				    			$salentrada = 0.00;
				    			$salsaida = 0.00;
								if(isset($_POST['mes'])){
									$mes = $_POST['mes'];
									if($mes == '00'){
										$sql = "SELECT
											mov.cd_movimentacao as codmov, 
											mov.ds_movimentacao as movimentacao,
											mov.dt_movimentacao as data,
											mov.vl_movimentacao as valor,
											ben.cd_beneficiario as bencod,
											ben.nm_beneficiario as nomeben,
											cat.cd_categoria as catcod,
											cat.nm_categoria as categoria,
											forma.cd_forma as codforma,
											forma.nm_forma as forma,
											usu.nm_usuario as usuario,
											tipo.nm_tipo as tipo,
											tipo.cd_tipo as tip
											from tb_movimentacao mov 
											inner join tb_usuario usu on (mov.id_usuario= usu.cd_usuario )
											inner join tb_tipo tipo on (mov.id_tipo = tipo.cd_tipo)
											inner join tb_beneficiario ben on (mov.id_beneficiario = ben.cd_beneficiario)
											inner join tb_categoria cat on (mov.id_categoria = cat.cd_categoria)
											inner join tb_forma forma on (mov.id_forma = forma.cd_forma)
											where 
											mov.id_usuario = '".$_SESSION['cod']."' order by data desc;";
										$result = $mysqli->query($sql);
										if($result->num_rows > 0){
											$c = 1;
											$a = -1;
											$b = -1000;
											while($row = $result->fetch_object()){	
												$data = $row->data;
												$date = date_create($data);
												$valor = $row->valor;
												$usuario = $row->usuario;
												echo 
													"<tr>
														<td>".$c."</td>
														<td>".$row->movimentacao."</td>
														<td>".date_format($date, 'd/m/Y')."</td>
														<td>".$row->tipo."</td>
														<td>R$".number_format($valor, 2, ',', '.')."</td>
														<td align='center'>
															";?>
																<!-- Botão do 1° modal -->
																<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $row->codmov;?>" title="Visualizar"><span class='glyphicon glyphicon-eye-open'></span></button>

																<!-- Modal -->
																<div id="myModal<?php echo $row->codmov;?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	    <!-- Parte que não devo editar-->
																	    <div class="modal-content">
																	      	<div class="modal-header">
																	       		 <button type="button" class="close" data-dismiss="modal">&times;</button>
																	        	<h4 class="modal-title">Visualização | Dados de Movimentação</h4>
																	      	</div>
																	      	<div class="modal-body">
																	        <p><?php
																	        	echo "<form method='post'>
																	        	<div class='input-group'>
															      					<span class='input-group-addon'><b>Beneficiário</b></i></span>
																    				<input type='text' name='ben' class='form-control' disabled value='".$row->nomeben."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Categoria</b></i></span>
																    				<input type='text' name='categoria' class='form-control' disabled value='".$row->categoria."'>
																  				</div><br>
																				<div class='input-group'>
															      					<span class='input-group-addon'><b>Desc. Movimentação</b></i></span>
																    				<textarea name='movimentacao' class='form-control' disabled>".$row->movimentacao."</textarea>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Tipo de Movimentação</b></i></span>
																    				<input type='text' name='tipo' class='form-control' disabled value='".$row->tipo."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Valor</b></i></span>
																    				<input type='text' name='valor' class='form-control' disabled value='R$".number_format($valor, 2, ',', '.')."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Forma de Pagamento</b></i></span>
																    				<input type='text' name='forma' class='form-control' disabled value='".$row->forma."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Data de Movimentação</b></i></span>
																    				<input type='text' name='data' class='form-control' disabled value='".date_format($date, 'd/m/Y')."'>
																  				</div></form>";

																  				/*Parte que não devo editar*/

																		        echo "</p>
																		      	</div>
																		      	<div class='modal-footer'>
																		        	<button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
																		      	</div>
																		    </div>
																		</div>
																	</div>";?>

															<!-- Botão do 2° modal -->
																<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $b;?>" title="ALterar"><span class='glyphicon glyphicon-pencil'></span></button>

																<!-- Modal -->
																<div id="myModal<?php echo $b;?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	    <!-- Parte que não devo editar-->
																	    <div class="modal-content">
																	      	<div class="modal-header">
																	       		 <button type="button" class="close" data-dismiss="modal">&times;</button>
																	        	<h4 class="modal-title">Alteração | Dados de Movimentação</h4>
																	      	</div>
																	      	<div class="modal-body">
																	        <p><?php
																	        	echo "<p><form method='post'>
																					<div class='input-group'>
																						<span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span>
																						<select class='form-control' name='bene2'>
																								<option value=".$row->bencod.">".$row->nomeben."</option>";
																							$sql1 = "SELECT * from tb_beneficiario where cd_beneficiario <> '".$row->bencod."'";
																									$result1 = $mysqli->query($sql1);
																									while($row1 = $result1->fetch_object()){
																										echo "<option value=".$row1->cd_beneficiario.">".$row1->nm_beneficiario."</option>";
																									}
																							echo "
																							</select>
																							<span class='input-group-addon'><b><i>Ou</i></b></span>
																							<input type='text' name='ben2' class='form-control' placeholder='Adicionar novo'>
																						</div><br>
																						<div class='input-group'>
																							<span class='input-group-addon'><i><span class='glyphicon glyphicon-list-alt'></span></i></span>
																							<textarea name='movimentacao2' class='form-control' placeholder='Descrição da movimentação...'>".$row->movimentacao."</textarea>
																						</div><br>
																						<div class='form-group' align='left'>
																							<b>Tipo de Movimentação: </b>";
																								$sql1 = "SELECT * from tb_tipo";
																								$result1 = $mysqli->query($sql1);
																								while($row1 = $result1->fetch_object()){
																									if($row1->cd_tipo == $row->tip){
																										echo "<label class='radio-inline'><input type='radio' name='tipo2' value=".$row1->cd_tipo." checked>".$row1->nm_tipo."</label>";
																									}else{
																										echo "<label class='radio-inline'><input type='radio' name='tipo2' value=".$row1->cd_tipo.">".$row1->nm_tipo."</label>";
																									}
																								}
																							echo "
																						</div><br>
																						<div class='input-group'>
																							<span class='input-group-addon'><i class='glyphicon glyphicon-list'></i></span>
																							<select class='form-control' name='cat2'>
																								<option value=".$row->catcod.">".$row->categoria."</option>";
																									$sql1 = "SELECT * from tb_categoria";
																									$result1 = $mysqli->query($sql1);
																									while($row1 = $result1->fetch_object()){
																										echo "<option value=".$row1->cd_categoria.">".$row1->nm_categoria."</option>";
																									}
																							echo "
																							</select>
																							<span class='input-group-addon'><b><i>Ou</i></b></span>
																							<input type='text' name='cate2' class='form-control' placeholder='Adicionar nova'>
																						</div><br>
																						<div class='input-group'>
																							<span class='input-group-addon'><i class='glyphicon glyphicon-usd'></i></span>
																							<input type='text' id='dinheiro' name='dinheiro2' placeholder='Valor' class='form-control' value='".$row->valor."'>
																							<span class='input-group-addon'><i><span class='glyphicon glyphicon-calendar'></span></i></span>
																							<input type='date' name='data2' class='form-control' placeholder='' value='".$row->data."'>
																						</div><br>
																						<div class='form-group' align='left'>
																							<b>Forma de Pagamento: </b><br><br>";
																								$sql1 = "SELECT * from tb_forma";
																								$result1 = $mysqli->query($sql1);
																								$x = 1;
																								while($row1 = $result1->fetch_object()){
																									if($row1->cd_forma == $row->codforma){
																										echo "<label class='radio-inline'><input type='radio' name='forma2' value=".$row1->cd_forma." checked>".$row1->nm_forma."</label>";
																									}
																									else{
																										echo "<label class='radio-inline'><input type='radio' name='forma2' value=".$row1->cd_forma.">".$row1->nm_forma."</label>";
																									}
																									if($x%3 == 0){
																										echo "<br><br>";
																									}
																									$x++;
																								}
																						echo "
																						<input type='hidden' name='id' value='".$row->codmov."'>
																						</div>
																						";

																  				/*Parte que não devo editar*/

																		        echo "</p>
																		      	</div>
																		      	<div class='modal-footer'>
																		      		<button type='submit' class='btn btn-danger' title='Alterar'>Alterar</button>
																		        	<button type='button' class='btn btn-primary' data-dismiss='modal' title='Cancelar'>Cancelar</button>
																		      	</div></form>
																		    </div>
																		</div>
																	</div>";?>

																<!-- Botão do 3° modal -->
																<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?php echo $a;?>" title="Excluir"><span class='glyphicon glyphicon-trash'></span></button>

																<!-- Modal -->
																<div id="myModal<?php echo $a;?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	    <!-- Parte que não devo editar-->
																	    <div class="modal-content">
																	      	<div class="modal-header">
																	       		 <button type="button" class="close" data-dismiss="modal">&times;</button>
																	        	<h4 class="modal-title">Tem certeza que deseja aplicar essas alterações?</h4>
																	      	</div>
																	      	<div class="modal-body">
																	        <p><?php
																	        	echo "<form method='post'>
																	        		Os dados selecionados serão permanentementes excluídos. 
																	        		<input type='hidden' name='movimentacao3' value='".$row->codmov."'>
																					<br><br>
																				  	<button type='submit' class='btn btn-danger' title='Excluir'>Sim</button>
																					<button type='button' class='btn btn-primary' data-dismiss='modal' title='Cancelar'>Não</button>
																		        	</p>
																		      	</div></form>
																		    </div>
																		</div>
																	</div>
																</td></tr>"
															;
												if($row->tip == 1){
													$salentrada = $valor + $salentrada;
												}
												else{
													$salsaida = $valor + $salsaida;
												}
												$c++;
												$a--;
												$b--;
											}
										}
										else{
											echo "<tr><td></td><td>Nenhuma movimentação realizada por este usuário.</td>";
										}
									}
									else{
										$sql = "SELECT
											mov.cd_movimentacao as codmov, 
											mov.ds_movimentacao as movimentacao,
											mov.dt_movimentacao as data,
											mov.vl_movimentacao as valor,
											ben.cd_beneficiario as bencod,
											ben.nm_beneficiario as nomeben,
											cat.cd_categoria as catcod,
											cat.nm_categoria as categoria,
											forma.cd_forma as codforma,
											forma.nm_forma as forma,
											usu.nm_usuario as usuario,
											tipo.nm_tipo as tipo,
											tipo.cd_tipo as tip
											from tb_movimentacao mov 
											inner join tb_usuario usu on (mov.id_usuario= usu.cd_usuario )
											inner join tb_tipo tipo on (mov.id_tipo = tipo.cd_tipo)
											inner join tb_beneficiario ben on (mov.id_beneficiario = ben.cd_beneficiario)
											inner join tb_categoria cat on (mov.id_categoria = cat.cd_categoria)
											inner join tb_forma forma on (mov.id_forma = forma.cd_forma)
											where
												mov.id_usuario = '".$_SESSION['cod']."' and mov.dt_movimentacao like '_____$mes%'
												order by data desc;";
										$result = $mysqli->query($sql);
										if($result->num_rows > 0){
											$c = 1;
											$a = -1;
											$b = -1000;
											while($row = $result->fetch_object()){	
												$data = $row->data;
												$date = date_create($data);
												$valor = $row->valor;
												$usuario = $row->usuario;
												echo 
													"<tr>
														<td>".$c."</td>
														<td>".$row->movimentacao."</td>
														<td>".date_format($date, 'd/m/Y')."</td>
														<td>".$row->tipo."</td>
														<td>R$".number_format($valor, 2, ',', '.')."</td>
														<td align='center'>
															";?>
																<!-- Botão do 1° modal -->
																<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $row->codmov;?>" title="Visualizar"><span class='glyphicon glyphicon-eye-open'></span></button>

																<!-- Modal -->
																<div id="myModal<?php echo $row->codmov;?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	    <!-- Parte que não devo editar-->
																	    <div class="modal-content">
																	      	<div class="modal-header">
																	       		 <button type="button" class="close" data-dismiss="modal">&times;</button>
																	        	<h4 class="modal-title">Visualização | Dados de Movimentação</h4>
																	      	</div>
																	      	<div class="modal-body">
																	        <p><?php
																	        	echo "<form method='post'>
																	        	<div class='input-group'>
															      					<span class='input-group-addon'><b>Beneficiário</b></i></span>
																    				<input type='text' name='ben' class='form-control' disabled value='".$row->nomeben."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Categoria</b></i></span>
																    				<input type='text' name='categoria' class='form-control' disabled value='".$row->categoria."'>
																  				</div><br>
																				<div class='input-group'>
															      					<span class='input-group-addon'><b>Desc. Movimentação</b></i></span>
																    				<textarea name='movimentacao' class='form-control' disabled>".$row->movimentacao."</textarea>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Tipo de Movimentação</b></i></span>
																    				<input type='text' name='tipo' class='form-control' disabled value='".$row->tipo."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Valor</b></i></span>
																    				<input type='text' name='valor' class='form-control' disabled value='R$".number_format($valor, 2, ',', '.')."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Forma de Pagamento</b></i></span>
																    				<input type='text' name='forma' class='form-control' disabled value='".$row->forma."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Data de Movimentação</b></i></span>
																    				<input type='text' name='data' class='form-control' disabled value='".date_format($date, 'd/m/Y')."'>
																  				</div></form>";

																  				/*Parte que não devo editar*/

																		        echo "</p>
																		      	</div>
																		      	<div class='modal-footer'>
																		        	<button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
																		      	</div>
																		    </div>
																		</div>
																	</div>";?>

															<!-- Botão do 2° modal -->
																<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $b;?>" title="Alterar"><span class='glyphicon glyphicon-pencil'></span></button>

																<!-- Modal -->
																<div id="myModal<?php echo $b;?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	    <!-- Parte que não devo editar-->
																	    <div class="modal-content">
																	      	<div class="modal-header">
																	       		 <button type="button" class="close" data-dismiss="modal">&times;</button>
																	        	<h4 class="modal-title">Alteração | Dados de Movimentação</h4>
																	      	</div>
																	      	<div class="modal-body">
																	        <p><?php
																	        	echo "<p><form method='post'>
																					<div class='input-group'>
																						<span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span>
																						<select class='form-control' name='bene2'>
																								<option value=".$row->bencod.">".$row->nomeben."</option>";
																							$sql1 = "SELECT * from tb_beneficiario where cd_beneficiario <> '".$row->bencod."'";
																									$result1 = $mysqli->query($sql1);
																									while($row1 = $result1->fetch_object()){
																										echo "<option value=".$row1->cd_beneficiario.">".$row1->nm_beneficiario."</option>";
																									}
																							echo "
																							</select>
																							<span class='input-group-addon'><b><i>Ou</i></b></span>
																							<input type='text' name='ben2' class='form-control' placeholder='Adicionar novo'>
																						</div><br>
																						<div class='input-group'>
																							<span class='input-group-addon'><i><span class='glyphicon glyphicon-list-alt'></span></i></span>
																							<textarea name='movimentacao2' class='form-control' placeholder='Descrição da movimentação...'>".$row->movimentacao."</textarea>
																						</div><br>
																						<div class='form-group' align='left'>
																							<b>Tipo de Movimentação: </b>";
																								$sql1 = "SELECT * from tb_tipo";
																								$result1 = $mysqli->query($sql1);
																								while($row1 = $result1->fetch_object()){
																									if($row1->cd_tipo == $row->tip){
																										echo "<label class='radio-inline'><input type='radio' name='tipo2' value=".$row1->cd_tipo." checked>".$row1->nm_tipo."</label>";
																									}else{
																										echo "<label class='radio-inline'><input type='radio' name='tipo2' value=".$row1->cd_tipo.">".$row1->nm_tipo."</label>";
																									}
																								}
																							echo "
																						</div><br>
																						<div class='input-group'>
																							<span class='input-group-addon'><i class='glyphicon glyphicon-list'></i></span>
																							<select class='form-control' name='cat2'>
																								<option value=".$row->catcod.">".$row->categoria."</option>";
																									$sql1 = "SELECT * from tb_categoria";
																									$result1 = $mysqli->query($sql1);
																									while($row1 = $result1->fetch_object()){
																										echo "<option value=".$row1->cd_categoria.">".$row1->nm_categoria."</option>";
																									}
																							echo "
																							</select>
																							<span class='input-group-addon'><b><i>Ou</i></b></span>
																							<input type='text' name='cate2' class='form-control' placeholder='Adicionar nova'>
																						</div><br>
																						<div class='input-group'>
																							<span class='input-group-addon'><i class='glyphicon glyphicon-usd'></i></span>
																							<input type='text' id='dinheiro' name='dinheiro2' placeholder='Valor' class='form-control' value='".$row->valor."'>
																							<span class='input-group-addon'><i><span class='glyphicon glyphicon-calendar'></span></i></span>
																							<input type='date' name='data2' class='form-control' placeholder='' value='".$row->data."'>
																						</div><br>
																						<div class='form-group' align='left'>
																							<b>Forma de Pagamento: </b><br><br>";
																								$sql1 = "SELECT * from tb_forma";
																								$result1 = $mysqli->query($sql1);
																								$x = 1;
																								while($row1 = $result1->fetch_object()){
																									if($row1->cd_forma == $row->codforma){
																										echo "<label class='radio-inline'><input type='radio' name='forma2' value=".$row1->cd_forma." checked>".$row1->nm_forma."</label>";
																									}
																									else{
																										echo "<label class='radio-inline'><input type='radio' name='forma2' value=".$row1->cd_forma.">".$row1->nm_forma."</label>";
																									}
																									if($x%3 == 0){
																										echo "<br><br>";
																									}
																									$x++;
																								}
																						echo "
																						<input type='hidden' name='id' value='".$row->codmov."'>
																						</div>
																						";

																  				/*Parte que não devo editar*/

																		        echo "</p>
																		      	</div>
																		      	<div class='modal-footer'>
																		      		<button type='submit' class='btn btn-danger' title='Alterar'>Alterar</button>
																		        	<button type='button' class='btn btn-primary' data-dismiss='modal' title='Cancelar'>Cancelar</button>
																		      	</div></form>
																		    </div>
																		</div>
																	</div>";?>

																<!-- Botão do 3° modal -->
																<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?php echo $a;?>" title="Excluir"><span class='glyphicon glyphicon-trash'></span></button>

																<!-- Modal -->
																<div id="myModal<?php echo $a;?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	    <!-- Parte que não devo editar-->
																	    <div class="modal-content">
																	      	<div class="modal-header">
																	       		 <button type="button" class="close" data-dismiss="modal">&times;</button>
																	        	<h4 class="modal-title">Tem certeza que deseja aplicar essas alterações?</h4>
																	      	</div>
																	      	<div class="modal-body">
																	        <p><?php
																	        	echo "<form method='post'>
																	        		Os dados selecionados serão permanentementes excluídos. 
																	        		<input type='hidden' name='movimentacao3' value='".$row->codmov."'>
																					<br><br>
																				  	<button type='submit' class='btn btn-danger' title='Excluir'>Sim</button>
																					<button type='button' class='btn btn-primary' data-dismiss='modal' title='Cancelar'>Não</button>
																		        	</p>
																		      	</div></form>
																		    </div>
																		</div>
																	</div>
																</td></tr>"
															;
												if($row->tip == 1){
													$salentrada = $valor + $salentrada;
												}
												else{
													$salsaida = $valor + $salsaida;
												}
												$c++;
												$a--;
												$b--;
											}
										}
										else{
											echo "<tr><td></td><td>Nenhuma movimentação realizada neste mês.</td>";
										}
									}
								}
								else{
									$sql = "SELECT
											mov.cd_movimentacao as codmov, 
											mov.ds_movimentacao as movimentacao,
											mov.dt_movimentacao as data,
											mov.vl_movimentacao as valor,
											ben.cd_beneficiario as bencod,
											ben.nm_beneficiario as nomeben,
											cat.cd_categoria as catcod,
											cat.nm_categoria as categoria,
											forma.cd_forma as codforma,
											forma.nm_forma as forma,
											usu.nm_usuario as usuario,
											tipo.nm_tipo as tipo,
											tipo.cd_tipo as tip
											from tb_movimentacao mov 
											inner join tb_usuario usu on (mov.id_usuario= usu.cd_usuario )
											inner join tb_tipo tipo on (mov.id_tipo = tipo.cd_tipo)
											inner join tb_beneficiario ben on (mov.id_beneficiario = ben.cd_beneficiario)
											inner join tb_categoria cat on (mov.id_categoria = cat.cd_categoria)
											inner join tb_forma forma on (mov.id_forma = forma.cd_forma)
											where  
											mov.id_usuario = '".$_SESSION['cod']."' order by data desc;";
									$result = $mysqli->query($sql);
									if($result->num_rows > 0){
											$c = 1;
											$a = -1;
											$b = -1000;
											while($row = $result->fetch_object()){	
												$data = $row->data;
												$date = date_create($data);
												$valor = $row->valor;
												$usuario = $row->usuario;
												echo 
													"<tr>
														<td>".$c."</td>
														<td>".$row->movimentacao."</td>
														<td>".date_format($date, 'd/m/Y')."</td>
														<td>".$row->tipo."</td>
														<td>R$".number_format($valor, 2, ',', '.')."</td>
														<td align='center'>
															";?>
																<!-- Botão do 1° modal -->
																<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $row->codmov;?>" title="Visualizar"><span class='glyphicon glyphicon-eye-open'></span></button>

																<!-- Modal -->
																<div id="myModal<?php echo $row->codmov;?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	    <!-- Parte que não devo editar-->
																	    <div class="modal-content">
																	      	<div class="modal-header">
																	       		 <button type="button" class="close" data-dismiss="modal">&times;</button>
																	        	<h4 class="modal-title">Visualização | Dados de Movimentação</h4>
																	      	</div>
																	      	<div class="modal-body">
																	        <p><?php
																	        	echo "<form method='post'>
																	        	<div class='input-group'>
															      					<span class='input-group-addon'><b>Beneficiário</b></i></span>
																    				<input type='text' name='ben' class='form-control' disabled value='".$row->nomeben."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Categoria</b></i></span>
																    				<input type='text' name='categoria' class='form-control' disabled value='".$row->categoria."'>
																  				</div><br>
																				<div class='input-group'>
															      					<span class='input-group-addon'><b>Desc. Movimentação</b></i></span>
																    				<textarea name='movimentacao' class='form-control' disabled>".$row->movimentacao."</textarea>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Tipo de Movimentação</b></i></span>
																    				<input type='text' name='tipo' class='form-control' disabled value='".$row->tipo."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Valor</b></i></span>
																    				<input type='text' name='valor' class='form-control' disabled value='R$".number_format($valor, 2, ',', '.')."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Forma de Pagamento</b></i></span>
																    				<input type='text' name='forma' class='form-control' disabled value='".$row->forma."'>
																  				</div><br>
																  				<div class='input-group'>
															      					<span class='input-group-addon'><b>Data de Movimentação</b></i></span>
																    				<input type='text' name='data' class='form-control' disabled value='".date_format($date, 'd/m/Y')."'>
																  				</div></form>";

																  				/*Parte que não devo editar*/

																		        echo "</p>
																		      	</div>
																		      	<div class='modal-footer'>
																		        	<button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
																		      	</div>
																		    </div>
																		</div>
																	</div>";?>

															<!-- Botão do 2° modal -->
																<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?php echo $b;?>" title="Alterar"><span class='glyphicon glyphicon-pencil'></span></button>

																<!-- Modal -->
																<div id="myModal<?php echo $b;?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	    <!-- Parte que não devo editar-->
																	    <div class="modal-content">
																	      	<div class="modal-header">
																	       		 <button type="button" class="close" data-dismiss="modal">&times;</button>
																	        	<h4 class="modal-title">Alteração | Dados de Movimentação</h4>
																	      	</div>
																	      	<div class="modal-body">
																	        <p><?php
																	        	echo "<p><form method='post'>
																					<div class='input-group'>
																						<span class='input-group-addon'><i class='glyphicon glyphicon-user'></i></span>
																						<select class='form-control' name='bene2'>
																								<option value=".$row->bencod.">".$row->nomeben."</option>";
																							$sql1 = "SELECT * from tb_beneficiario where cd_beneficiario <> '".$row->bencod."'";
																									$result1 = $mysqli->query($sql1);
																									while($row1 = $result1->fetch_object()){
																										echo "<option value=".$row1->cd_beneficiario.">".$row1->nm_beneficiario."</option>";
																									}
																							echo "
																							</select>
																							<span class='input-group-addon'><b><i>Ou</i></b></span>
																							<input type='text' name='ben2' class='form-control' placeholder='Adicionar novo'>
																						</div><br>
																						<div class='input-group'>
																							<span class='input-group-addon'><i><span class='glyphicon glyphicon-list-alt'></span></i></span>
																							<textarea name='movimentacao2' class='form-control' placeholder='Descrição da movimentação...'>".$row->movimentacao."</textarea>
																						</div><br>
																						<div class='form-group' align='left'>
																							<b>Tipo de Movimentação: </b>";
																								$sql1 = "SELECT * from tb_tipo";
																								$result1 = $mysqli->query($sql1);
																								while($row1 = $result1->fetch_object()){
																									if($row1->cd_tipo == $row->tip){
																										echo "<label class='radio-inline'><input type='radio' name='tipo2' value=".$row1->cd_tipo." checked>".$row1->nm_tipo."</label>";
																									}else{
																										echo "<label class='radio-inline'><input type='radio' name='tipo2' value=".$row1->cd_tipo.">".$row1->nm_tipo."</label>";
																									}
																								}
																							echo "
																						</div><br>
																						<div class='input-group'>
																							<span class='input-group-addon'><i class='glyphicon glyphicon-list'></i></span>
																							<select class='form-control' name='cat2'>
																								<option value=".$row->catcod.">".$row->categoria."</option>";
																									$sql1 = "SELECT * from tb_categoria";
																									$result1 = $mysqli->query($sql1);
																									while($row1 = $result1->fetch_object()){
																										echo "<option value=".$row1->cd_categoria.">".$row1->nm_categoria."</option>";
																									}
																							echo "
																							</select>
																							<span class='input-group-addon'><b><i>Ou</i></b></span>
																							<input type='text' name='cate2' class='form-control' placeholder='Adicionar nova'>
																						</div><br>
																						<div class='input-group'>
																							<span class='input-group-addon'><i class='glyphicon glyphicon-usd'></i></span>
																							<input type='text' id='dinheiro' name='dinheiro2' placeholder='Valor' class='form-control' value='".$row->valor."'>
																							<span class='input-group-addon'><i><span class='glyphicon glyphicon-calendar'></span></i></span>
																							<input type='date' name='data2' class='form-control' placeholder='' value='".$row->data."'>
																						</div><br>
																						<div class='form-group' align='left'>
																							<b>Forma de Pagamento: </b><br><br>";
																								$sql1 = "SELECT * from tb_forma";
																								$result1 = $mysqli->query($sql1);
																								$x = 1;
																								while($row1 = $result1->fetch_object()){
																									if($row1->cd_forma == $row->codforma){
																										echo "<label class='radio-inline'><input type='radio' name='forma2' value=".$row1->cd_forma." checked>".$row1->nm_forma."</label>";
																									}
																									else{
																										echo "<label class='radio-inline'><input type='radio' name='forma2' value=".$row1->cd_forma.">".$row1->nm_forma."</label>";
																									}
																									if($x%3 == 0){
																										echo "<br><br>";
																									}
																									$x++;
																								}
																						echo "
																						<input type='hidden' name='id' value='".$row->codmov."'>
																						</div>
																						";

																  				/*Parte que não devo editar*/

																		        echo "</p>
																		      	</div>
																		      	<div class='modal-footer'>
																		      		<button type='submit' class='btn btn-danger' title='Alterar'>Alterar</button>
																		        	<button type='button' class='btn btn-primary' data-dismiss='modal' title='Cancelar'>Cancelar</button>
																		      	</div></form>
																		    </div>
																		</div>
																	</div>";?>

																<!-- Botão do 3° modal -->
																<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal<?php echo $a;?>" title="Excluir"><span class='glyphicon glyphicon-trash'></span></button>

																<!-- Modal -->
																<div id="myModal<?php echo $a;?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	    <!-- Parte que não devo editar-->
																	    <div class="modal-content">
																	      	<div class="modal-header">
																	       		 <button type="button" class="close" data-dismiss="modal">&times;</button>
																	        	<h4 class="modal-title">Tem certeza que deseja aplicar essas alterações?</h4>
																	      	</div>
																	      	<div class="modal-body">
																	        <p><?php
																	        	echo "<form method='post'>
																	        		Os dados selecionados serão permanentementes excluídos. 
																	        		<input type='hidden' name='movimentacao3' value='".$row->codmov."'>
																					<br><br>
																				  	<button type='submit' class='btn btn-danger' title='Excluir'>Sim</button>
																					<button type='button' class='btn btn-primary' data-dismiss='modal' title='Cancelar'>Não</button>
																		        	</p>
																		      	</div></form>
																		    </div>
																		</div>
																	</div>
																</td></tr>"
															;
												if($row->tip == 1){
													$salentrada = $valor + $salentrada;
												}
												else{
													$salsaida = $valor + $salsaida;
												}
												$c++;
												$a--;
												$b--;
											}
										}
										else{
											echo "<tr><td></td><td>Nenhuma movimentação realizada por este usuário.</td>";
										}
									}
							$salfinal = $salentrada - $salsaida;
							?>
				    	</tbody>
				  </table>
				</div>
			</div>
		</div>
		<hr>
		<div class="row" align="center">
			<div class="col-md-4">
				Saldo entrada: <b><?php echo "R$".number_format($salentrada, 2, ',', '.') ?></b>
			</div>
			<div class="col-md-4">
				Saldo saída: <b><?php echo "R$".number_format($salsaida, 2, ',', '.') ?></b>
			</div>
			<div class="col-md-4">
				<?php
					echo "<b>SALDO TOTAL:</b> ";
					if($salfinal > 0){
						 echo "<b style='color: blue;'>R$".number_format($salfinal, 2, ',', '.')."</b>";
					}
					else{
						if($salfinal == 0){
							echo "<b>R$".number_format($salfinal, 2, ',', '.')."</b>";
						}
						else{
							echo "<b style='color: red;'>R$".number_format($salfinal, 2, ',', '.')."</b>";
						}
					}
				?>
			</div>
		</div>
		<?php
			if(isset($_GET['id']) && $_GET['id'] == 0){
				session_destroy();
				echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
			} 
		?>	
	</body>
</html>