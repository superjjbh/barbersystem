<!--**
 * @author Cesar Szpak - Celke -   cesar@celke.com.br
 * @pagina desenvolvida usando framework bootstrap,
 * o código é aberto e o uso é free,
 * porém lembre -se de conceder os créditos ao desenvolvedor.
 *-->
<?php 
	include_once("conexao.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Criar pagina com abas</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		
		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<h1>Cadastrar Usuário</h1>
			</div>			
			<?php
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$request = md5(implode($_POST));
					if(isset($_SESSION['ultima_request']) && $_SESSION['ultima_request'] == $request){
						echo "Usuário já foi inserido";
					}else{	
						$_SESSION['ultima_request'] = $request;
						$usuario_nome = $_POST['usuario_nome'];
						$usuario_email = $_POST['usuario_email'];
						$usuario_login = $_POST['usuario_login'];
						$usuario_senha = $_POST['usuario_senha'];
						$_SESSION['usuario_nome'] = $usuario_nome;
						$_SESSION['usuario_email'] = $usuario_email;						
						$result_dados_pessoais = "INSERT INTO usuario (usuario_nome, usuario_email, usuario_senha, usuario_login) VALUES ('$usuario_nome', '$usuario_email', '$usuario_senha', '$usuario_login')";
						$resultado_dados_pessoais= mysqli_query($conn, $result_dados_pessoais);
						//ID do usuario inserido
						$ultimo_id = mysqli_insert_id($conn);	
						echo $ultimo_id;
					}
				}
			?>
			<div>

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#dados_pessoais" aria-controls="home" role="tab" data-toggle="tab">Dados Pessoais</a></li>
				<li role="presentation"><a href="#dados_de_acesso" aria-controls="dados_de_acesso" role="tab" data-toggle="tab">Dados de Acesso</a></li>
				<li role="presentation"><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="dados_pessoais">
					<div style="padding-top:20px;">
						<form class="form-horizontal" action="" method="POST">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-10">
                                    <input type="text" name='usuario_nome' required class="form-control" id="usuario_nome" placeholder="Nome Completo" value="<?php if(isset($_SESSION['usuario_nome'])){ echo $_SESSION['usuario_nome']; }?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">E-mail</label>
                                <div class="col-sm-10">
                                    <input type="text" name='usuario_email' required class="form-control" id="usuario_email" placeholder="Email" value="<?php if(isset($_SESSION['usuario_email'])){ echo $_SESSION['usuario_email']; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
								<a href="#dados_de_acesso" aria-controls="dados_de_acesso" role="tab" data-toggle="tab">PROXIMO</a>
                            </div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="dados_de_acesso">
					<div style="padding-top:20px;">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Usuário</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required name='usuario_senha' id="usuario_senha" placeholder="Usuário">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Senha</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" required name='usuario_login' id="usuario_login" placeholder="Senha">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="messages">
				
				</div>
			  </div>

			</div>
		</div>
		
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>