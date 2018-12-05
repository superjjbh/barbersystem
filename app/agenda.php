<?php
session_start();
require_once '../loader.php';
$site = new Site();
$site->getMeta();

$contato = new Modulo9();
$contato->getModulo9();

$contatos = new Contato();
$contatos->getContato();

$modulo2 = new Modulo2();
$modulo2->getModulo2();

$servico = new Servico();
$servico->db = new DB;
$servico->db->url = "servico";
$servico->db->paginate(1000);
//$servico->getServicos();

$unidade = new Unidade();
$unidade->db = new DB;
$unidade->db->url = "unidade";
$unidade->db->paginate(24);
$unidade->getUnidades();

	if($_POST['servico_status'] == 1)
	{
		$servico_status = 'Confirmado';
	}
	else if($_POST['servico_status'] == 2)
	{
		$servico_status = 'Atendido e Finalizado';
	}
	else
	{
		$servico_status = 'Não Confirmado';
	}
if (empty($_SESSION['email']))
{
$_SESSION['email'] = $_POST['email'];	
}

?>
	
<!DOCTYPE html>
<html>
<head>
<meta charset="utf8">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
<link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="images/apple-touch-startup-image-640x1096.png">
<meta name="author" content="SINDEVO.COM" />
<meta name="description" content="biotic - mobile and tablet web app template" />
<meta name="keywords" content="mobile css template, mobile html template, jquery mobile template, mobile app template, html5 mobile design, mobile design" />
<title><?= $site->site_meta_titulo ?></title>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.css">
<link type="text/css" rel="stylesheet" href="style.css" />
<link type="text/css" rel="stylesheet" href="css/colors/yellow.css" />
<link type="text/css" rel="stylesheet" href="css/swipebox.css" />
<style>       
      #map {
        height: 350px;  
        width: 100%;  
       }
	  #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
      }
      #legend h3 {
        margin-top: 0;
      }
      #legend img {
        vertical-align: middle;
      }</style>
</head>
<body>

<div data-role="page" id="tabs" class="secondarypage" data-theme="b">

    <div data-role="header" data-position="fixed">
        <div class="nav_left_button"><a href="#" class="nav-toggle"><span></span></a></div>
        <div class="nav_center_logo"><?= $site->site_meta_titulo ?></div>
        <div class="nav_right_button"><a href="#right-panel"><img src="images/icons/white/user.png" alt="" title="" /></a></div>
        <div class="clear"></div>
    </div><!-- /header -->

    <div role="main" class="ui-content">

       <div class="pages_maincontent">              
              <h2 class="page_title">meus agendamentos</h2> 
              <div class="page_content"> 
				<?php if (!empty($_SESSION['email'])) : ?>
				<?php echo "<div><h3>Olá ".$_SESSION['nome']."!</h3></div>"; ?>
				<?php endif; ?>
				<?php if (empty($_SESSION['email'])) : ?>
				<form class="form-inline" id="busca" name="busca" role="form" method="post">
					<div class="input-group input-group">
						Informe o seu e-mail:<br>
						<input type="text" name="email" value="<?php echo $_SESSION['email']?>" required class="form-control" placeholder="Buscar pelo E-mail…">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary">Buscar</button>						
						</span>
					</div>
				</form>
				<?php endif; ?>
				<hr><br>
	<?php if (isset($_SESSION['email'])) : ?>
                        <div data-role="tabs" id="tabs">
						<p align="center"><a href="javascript:window.location.href=window.location.href"><img src="images/agenda.png" /></a></p>
                          <div data-role="navbar">
                            <ul>
                              <li><a href="#0" class="ui-btn-active">Pendente</a></li>
                              <li><a href="#1">Confirmado</a></li>
                              <li><a href="#2">Atendido</a></li>
                            </ul>
                          </div>
                          <div id="0">
                                    <h3> Agendamentos Não Confirmados</h3>
	<!-- INICIO DA AGENDA -->
		<?php $servico->getAgenda0(); ?>
            <?php if (isset($servico->db->data[0])): ?>
                <?php foreach ($servico->db->data as $service): ?>
                        <div data-role="collapsible" data-content-theme="false">
                            <h4>Data: <?= stripslashes($service->servico_data) ?> | Horário: <?= stripslashes($service->servico_horario) ?> <br> 
										<?php if (stripslashes($service->servico_status) == 1): ?>
										Status Atual: <font style="color:#f9ef18;font-weight:bold;">CONFIRMADO!</font>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 2): ?>
										Status Atual: <font style="color:#009900;font-weight:bold;">ATENDIDO!</font>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 0): ?>
										Status Atual: <font style="color:#f2195b;font-weight:bold;">NÃO CONFIRMADO!</font>
										<?php endif; ?>
							
							</h4>
										<?php $_SESSION['nome'] = $service->servico_nome;?>
										<?php $_SESSION['email'] = $service->servico_email;?>
										<?php $_SESSION["telefone"] = $service->servico_icon;?>
										<b>Nome:</b> <?= stripslashes($service->servico_nome) ?></br>
										<b>Contato:</b> <?= stripslashes($service->servico_icon) ?></br>
										<b>E-mail:</b> <?= stripslashes($service->servico_email) ?></br>
										<hr>
										<b>Unidade:</b> <?= stripslashes($service->servico_unidade) ?></br>
										<b>Serviço Solicitado:</b> <?= stripslashes($service->servico_descricao) ?></br>
										<b>Serviços Adicionais:</b> <?= stripslashes($service->servico_adicional) ?> | <?= stripslashes($service->servico_adicional2) ?> | <?= stripslashes($service->servico_adicional3) ?> | <?= stripslashes($service->servico_adicional4) ?></br>
										<?php if (!empty($service->servico_promocao)) : ?>
										<b>Promoção Escolhida:</b> <?= stripslashes($service->servico_promocao) ?></br>
										<?php endif; ?>
										<b>Valor total do Serviço:</b> R$ <?= stripslashes($service->servico_valor_total) ?></br>
										<b>Forma de Pagamento:</b> <?= stripslashes($service->servico_pagamento) ?></br>
										<b>Data Escolhida:</b> <?= stripslashes($service->servico_data) ?></br>
										<b>Horário Escolhido:</b> <?= stripslashes($service->servico_horario) ?></br>
										<b>Profissional Designado: <?= stripslashes($service->servico_profissional) ?></b></br>
										<?php if (stripslashes($service->servico_status) == 1): ?>
										Status Atual do Agendamento: <font style="color:#f9ef18;font-weight:bold;">CONFIRMADO!</font>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 2): ?>
										Status Atual do Agendamento: <font style="color:#009900;font-weight:bold;">ATENDIDO E FINALIZADO!</font>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 0): ?>
										Status Atual do Agendamento: <font style="color:#f2195b;font-weight:bold;">NÃO CONFIRMADO!</font></br></br>
										<?php endif; ?>					
					<?php if (stripslashes($service->servico_status) == 0): ?>
								<h3 align="center"><b>O status do seu agendamento consta como 'NÃO CONFIRMADO'! Dúvidas? Entre em contato conosco abaixo, pelo WhatsApp !</b></h3></br>										
								<hr>
                          <div id="one">
                                    <h3>Atendimento WhatsApp</h3>
							<h3 align="center">Clique no botão abaixo, para iniciar uma conversa no WhatsApp com <?= $site->site_meta_titulo ?></h3>
						   <p align="center">

							<a href="https://api.whatsapp.com/send?phone=55<?= $site->site_meta_autor ?>&text=Ola, meu nome é <?= stripslashes($service->servico_nome) ?> e meu agendamento: <?= stripslashes($service->servico_descricao) ?>, <?= stripslashes($service->servico_data) ?> às <?= stripslashes($service->servico_horario) ?> está com o status 'NAO CONFIRMADO'. Poderia me ajudar? " target="_blank">
								<img src="images/whatsapp.png" width="200px" alt="" title="" />
							</a></p>
                          </div>                          
					<?php endif; ?>
										<hr>
										</div>
                <?php endforeach; ?>
			<?php else: ?>
			<p align="center"><img src="images/aguardo.png" /></p>
			<h3 align="center"><b> Nenhum agendamento <font style="color:#f2195b;font-weight:bold;">PENDENTE</font> foi encontrado!</b></h3></br>																		
            <?php endif; ?>
			
			<!-- FINAL DA AGENDA -->
			</div>
                          
                          <div id="1">
                                    <h3>Agendamentos Confirmados</h3>
	<!-- INICIO DA AGENDA -->
		<?php $servico->getAgenda1(); ?>
            <?php if (isset($servico->db->data[0])): ?>
                <?php foreach ($servico->db->data as $service): ?>
                        <div data-role="collapsible" data-content-theme="false">
                            <h4>Data: <?= stripslashes($service->servico_data) ?> | Horário: <?= stripslashes($service->servico_horario) ?> <br> 										
										Forma de Pgto: <font style="color:#f9ef18;font-weight:bold;"><?= stripslashes($service->servico_pagamento) ?></font>							
							</h4>
										<?php $_SESSION['nome'] = $service->servico_nome;?>
										<?php $_SESSION['email'] = $service->servico_email;?>
										<?php $_SESSION["telefone"] = $service->servico_icon;?>
										<b>Nome:</b> <?= stripslashes($service->servico_nome) ?></br>
										<b>Contato:</b> <?= stripslashes($service->servico_icon) ?></br>
										<b>E-mail:</b> <?= stripslashes($service->servico_email) ?></br>
										<hr>
										<b>Unidade:</b> <?= stripslashes($service->servico_unidade) ?></br>
										<b>Serviço Solicitado:</b> <?= stripslashes($service->servico_descricao) ?></br>
										<b>Serviços Adicionais:</b> <?= stripslashes($service->servico_adicional) ?> | <?= stripslashes($service->servico_adicional2) ?> | <?= stripslashes($service->servico_adicional3) ?> | <?= stripslashes($service->servico_adicional4) ?></br>
										<?php if (!empty($service->servico_promocao)) : ?>
										<b>Promoção Escolhida:</b> <?= stripslashes($service->servico_promocao) ?></br>
										<?php endif; ?>
										<b>Valor total do Serviço:</b> R$ <?= stripslashes($service->servico_valor_total) ?></br>
										<b>Forma de Pagamento:</b> <?= stripslashes($service->servico_pagamento) ?></br>
										<b>Data Escolhida:</b> <?= stripslashes($service->servico_data) ?></br>
										<b>Horário Escolhido:</b> <?= stripslashes($service->servico_horario) ?></br>
										<b>Profissional Designado: <?= stripslashes($service->servico_profissional) ?></b></br>
										<?php if (stripslashes($service->servico_status) == 1): ?>
										Status Atual do Agendamento: <font style="color:#f9ef18;font-weight:bold;">CONFIRMADO!</font>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 2): ?>
										Status Atual do Agendamento: <font style="color:#009900;font-weight:bold;">ATENDIDO E FINALIZADO!</font>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 0): ?>
										Status Atual do Agendamento: <font style="color:#f2195b;font-weight:bold;">NÃO CONFIRMADO!</font></br></br>
										<?php endif; ?>
					<?php if ((stripslashes($service->servico_status) == 1) && (stripslashes($service->servico_pagamento) == 'Online (Pagseguro)')): ?>
					<hr>
					<h3 align="center"><b>Você escolheu a forma de pagamento 'Online (Pagseguro)'! Para agilizar o processo de pagamento, clique no botão abaixo para pagar online para <?= $site->site_meta_titulo ?>! Você pode também realizar esse processo na própria barbearia, enquanto é realizado o serviço!</b></h3></br>
						<!-- Declaração do formulário --> 
						<form method="post" target="pagseguro"  
						action="https://pagseguro.uol.com.br/v2/checkout/payment.html" target="_blank">  
								  
								<!-- Campos obrigatórios -->  
								<input name="receiverEmail" type="hidden" value="superjjweb09@gmail.com">  
								<input name="currency" type="hidden" value="BRL">  
						  
								<!-- Itens do pagamento (ao menos um item é obrigatório) -->  
								<input name="itemId1" type="hidden" value="<?= stripslashes($service->servico_id) ?>">  
								<input name="itemDescription1" type="hidden" value="<?= stripslashes($service->servico_descricao) ?> | <?= stripslashes($service->servico_adicional) ?> | <?= stripslashes($service->servico_adicional2) ?> | <?= stripslashes($service->servico_adicional3) ?> | <?= stripslashes($service->servico_adicional4) ?>">  
								<input name="itemAmount1" type="hidden" value="<?= stripslashes($service->servico_valor_total) ?>">  
								<input name="itemQuantity1" type="hidden" value="1">  
								<input type="hidden" name="tipo" value="CBR">
								<input type="hidden" name="moeda" value="BRL">
								<input type="hidden" name="cliente_pais" value="BRA">
						  
								<!-- Código de referência do pagamento no seu sistema (opcional) -->  
								<input name="reference" type="hidden" value="AGENDA<?= stripslashes($service->servico_id) ?>">  
								<input name="itemShippingCost" type="hidden" value="0.00">  										  
								<!-- Dados do comprador (opcionais) -->  
								<input name="senderName" type="hidden" value="<?= stripslashes($service->servico_nome) ?>">  
								<input name="senderAreaCode" type="hidden" value="">  
								<input name="senderPhone" type="hidden" value="<?= stripslashes($service->servico_icon) ?>">  
								<input name="senderEmail" type="hidden" value="<?= stripslashes($service->servico_email) ?>">  
						  
								<!-- submit do form (obrigatório) -->  
								<div align="center">
								<h3>Pagamento Online PagSeguro</h3>
								<input alt="Pague com PagSeguro" name="submit"  type="image" src="images/205x30-pagar.gif"/>  
								</div>  
								</form> 
					<?php endif; ?>
					<?php if ((stripslashes($service->servico_status) == 1) && (stripslashes($service->servico_pagamento) == 'Direto na Barbearia')): ?>
								<hr>
								<h3 align="center"><b>Você escolheu a forma de pagamento 'Direto na Barbearia'! Te aguardamos na data e horário agendado!</b></h3></br>										
								<hr>
					<?php endif; ?>
					<?php if (stripslashes($service->servico_status) == 3): ?>
								<hr>
								<h3 align="center"><b>O status do seu agendamento consta como 'PAGO E CONFIRMADO'! Te aguardamos na data e horário agendado. <?= $site->site_meta_titulo ?></b></h3></br>																		
					<?php endif; ?>
										<hr>
										</div>
                <?php endforeach; ?>
			<?php else: ?>
			<p align="center"><img src="images/confirma.png" /></p>
			<h3 align="center"><b>Nenhum agendamento <font style="color:#f9ef18;font-weight:bold;">CONFIRMADO!</font> foi encontrado!</b></h3></br>																		
            <?php endif; ?>
			<!-- FINAL DA AGENDA -->
			</div>
						  
                          <div id="2">
                                    <h3>Agendamentos Finalizados</h3>
	<!-- INICIO DA AGENDA -->
		<?php $servico->getAgenda2(); ?>
            <?php if (isset($servico->db->data[0])): ?>
                <?php foreach ($servico->db->data as $service): ?>
                        <div data-role="collapsible" data-content-theme="false">
                            <h4>Data: <?= stripslashes($service->servico_data) ?> | Horário: <?= stripslashes($service->servico_horario) ?> <br> 
										<?php if (stripslashes($service->servico_status) == 1): ?>
										Status Atual: <font style="color:#f9ef18;font-weight:bold;">CONFIRMADO!</font>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 2): ?>
										Status Atual: <font style="color:#009900;font-weight:bold;">ATENDIDO!</font>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 0): ?>
										Status Atual: <font style="color:#f2195b;font-weight:bold;">NÃO CONFIRMADO!</font>
										<?php endif; ?>
							
							</h4>
										<?php $_SESSION['nome'] = $service->servico_nome;?>
										<?php $_SESSION['email'] = $service->servico_email;?>
										<?php $_SESSION["telefone"] = $service->servico_icon;?>
										<b>Nome:</b> <?= stripslashes($service->servico_nome) ?></br>
										<b>Contato:</b> <?= stripslashes($service->servico_icon) ?></br>
										<b>E-mail:</b> <?= stripslashes($service->servico_email) ?></br>
										<hr>
										<b>Unidade:</b> <?= stripslashes($service->servico_unidade) ?></br>
										<b>Serviço Solicitado:</b> <?= stripslashes($service->servico_descricao) ?></br>
										<b>Serviços Adicionais:</b> <?= stripslashes($service->servico_adicional) ?> | <?= stripslashes($service->servico_adicional2) ?> | <?= stripslashes($service->servico_adicional3) ?> | <?= stripslashes($service->servico_adicional4) ?></br>
										<?php if (!empty($service->servico_promocao)) : ?>
										<b>Promoção Escolhida:</b> <?= stripslashes($service->servico_promocao) ?></br>
										<?php endif; ?>
										<b>Valor total do Serviço:</b> R$ <?= stripslashes($service->servico_valor_total) ?></br>
										<b>Forma de Pagamento:</b> <?= stripslashes($service->servico_pagamento) ?></br>
										<b>Data Escolhida:</b> <?= stripslashes($service->servico_data) ?></br>
										<b>Horário Escolhido:</b> <?= stripslashes($service->servico_horario) ?></br>
										<b>Profissional Designado: <?= stripslashes($service->servico_profissional) ?></b></br>
										<?php if (stripslashes($service->servico_status) == 1): ?>
										Status Atual do Agendamento: <font style="color:#f9ef18;font-weight:bold;">CONFIRMADO!</font>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 2): ?>
										Status Atual do Agendamento: <font style="color:#009900;font-weight:bold;">ATENDIDO E FINALIZADO!</font>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 0): ?>
										Status Atual do Agendamento: <font style="color:#f2195b;font-weight:bold;">NÃO CONFIRMADO!</font></br></br>
										<?php endif; ?>

					<?php if (stripslashes($service->servico_status) == 2): ?>
								<hr>
								<h3 align="center"><b>O status do seu agendamento consta como 'ATENDIDO E FINALIZADO'! Agradecemos a preferência! Aguardamos o próximo agendamento.</b></h3></br>																		
					<?php endif; ?>
										<hr>
										</div>
                <?php endforeach; ?>
			<?php else: ?>
			<p align="center"><img src="images/atendido.png" /></p>
			<h3 align="center"><b>Nenhum agendamento <font style="color:#009900;font-weight:bold;">ATENDIDO E FINALIZADO!</font> foi encontrado!</b></h3></br>																		
            <?php endif; ?>
			<!-- FINAL DA AGENDA -->
			</div>
                                                    
	
	
	
	

	<?php endif; ?>
	
              </div>  
				<div align="center">
				<p><b><?= $site->site_meta_titulo ?></b></p>
				<address>
				<p>Contato: <?= $site->site_meta_desc ?> <br> E-mail: <?= $site->site_meta_palavra ?></p>
                </address>	
				</div>

              </div>
              
       </div>        
    </div><!-- /content -->

    <div data-role="panel" id="left-panel" data-display="reveal" data-position="left">

		<?php require_once './menu_esquerdo.php'; ?>


    </div><!-- /panel -->

    <div data-role="panel" id="right-panel" data-display="reveal" data-position="right">
    
		<?php require_once './menu_direito.php'; ?>
          <div class="close_loginpopup_button"><a href="#" data-rel="close"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
          
    </div><!-- /panel -->


</div><!-- /page -->

<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.4.5.min.js"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/email.js"></script>
<script type="text/javascript" src="js/jquery.swipebox.js"></script>
<script src="js/jquery.mobile-custom.js"></script>
<script type="text/javascript" src="../js/custom.js"></script>
</body>
</html>
