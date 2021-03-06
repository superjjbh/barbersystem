<?php
require_once '../loader.php';
require_once './conexao.php';
@session_start();
if (!isset($_SESSION['LOGADO']) || $_SESSION['LOGADO'] == FALSE) {
    @header('location:' . Validacao::getBase() . 'admin/logar/');
    exit;
}
$site = new Site();
$site->getMeta();
$servico = new Servico();
$servico->db = new DB;
$servico->db->url = "servico";
$servico->db->paginate(1000);

$contatos = new Contato();
$contatos->getContato();                                    


$icon = new Icon();
$icon->db = new DB;
$icon->getIcones();

//$resultado = mysqli_query($conn, "SELECT count(servico_id) FROM servico where servico_status = 0");
//$naoconfirmado=mysqli_fetch_assoc($resultado);	
date_default_timezone_set('America/Sao_Paulo');
$amanha = date ('d/m/Y', mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));

//contagem e soma não confirmados
$result0 = mysqli_query($conn, "SELECT count(servico_id) AS contagem FROM servico where servico_status = 0 AND servico_data = '$amanha'");
$resultsoma0 = mysqli_query($conn, "SELECT sum(servico_valor_total) AS valor FROM servico where servico_status = 0 AND servico_data = '$amanha'");
$row0 = mysqli_fetch_assoc($result0);
$rowsoma0 = mysqli_fetch_assoc($resultsoma0);
$naoconfirmado = $row0['contagem'];
$valornaoconfirmado = $rowsoma0['valor'];	

//contagem e soma confirmados
$result1 = mysqli_query($conn, "SELECT count(servico_id) AS contagem FROM servico where servico_status IN (1,3) AND servico_data = '$amanha'");
$resultsoma1 = mysqli_query($conn, "SELECT sum(servico_valor_total) AS valor FROM servico where servico_status IN (1,3) AND servico_data = '$amanha'");
$row1 = mysqli_fetch_assoc($result1);
$rowsoma1 = mysqli_fetch_assoc($resultsoma1);
$confirmado = $row1['contagem'];
$valorconfirmado = $rowsoma1['valor'];	
																
																	
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <!-- START @HEAD -->
    <head>
        <?php require_once './base.php'; ?>
        <!-- START @META SECTION -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?= $site->site_meta_titulo ?></title>
        <!--/ END META SECTION -->

        <!-- START @FAVICONS -->
        <link href="./assets/img/ico/favicon.ico?<?= rand(0, 100) ?>" rel="shortcut icon" sizes="144x144">
        <!--/ END FAVICONS -->

        <!-- START @FONT STYLES -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
        <!--/ END FONT STYLES -->

        <!-- START @GLOBAL MANDATORY STYLES -->
        <link href="./assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="./assets/css/bootstrap-switch.min.css" rel="stylesheet">
        <!--/ END GLOBAL MANDATORY STYLES -->

        <!-- START @PAGE LEVEL STYLES -->
        <link href="./assets/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="./assets/css/animate.min.css" rel="stylesheet">
        <link href="./assets/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="./assets/css/datatables.responsive.css" rel="stylesheet">
        <link href="./assets/css/fuelux.min.css" rel="stylesheet">
        <!--/ END PAGE LEVEL STYLES -->

        <!-- START @THEME STYLES -->
        <link href="./assets/css/reset.css" rel="stylesheet">
        <link href="./assets/css/layout.css" rel="stylesheet">
        <link href="./assets/css/components.css" rel="stylesheet">
        <link href="./assets/css/plugins.css" rel="stylesheet">
        <link href="./assets/css/themes/default.theme.css" rel="stylesheet" id="theme">
        <link href="./assets/css/custom.css" rel="stylesheet">
        <link href="./assets/css/jquery.rtnotify.css" rel="stylesheet">
        <link href="./assets/css/noty_theme_default.css" rel="stylesheet">
        <link href="./assets/css/bootstrap-tagsinput.css" rel="stylesheet">
        <link href="./assets/css/jasny-bootstrap-fileinput.min.css" rel="stylesheet">
        <link href="./assets/css/chosen.min.css" rel="stylesheet">
        <!--/ END THEME STYLES -->

        <!-- START @IE SUPPORT -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="./assets/js/html5shiv.min.js"></script>
        <script src="./assets/js/respond.min.js"></script>
        <![endif]-->
        <!--/ END IE SUPPORT -->
    </head>
    <!--/ END HEAD -->
    <body>
        <!--[if lt IE 9]>
        <p class="upgrade-browser">Upps!! You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <section id="wrapper" class="page-sound">
            <?php require_once './navegacao.php'; ?> <!-- /#header -->
            <?php require_once './menu.php'; ?>
            <section id="page-content">
                <div class="header-content">
                    <h2><i class="fa fa-calendar-o"></i> Agenda de Amanhã</h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label">Você está em :</span>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="home/">Dashboard</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Envio de Contatos</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="body-content animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">

							<div class="pull-left">
							
							<p>Legenda do Status:</p>
							<p><img src="./images/aguardo.png" /> NÃO CONFIRMADO</p>
                            <p><img src="./images/confirma.png" /> CONFIRMADO</p>
                            <p><img src="./images/pago.png" /> PAGO E CONFIRMADO</p>
                            <p><img src="./images/atendido.png" /> ATENDIDO E FINALIZADO</p>
								<?php require_once './form_busca_veiculo.php'; ?>
								</br>
								<?php require_once './form_busca_status.php'; ?>
								</br>
								<?php require_once './form_busca_periodo.php'; ?>
                            </div>
							<div class="pull-right">
							<h3 class="panel-title"><a class="btn btn-success" href="gerarAgendamentos.php"  style="color:#fff"><i class="fa fa-file-excel-o" ></i> Exportar Contatos para Excel</a></h3>										
							</div>
							
                                    <div class="clearfix"></div>
                                </div>
								
	<h3><font style="color:#f2195b;font-weight:bold;">Não Confirmados: </font><?= stripslashes($naoconfirmado) ?></h3>
	<h4>Valores Pendentes: R$ </font><?= stripslashes($valornaoconfirmado) ?></h4>
<div class="panel-group" id="accordion">
		<?php $servico->getServicosNaoConfAmanha(); ?>
            <?php if (isset($servico->db->data[0])): ?>
                <?php foreach ($servico->db->data as $service): ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?= stripslashes($service->servico_id) ?>">
											
													<?php if (stripslashes($service->servico_status) == 1): ?>
													<img src="./images/confirma.png" alt="CONFIRMADO" />  Data: <?= stripslashes($service->servico_data) ?> </br> Cliente: <?= stripslashes($service->servico_nome) ?> | Horário: <?= stripslashes($service->servico_horario) ?>
													<?php endif; ?>
													<?php if (stripslashes($service->servico_status) == 3): ?>
													<img src="./images/pago.png" alt="PAGO E CONFIRMADO" />  Data: <?= stripslashes($service->servico_data) ?> </br> Cliente: <?= stripslashes($service->servico_nome) ?> | Horário: <?= stripslashes($service->servico_horario) ?>
													<?php endif; ?>
													<?php if (stripslashes($service->servico_status) == 2): ?>
													<img src="./images/atendido.png" alt="ATENDIDO" />  Data: <?= stripslashes($service->servico_data) ?> </br> Cliente: <?= stripslashes($service->servico_nome) ?> | Horário: <?= stripslashes($service->servico_horario) ?>
													<?php endif; ?>
													<?php if (stripslashes($service->servico_status) == 0): ?>
													<img src="./images/aguardo.png" alt="PENDENTE" />  Data: <?= stripslashes($service->servico_data) ?> </br> Cliente: <?= stripslashes($service->servico_nome) ?> | Horário: <?= stripslashes($service->servico_horario) ?>
													<?php endif; ?>
										</a>
									</h4>
								</div>
								<div id="<?= stripslashes($service->servico_id) ?>" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
										<h3>Detalhes do agendamento:</h3>
										<b>Nome:</b> <?= stripslashes($service->servico_nome) ?></br>
										<b>Contato:</b> <?= stripslashes($service->servico_icon) ?></br>
										<b>E-mail:</b> <?= stripslashes($service->servico_email) ?></br>
										<hr>
										<b>Unidade:</b> <?= stripslashes($service->servico_unidade) ?></br>
										<?php if (empty($service->servico_promocao)) : ?>
										<b>Serviço Solicitado:</b> Nº: <?= $service->servico_id ?> - <?= stripslashes($service->servico_descricao) ?></br>
										<?php endif; ?>
										<?php if (!empty($service->servico_promocao)) : ?>
										<b>Promoção Escolhida:</b> <?= stripslashes($service->servico_promocao) ?></br>
										<?php endif; ?>
										<b>Serviços Adicionais:</b> <?= stripslashes($service->servico_adicional) ?> | <?= stripslashes($service->servico_adicional2) ?> | <?= stripslashes($service->servico_adicional3) ?> | <?= stripslashes($service->servico_adicional4) ?></br>
										<b>Valor total do Serviço:</b> R$ <?= stripslashes($service->servico_valor_total) ?></br>
										<b>Forma de Pagamento:</b> <?= stripslashes($service->servico_pagamento) ?></br>
										<b>Data Escolhida:</b> <?= stripslashes($service->servico_data) ?></br>
										<b>Horário Escolhido:</b> <?= stripslashes($service->servico_horario) ?></br>
										<b>Profissional Designado: <?= stripslashes($service->servico_profissional) ?></b></br>
										<?php if (stripslashes($service->servico_status) == 3): ?>
										<b>Status Atual do Agendamento:</b> 
										<h4><font style="color:#009900;font-weight:bold;">PAGO E CONFIRMADO!</font></h4>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 1): ?>
										<b>Status Atual do Agendamento:</b> 
										<h4><font style="color:#1036ec;font-weight:bold;">CONFIRMADO!</font></h4>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 2): ?>
										<b>Status Atual do Agendamento:</b> 
										<h4><font style="color:#009900;font-weight:bold;">ATENDIDO E FINALIZADO!</font></h4>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 0): ?>
										<b>Status Atual do Agendamento:</b> 
										<h4><font style="color:#f2195b;font-weight:bold;">NÃO CONFIRMADO!</font></h4></br></br>
										<?php endif; ?>
										<h3>Ações</h3>
                                        <a href="cliente/editar/<?= $service->servico_id ?>/" >
                                            <img src="./images/status.png" />
                                        </a>
										</br>
										<?php if ((stripslashes($service->servico_status) == 1) && (stripslashes($service->servico_pagamento) == 'Direto na Barbearia')): ?>
                                        <a  href="https://api.whatsapp.com/send?phone=55<?= $service->servico_icon ?>&text=Ola <?= $service->servico_nome ?>, tudo bem? Segue o status do seu agendamento: CONFIRMADO | Confira os detalhes do seu agendamento nesse link: http://<?= $site->site_sobre_titulo ?>/retorno/<?= $service->servico_id ?>/. Te aguardamos para que o serviço e o pagamento sejam feitos direto na barbearia! Att, <?= $site->site_meta_titulo ?>" target="_blank">
                                            <img src="./images/notifica.png" />
                                        </a>
										<?php endif; ?>
										<?php if ((stripslashes($service->servico_status) == 1) && (stripslashes($service->servico_pagamento) == 'Online (Pagseguro)')): ?>
                                        <a href="https://api.whatsapp.com/send?phone=55<?= $service->servico_icon ?>&text=Ola <?= $service->servico_nome ?>, tudo bem? Segue o status do seu agendamento: CONFIRMADO | Confira os detalhes do seu agendamento e o link para pagamento online nesse link: http://<?= $site->site_sobre_titulo ?>/retorno/<?= $service->servico_id ?>/. Você pode também realizar esse processo de pagamento online na própria barbearia, enquanto é realizado o serviço! Att, <?= $site->site_meta_titulo ?>" target="_blank">
                                            <img src="./images/notifica.png" />
                                        </a>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 2): ?>
                                        <a  href="https://api.whatsapp.com/send?phone=55<?= $service->servico_icon ?>&text=Ola <?= $service->servico_nome ?>, tudo bem? Esse é o contato do(a) <?= $site->site_meta_titulo ?>. O status do seu agendamento consta como 'ATENDIDO E FINALIZADO'! Agradecemos a preferência! Aguardamos o próximo agendamento. Confira os detalhes do seu agendamento nesse link: http://<?= $site->site_sobre_titulo ?>/retorno/<?= $service->servico_id ?>/. Att, <?= $site->site_meta_titulo ?>" target="_blank">
                                            <img src="./images/notifica.png" />
                                        </a>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 0): ?>
                                        <a  href="https://api.whatsapp.com/send?phone=55<?= $service->servico_icon ?>&text=Ola <?= $service->servico_nome ?>, tudo bem? Esse é o contato do(a) <?= $site->site_meta_titulo ?>. Gostaria de conversar sobre o seu agendamento! O mesmo ainda não pôde ser confirmado. Podemos conversar?" target="_blank">
                                            <img src="./images/notifica.png" />
                                        </a>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 3): ?>
                                        <a  href="https://api.whatsapp.com/send?phone=55<?= $service->servico_icon ?>&text=Ola <?= $service->servico_nome ?>, tudo bem? O status do seu agendamento consta como *PAGO E CONFIRMADO*! Te aguardamos na data e horário agendado. Confira os detalhes do seu agendamento nesse link: http://<?= $site->site_sobre_titulo ?>/retorno/<?= $service->servico_id ?>/. Att, <?= $site->site_meta_titulo ?>" target="_blank">
                                            <img src="./images/notifica.png" />
                                        </a>
										<?php endif; ?>
										</br>
                                        <a class="delete" data-url="servico_fn.php?acao=remover&AMP;id=<?= $service->servico_id ?>"><img src="./images/remover.png" />
                                        </a>									
										</div>
								</div>
							</div>
                <?php endforeach; ?>
            <?php endif; ?>

</div>	
<h3><font style="color:#1036ec;font-weight:bold;">Confirmados: </font><?= stripslashes($confirmado) ?></h3>
	<h4>Valores Confirmados: R$ </font><?= stripslashes($valorconfirmado) ?></h4>
<div class="panel-group" id="accordion">
		<?php $servico->getServicosConfAmanha(); ?>
            <?php if (isset($servico->db->data[0])): ?>
                <?php foreach ($servico->db->data as $service): ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?= stripslashes($service->servico_id) ?>">
											
													<?php if (stripslashes($service->servico_status) == 1): ?>
													<img src="./images/confirma.png" alt="CONFIRMADO" />  Data: <?= stripslashes($service->servico_data) ?> </br> Cliente: <?= stripslashes($service->servico_nome) ?> | Horário: <?= stripslashes($service->servico_horario) ?>
													<?php endif; ?>
													<?php if (stripslashes($service->servico_status) == 3): ?>
													<img src="./images/pago.png" alt="PAGO E CONFIRMADO" />  Data: <?= stripslashes($service->servico_data) ?> </br> Cliente: <?= stripslashes($service->servico_nome) ?> | Horário: <?= stripslashes($service->servico_horario) ?>
													<?php endif; ?>
													<?php if (stripslashes($service->servico_status) == 2): ?>
													<img src="./images/atendido.png" alt="ATENDIDO" />  Data: <?= stripslashes($service->servico_data) ?> </br> Cliente: <?= stripslashes($service->servico_nome) ?> | Horário: <?= stripslashes($service->servico_horario) ?>
													<?php endif; ?>
													<?php if (stripslashes($service->servico_status) == 0): ?>
													<img src="./images/aguardo.png" alt="PENDENTE" />  Data: <?= stripslashes($service->servico_data) ?> </br> Cliente: <?= stripslashes($service->servico_nome) ?> | Horário: <?= stripslashes($service->servico_horario) ?>
													<?php endif; ?>
										</a>
									</h4>
								</div>
								<div id="<?= stripslashes($service->servico_id) ?>" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
										<h3>Detalhes do agendamento:</h3>
										<b>Nome:</b> <?= stripslashes($service->servico_nome) ?></br>
										<b>Contato:</b> <?= stripslashes($service->servico_icon) ?></br>
										<b>E-mail:</b> <?= stripslashes($service->servico_email) ?></br>
										<hr>
										<b>Unidade:</b> <?= stripslashes($service->servico_unidade) ?></br>
										<?php if (empty($service->servico_promocao)) : ?>
										<b>Serviço Solicitado:</b> Nº: <?= $service->servico_id ?> - <?= stripslashes($service->servico_descricao) ?></br>
										<?php endif; ?>
										<?php if (!empty($service->servico_promocao)) : ?>
										<b>Promoção Escolhida:</b> <?= stripslashes($service->servico_promocao) ?></br>
										<?php endif; ?>
										<b>Serviços Adicionais:</b> <?= stripslashes($service->servico_adicional) ?> | <?= stripslashes($service->servico_adicional2) ?> | <?= stripslashes($service->servico_adicional3) ?> | <?= stripslashes($service->servico_adicional4) ?></br>
										<b>Valor total do Serviço:</b> R$ <?= stripslashes($service->servico_valor_total) ?></br>
										<b>Forma de Pagamento:</b> <?= stripslashes($service->servico_pagamento) ?></br>
										<b>Data Escolhida:</b> <?= stripslashes($service->servico_data) ?></br>
										<b>Horário Escolhido:</b> <?= stripslashes($service->servico_horario) ?></br>
										<b>Profissional Designado: <?= stripslashes($service->servico_profissional) ?></b></br>
										<?php if (stripslashes($service->servico_status) == 3): ?>
										<b>Status Atual do Agendamento:</b> 
										<h4><font style="color:#009900;font-weight:bold;">PAGO E CONFIRMADO!</font></h4>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 1): ?>
										<b>Status Atual do Agendamento:</b> 
										<h4><font style="color:#1036ec;font-weight:bold;">CONFIRMADO!</font></h4>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 2): ?>
										<b>Status Atual do Agendamento:</b> 
										<h4><font style="color:#009900;font-weight:bold;">ATENDIDO E FINALIZADO!</font></h4>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 0): ?>
										<b>Status Atual do Agendamento:</b> 
										<h4><font style="color:#f2195b;font-weight:bold;">NÃO CONFIRMADO!</font></h4></br></br>
										<?php endif; ?>
										<h3>Ações</h3>
                                        <a href="cliente/editar/<?= $service->servico_id ?>/" >
                                            <img src="./images/status.png" />
                                        </a>
										</br>
										<?php if ((stripslashes($service->servico_status) == 1) && (stripslashes($service->servico_pagamento) == 'Direto na Barbearia')): ?>
                                        <a  href="https://api.whatsapp.com/send?phone=55<?= $service->servico_icon ?>&text=Ola <?= $service->servico_nome ?>, tudo bem? Segue o status do seu agendamento: CONFIRMADO | Confira os detalhes do seu agendamento nesse link: http://<?= $site->site_sobre_titulo ?>/retorno/<?= $service->servico_id ?>/. Te aguardamos para que o serviço e o pagamento sejam feitos direto na barbearia! Att, <?= $site->site_meta_titulo ?>" target="_blank">
                                            <img src="./images/notifica.png" />
                                        </a>
										<?php endif; ?>
										<?php if ((stripslashes($service->servico_status) == 1) && (stripslashes($service->servico_pagamento) == 'Online (Pagseguro)')): ?>
                                        <a href="https://api.whatsapp.com/send?phone=55<?= $service->servico_icon ?>&text=Ola <?= $service->servico_nome ?>, tudo bem? Segue o status do seu agendamento: CONFIRMADO | Confira os detalhes do seu agendamento e o link para pagamento online nesse link: http://<?= $site->site_sobre_titulo ?>/retorno/<?= $service->servico_id ?>/. Você pode também realizar esse processo de pagamento online na própria barbearia, enquanto é realizado o serviço! Att, <?= $site->site_meta_titulo ?>" target="_blank">
                                            <img src="./images/notifica.png" />
                                        </a>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 2): ?>
                                        <a  href="https://api.whatsapp.com/send?phone=55<?= $service->servico_icon ?>&text=Ola <?= $service->servico_nome ?>, tudo bem? Esse é o contato do(a) <?= $site->site_meta_titulo ?>. O status do seu agendamento consta como 'ATENDIDO E FINALIZADO'! Agradecemos a preferência! Aguardamos o próximo agendamento. Confira os detalhes do seu agendamento nesse link: http://<?= $site->site_sobre_titulo ?>/retorno/<?= $service->servico_id ?>/. Att, <?= $site->site_meta_titulo ?>" target="_blank">
                                            <img src="./images/notifica.png" />
                                        </a>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 0): ?>
                                        <a  href="https://api.whatsapp.com/send?phone=55<?= $service->servico_icon ?>&text=Ola <?= $service->servico_nome ?>, tudo bem? Esse é o contato do(a) <?= $site->site_meta_titulo ?>. Gostaria de conversar sobre o seu agendamento! O mesmo ainda não pôde ser confirmado. Podemos conversar?" target="_blank">
                                            <img src="./images/notifica.png" />
                                        </a>
										<?php endif; ?>
										<?php if (stripslashes($service->servico_status) == 3): ?>
                                        <a  href="https://api.whatsapp.com/send?phone=55<?= $service->servico_icon ?>&text=Ola <?= $service->servico_nome ?>, tudo bem? O status do seu agendamento consta como *PAGO E CONFIRMADO*! Te aguardamos na data e horário agendado. Confira os detalhes do seu agendamento nesse link: http://<?= $site->site_sobre_titulo ?>/retorno/<?= $service->servico_id ?>/. Att, <?= $site->site_meta_titulo ?>" target="_blank">
                                            <img src="./images/notifica.png" />
                                        </a>
										<?php endif; ?>
										</br>
                                        <a class="delete" data-url="servico_fn.php?acao=remover&AMP;id=<?= $service->servico_id ?>"><img src="./images/remover.png" />
                                        </a>									
										</div>
								</div>
							</div>
                <?php endforeach; ?>
            <?php endif; ?>

</div>	
                            </div>
                            <?= $servico->db->paginacao ?>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <div id="back-top" class="animated pulse circle">
            <i class="fa fa-angle-up"></i>
        </div>

        <!--***************MODAL REMOVER*****************-->
        <div class="modal fade" id="MODALREMOVE" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="text-center text-danger">Atenção!</h4>
                        <p class="text-center text-danger">
                            Você está prestes à excluir um registro de forma permanente.<br />
                            Deseja realmente executar este procedimento?
                        </p>
                        <p class="text-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</button>
                            <button type="button" class="btn btn-danger" id="btn-confirm-remove"><i class="glyphicon glyphicon-ok-circle"></i> Remover</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--***************MODAL REMOVER*****************-->

        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- START @CORE PLUGINS -->
        <script src="./assets/js/jquery.min.js"></script>
        <script src="./assets/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="./assets/js/handlebars.js"></script>
        <script src="./assets/js/typeahead.bundle.min.js"></script>
        <script src="./assets/js/jquery.nicescroll.min.js"></script>
        <script src="./assets/js/index.js"></script>
        <script src="./assets/js/jquery.easing.1.3.min.js"></script>
        <script src="./assets/ionsound/ion.sound.min.js"></script>
        <script src="./assets/js/bootbox.js"></script>
		
  
        <!-- START @PAGE LEVEL PLUGINS -->
        <script src="./assets/js/bootstrap-tagsinput.min.js"></script>
        <script src="./assets/js/jasny-bootstrap.fileinput.min.js"></script>
        <script src="./assets/js/jquery.dataTables.min.js"></script>
        <script src="./assets/js/dataTables.bootstrap.js"></script>
        <script src="./assets/js/datatables.responsive.js"></script>
        <script src="./assets/js/fuelux.min.js"></script>
        <script src="./assets/js/jquery.rtnotify.js"></script>
        <script src="./assets/js/chosen.jquery.min.js"></script>
        <script src="./assets/js/apps.js"></script>
		<script src="./assets/js/tableToExcel.js"></script>
        <script src="./assets/js/apps.js"></script>
        <script src="./assets/js/bootstrap-switch.min.js"></script>

        <script>
<?php if (isset($_GET['delete'])): ?>
                $(document).ready(function () {
                    $.rtnotify({title: "Procedimento Realizado",
                        type: "default"});				
                });				
<?php endif; ?>
		</script>
        <script>
<?php if (isset($_GET['success'])): ?>
                $(document).ready(function () {
                    $.rtnotify({title: "Procedimento Realizado!",
                        type: "default"});				
                });				
<?php endif; ?>

            $("[name='switch']").bootstrapSwitch();

            $('.atualizar').on('click', function () {
                var id = $(this).attr('data-update');
                $('#servico_id').val(id);
                var url = "servico_fn.php?acao=Json";
                $.getJSON(url, {servico_id: id}, function (data) {
                    //console.log(data);
                    $('#modal-16  #servico_id').val(data.servico_id);
                    $('#modal-16  #social_url').val(data.social_url);
                });
                $('#modal-16').modal('show');
            });
            $(".sound").on("click", function () {
                ion.sound.play("button_push.mp3");
            });
            $('.delete').on('click', function () {
                var url = $(this).attr('data-url');
                $('#MODALREMOVE').modal('show');
                $('#btn-confirm-remove').on('click', function () {
                    window.location = url;
                });
            });

            $('.listarservico').addClass('active');
        </script>
    </body>
</html>