<?php
require_once './loader.php';
$site = new Site();
$site->getMeta();

$modulo_aparencia = new ModuloAparencia();
$modulo_aparencia->getModuloaparencia();

$topo = new Modulo1();
$topo->getModulo1();

$menu = new Modulo2();
$menu->getModulo2();

$icon = new Icon();
$icon->db = new DB;
$icon->getIcones();
$servico_id = intval($_GET['id']);
$servico = new Servico();
$servico->servico_id = $servico_id;
$servico->getServico();

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


$sobre = new Modulo3();
$sobre->getModulo3();

$portfolio = new Modulo7();
$portfolio->getModulo7();

$contato = new Modulo9();
$contato->getModulo9();

$blog = new Modulo10();
$blog->getModulo10();

$pagina_id = intval($_GET['id']);
$pagina = new Pagina();
$pagina->pagina_id = "$pagina_id";
$pagina->getPagina();

$portfolio_id = intval($_GET['id']);
$categoria_portfolio = new Area1();
$categoria_portfolio->getAreas1();

if (isset($_POST['email']) && !empty($_POST['email'])) {
    date_default_timezone_set('America/Sao_Paulo');
	require_once './plugin/email/email.php';
    global $mail;
    $smtp = new Smtpr();
    $smtp->getSmtp();
    $mail->Port = $smtp->smtp_port;
    $mail->Host = $smtp->smtp_host;
    $mail->Username = $smtp->smtp_username;
    $mail->From = $smtp->smtp_username;
    $mail->Password = $smtp->smtp_password;
    $mail->FromName = $smtp->smtp_fromname;
    $mail->Subject = utf8_decode("Interesse por Promoção " . $site->site_meta_titulo);
    $mail->AddBCC($smtp->smtp_bcc);
    $mail->AddAddress($smtp->smtp_username);

    $data = date('d/m/Y H:i');
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $evento = $_POST['evento'];
    $mensagem = $_POST['mensagem'];
    $convite = $_POST['convite'];

    $mail->AddReplyTo($email);
    $body = "<b>Data da Mensagem: </b> $data <br />";
    $body .= "<b>Nome:</b> $nome <br />";
    $body .= "<b>E-mail:</b> $email <br />";
    $body .= "<b>Telefone:</b> $telefone <br />";
    $body .= "<b>Data prevista para o Evento:</b> $evento <br />";
    $body .= "<b>Promoção que tem interesse:</b> $convite <br />";
    $body .= "<b>Mensagem: </b>$mensagem <br />";
    $mail->Body = nl2br($body);
}

?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <?php require_once './analytics.php'; ?>
        <?php require_once './base.php'; ?>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <title><?= $site->site_meta_titulo ?></title>
        <meta name="description" content="<?= $site->site_meta_desc ?>">
        <meta name="keywords" content="<?= $site->site_meta_palavra ?>">
        <meta name="author" content="<?= $site->site_meta_autor ?>">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS
        ================================================== -->
        <!-- Bootstrap  -->
        <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
        <!-- web font  -->
        <link href='//fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
        <!-- plugin css  -->
        <link rel="stylesheet" type="text/css" href="js-plugin/animation-framework/animate.css" />
        <!-- Pop up-->
        <link rel="stylesheet" type="text/css" href="js-plugin/magnific-popup/magnific-popup.css" />
        <!-- Flex slider-->
        <link rel="stylesheet" type="text/css" href="js-plugin/flexslider/flexslider.css" />
        <!-- Owl carousel-->
        <link rel="stylesheet" href="js-plugin/owl.carousel/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="js-plugin/owl.carousel/owl-carousel/owl.transitions.css">
        <link rel="stylesheet" href="js-plugin/owl.carousel/owl-carousel/owl.theme.css">
        <!-- isotope -->
        <link type="text/css" rel="stylesheet" href="js-plugin/isotope/css/style.css">
        <!-- icon fonts -->
        <link type="text/css" rel="stylesheet" href="font-icons/custom-icons/css/custom-icons.css">
        <link type="text/css" rel="stylesheet" href="font-icons/custom-icons/css/custom-icons-ie7.css">
        <!-- nekoAnim-->
        <link rel="stylesheet" type="text/css" href="js-plugin/appear/nekoAnim.css">
        <!-- Custom css -->
        <link type="text/css" rel="stylesheet" href="css/layout.css">
        <link type="text/css" id="colors" rel="stylesheet" href="css/<?= $modulo_aparencia->modulo_aparencia_cor ?>.css">
        <link type="text/css" rel="stylesheet" href="css/custom.css">
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
        <script src="js/modernizr-2.6.1.min.js"></script>
        <!-- Favicons
        ================================================== -->
         <link rel="shortcut icon" href="admin/assets/img/ico/favicon.ico?<?= rand(0, 100) ?>">
    </head>
    <body class="activateAppearAnimation" id="<?= $modulo_aparencia->modulo_aparencia_wide?>">
        <!-- Primary Page Layout 
        ================================================== -->
        <!-- globalWrapper -->
        <div id="globalWrapper">
            <!-- header -->
            <!-- header -->
            <!-- ======================================= content ======================================= -->
            <section id="portfolio">
                <header class="page-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-2 col-sm-2 col-md-1">
                                <a href="./app/home.php" class="btn btn-sm btn-inverse"><i class="icon-left-open-mini"></i>Voltar</a>
                            </div>  
                            <div class="col-xs-10 col-sm-10 col-md-11 projectTitle">
                                <h1><?= $site->site_meta_titulo ?></h1>
                            </div>
                        </div>
                    </div>
                </header>
                <section id="content" class="mt30">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- ==============================================
                                                   COMENTÁRIO
                                 =============================================== -->
                                <h1>Detalhe do agendamento</h1>
								<hr>
                                <section class="clearfix comments pt30">
                                    <h2 class="commentNumbers">Olá <?= stripslashes($servico->servico_nome) ?>! </h2>
                                    <h3>Seguem os detalhes do seu agendamento</h3>
					<b>Nome:</b> <?= stripslashes($servico->servico_nome) ?></br>
					<b>Contato:</b> <?= stripslashes($servico->servico_icon) ?></br>
					<b>E-mail:</b> <?= stripslashes($servico->servico_email) ?></br>
					<hr>
					<b>Unidade:</b> <?= stripslashes($servico->servico_unidade) ?></br>
					<b>Serviço Solicitado:</b> <?= stripslashes($servico->servico_descricao) ?></br>
					<b>Serviços Adicionais:</b> <?= stripslashes($servico->servico_adicional) ?> | <?= stripslashes($servico->servico_adicional2) ?> | <?= stripslashes($servico->servico_adicional3) ?> | <?= stripslashes($servico->servico_adicional4) ?></br>
					<?php if (!empty($servico->servico_promocao)) : ?>
					<b>Promoção Escolhida:</b> <?= stripslashes($servico->servico_promocao) ?></br>
					<?php endif; ?>
					<b>Valor total do Serviço:</b> R$ <?= stripslashes($servico->servico_valor_total) ?></br>
					<b>Forma de Pagamento:</b> <?= stripslashes($servico->servico_pagamento) ?></br>
					<b>Data Escolhida:</b> <?= stripslashes($servico->servico_data) ?></br>
					<b>Horário Escolhido:</b> <?= stripslashes($servico->servico_horario) ?></br>
					<b>Profissional Designado: <?= stripslashes($servico->servico_profissional) ?></b></br>
					<?php if (stripslashes($servico->servico_status) == 3): ?>
					Status Atual do Agendamento: <font style="color:#009900;font-weight:bold;">PAGO E CONFIRMADO!</font>
					<?php endif; ?>
					<?php if (stripslashes($servico->servico_status) == 1): ?>
					Status Atual do Agendamento: <font style="color:#f9ef18;font-weight:bold;">CONFIRMADO!</font>
					<?php endif; ?>
					<?php if (stripslashes($servico->servico_status) == 2): ?>
					Status Atual do Agendamento: <font style="color:#009900;font-weight:bold;">ATENDIDO E FINALIZADO!</font>
					<?php endif; ?>
					<?php if (stripslashes($servico->servico_status) == 0): ?>
					Status Atual do Agendamento: <font style="color:#f2195b;font-weight:bold;">NÃO CONFIRMADO!</font></br></br>
					<?php endif; ?>
					<?php if ((stripslashes($servico->servico_status) == 1) && (stripslashes($servico->servico_pagamento) == 'Online (Pagseguro)') && (stripslashes($site->site_logo) == 'Ativado')): ?>
					<hr>
					<h3 align="center"><b>Você escolheu a forma de pagamento 'Online (Pagseguro)'! Para agilizar o processo de pagamento, clique no botão abaixo para pagar online para <?= $site->site_meta_titulo ?>! Você pode também realizar esse processo na própria barbearia, enquanto é realizado o serviço!</b></h3></br>
						<!-- Declaração do formulário --> 
						<form method="post" target="pagseguro"  
						action="https://pagseguro.uol.com.br/v2/checkout/payment.html" target="_blank">  
								  
								<!-- Campos obrigatórios -->  
								<input name="receiverEmail" type="hidden" value="<?= stripslashes($site->site_imagem) ?>">  
								<input name="currency" type="hidden" value="BRL">  
						  
								<!-- Itens do pagamento (ao menos um item é obrigatório) -->  
								<input name="itemId1" type="hidden" value="<?= stripslashes($servico->servico_id) ?>">  
								<input name="itemDescription1" type="hidden" value="<?= stripslashes($servico->servico_descricao) ?> | <?= stripslashes($servico->servico_adicional) ?> | <?= stripslashes($servico->servico_adicional2) ?> | <?= stripslashes($servico->servico_adicional3) ?> | <?= stripslashes($servico->servico_adicional4) ?>">  
								<input name="itemAmount1" type="hidden" value="<?= stripslashes($servico->servico_valor_total) ?>">  
								<input name="itemQuantity1" type="hidden" value="1">  
								<input type="hidden" name="tipo" value="CBR">
								<input type="hidden" name="moeda" value="BRL">
								<input type="hidden" name="cliente_pais" value="BRA">
						  
								<!-- Código de referência do pagamento no seu sistema (opcional) -->  
								<input name="reference" type="hidden" value="AGENDA<?= stripslashes($servico->servico_id) ?>">  
								<input name="itemShippingCost" type="hidden" value="0.00">  										  
								<!-- Dados do comprador (opcionais) -->  
								<input name="senderName" type="hidden" value="<?= stripslashes($servico->servico_nome) ?>">  
								<input name="senderAreaCode" type="hidden" value="">  
								<input name="senderPhone" type="hidden" value="<?= stripslashes($servico->servico_icon) ?>">  
								<input name="senderEmail" type="hidden" value="<?= stripslashes($servico->servico_email) ?>">  
						  
								<!-- submit do form (obrigatório) -->  
								<div align="center">
								<h3>Pagamento Online PagSeguro</h3>
								<input alt="Pague com PagSeguro" name="submit"  type="image" src="images/205x30-pagar.gif"/>  
								</div>  
								</form> 
								<?php endif; ?>
					<?php if ((stripslashes($servico->servico_status) == 1) && (stripslashes($servico->servico_pagamento) == 'Direto na Barbearia') && (stripslashes($site->site_logo) == 'Desativado')): ?>
								<hr>
								<h3 align="center"><b>Você escolheu a forma de pagamento 'Direto na Barbearia'! Te aguardamos na(o) <?= $site->site_meta_titulo ?> para que o serviço e o pagamento sejam feitos direto na barbearia!</b></h3></br>										<hr>
					<?php endif; ?>
					<?php if (stripslashes($servico->servico_status) == 0): ?>
								<h3 align="center"><b>O status do seu agendamento consta como 'NÃO CONFIRMADO'! Dúvidas? Entre em contato conosco abaixo, pelo WhatsApp !</b></h3></br>										
								<hr>
                          <div id="one">
                                    <h3>Atendimento WhatsApp</h3>
							<h3 align="center">Clique no botão abaixo, para iniciar uma conversa no WhatsApp com <?= $site->site_meta_titulo ?></h3>
						   <p align="center">

							<a href="https://api.whatsapp.com/send?phone=55<?= $site->site_meta_autor ?>&text=Ola, meu nome é <?= stripslashes($servico->servico_nome) ?> e meu agendamento: <?= stripslashes($servico->servico_descricao) ?>, <?= stripslashes($servico->servico_data) ?> às <?= stripslashes($servico->servico_horario) ?> está com o status 'NAO CONFIRMADO'. Poderia me ajudar? " target="_blank">
								<img src="images/whatsapp.png" width="200px" alt="" title="" />
							</a></p>
                          </div>                          
					<?php endif; ?>
					<?php if (stripslashes($servico->servico_status) == 2): ?>
								<hr>
								<h3 align="center"><b>O status do seu agendamento consta como 'ATENDIDO E FINALIZADO'! Agradecemos a preferência! Aguardamos o próximo agendamento.</b></h3></br>																		
					<?php endif; ?>
					<?php if (stripslashes($servico->servico_status) == 3): ?>
								<hr>
								<h3 align="center"><b>O status do seu agendamento consta como 'PAGO E CONFIRMADO'! Te aguardamos na data e horário agendado. <?= $site->site_meta_titulo ?></b></h3></br>																		
					<?php endif; ?>
                      
				<div align="center">
				<p><b><?= $site->site_meta_titulo ?></b></p>
				<address>
				<p>Contato: <?= $site->site_meta_desc ?> <br> E-mail: <?= $site->site_meta_palavra ?></p>
                </address>	
				</div>

                                </section>
                                <!-- ==============================================
                                                  FIM  COMENTÁRIO
                                  =============================================== -->                            </div>

									<!-- AddToAny BEGIN -->
									
<!-- AddToAny END -->

                                    <div class="col-md-12 col-sm-4">
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- works -->


                    <!-- call to action -->
                    <section class="pt30 pb30 mb15">

                    </section>
                    <!-- call to action -->
                </section>
            </section>
            <!-- content -->
            <!-- footer -->
            <footer id="footerWrapper" class="footer2">
                <?php require_once './footer.php'; ?>
            </footer>
            <!-- End footer -->
        </div>
        <!-- global wrapper -->
        <!-- End Document 
        ================================================== -->
        <script type="text/javascript" src="js-plugin/respond/respond.min.js"></script>
        <script type="text/javascript" src="js-plugin/jquery/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js-plugin/jquery-ui/jquery-ui-1.8.23.custom.min.js"></script>
        <!-- third party plugins  -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="js-plugin/easing/jquery.easing.1.3.js"></script>
        <script src="./admin/assets/js/bootstrap-tagsinput.min.js"></script>
        <script src="./admin/assets/js/jasny-bootstrap.fileinput.min.js"></script>
        <!-- carousel -->
        <script type="text/javascript" src="js-plugin/owl.carousel/owl-carousel/owl.carousel.min.js"></script>
        <!-- pop up -->
        <script type="text/javascript" src="js-plugin/magnific-popup/jquery.magnific-popup.min.js"></script>
        <!-- flex slider -->
        <script type="text/javascript" src="js-plugin/flexslider/jquery.flexslider-min.js"></script>
        <!-- isotope -->
        <script type="text/javascript" src="js-plugin/isotope/jquery.isotope.min.js"></script>
        <!-- sharrre -->
        <script type="text/javascript" src="js-plugin/jquery.sharrre-1.3.4/jquery.sharrre-1.3.4.min.js"></script>
        <!-- appear -->
        <script type="text/javascript" src="js-plugin/appear/jquery.appear.js"></script>	
        <!-- Custom  -->
        <script type="text/javascript" src="js/custom.js"></script>
        <script>
            $('#depoimentos').addClass('active');
        </script>
    </body>
</html>
