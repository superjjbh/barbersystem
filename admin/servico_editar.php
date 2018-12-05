<?php
require_once '../loader.php';
@session_start();
if (!isset($_SESSION['LOGADO']) || $_SESSION['LOGADO'] == FALSE) {
    @header('location:' . Validacao::getBase() . 'admin/logar/');
    exit;
}
$site = new Site();
$site->getMeta();

$contatos = new Contato();
$contatos->getContato();                                    

$icon = new Icon();
$icon->db = new DB;
$icon->getIcones();
$servico_id = intval($_GET['id']);
$servico = new Servico();
$servico->servico_id = $servico_id;
$servico->getServico();

$profissional = new Profissional();
$profissional->db = new DB;
$profissional->getAreas();

$horario = new Horario();
$horario->db = new DB;
$horario->getAreas();

$pagina_id = intval($_GET['id']);
$pagina = new Pagina();
$pagina->db = new DB;
$pagina->getPosts();
$pagina->pagina_id = "$pagina_id";


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
        <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
        <!--/ END GLOBAL MANDATORY STYLES -->

        <!-- START @PAGE LEVEL STYLES -->
        <link href="./assets/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="./assets/css/animate.min.css" rel="stylesheet">
        <link href="./assets/css/bootstrap-tagsinput.css" rel="stylesheet">
        <link href="./assets/css/jasny-bootstrap-fileinput.min.css" rel="stylesheet">
        <link href="./assets/css/chosen.min.css" rel="stylesheet">
        <!--/ END PAGE LEVEL STYLES -->

        <!-- START @THEME STYLES -->
        <link href="./assets/css/reset.css" rel="stylesheet">
        <link href="./assets/css/layout.css" rel="stylesheet">
        <link href="./assets/css/components.css" rel="stylesheet">
        <link href="./assets/css/plugins.css" rel="stylesheet">
        <link href="./assets/css/themes/default.theme.css" rel="stylesheet" id="theme">
        <link href="./assets/css/custom.css" rel="stylesheet">

		<script language="javascript">
		function topo()
		{
			parent.scroll(0,0);
		}		
		</script> 

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

    <body onload="topo();">

        <!--[if lt IE 9]>
        <p class="upgrade-browser">Upps!! You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- START @WRAPPER -->
        <section id="wrapper" class="page-sound">
            <!-- START @HEADER -->
            <?php require_once './navegacao.php'; ?>
            <!--/ END HEADER -->



            <!-- /#sidebar-left -->
            <?php require_once './menu.php'; ?>
            <!--/ END SIDEBAR LEFT -->

            <!-- START @PAGE CONTENT -->
            <section id="page-content">

                <!-- Start page header -->
                <div class="header-content">
                    <h2><i class="fa fa-suitcase"></i>  <span>Agendamento</span></h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label">Você está em :</span>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="home/">Dashboard</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Agendamentos</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ol>
                    </div><!-- /.breadcrumb-wrapper -->
                </div><!-- /.header-content -->
                <!--/ End page header -->

                <!-- Start body content -->
                <div class="body-content animated fadeIn">

                    <!-- Start input fields - basic form -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h3 class="panel-title"><a href="cliente/"><button class="btn btn-warning"><i class="fa fa-calendar"></i> Voltar para Agenda</button></a></h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!-- /.panel-heading -->
                                <div class="clearfix"></div>
                                <div class="panel-body no-padding">
							    <?php
                                    if (isset($_POST['servico_email']) && !empty($_POST['servico_email'])) {
                                        
										date_default_timezone_set('America/Sao_Paulo');

									  
										  
										$data = date('d/m/Y');
										
										$servico_nome = addslashes($_POST['servico_nome']);
										$servico_icon = $_POST['servico_icon'];
										$servico_descricao = addslashes($_POST['servico_descricao']);
										$servico_valor = addslashes($_POST['servico_valor']);
										$servico_valor_adicional = addslashes($_POST['servico_valor_adicional']);
										$servico_valor_total = addslashes($_POST['servico_valor_total']);
										$servico_unidade = addslashes($_POST['servico_unidade']);
										$servico_email = $_POST['servico_email'];
										$servico_pagina = $_POST['servico_pagina'];
										$servico_horario = $_POST['servico_horario'];
										$servico_data = $_POST['servico_data'];
										$servico_status = $_POST['servico_status'];
										$servico_profissional = $_POST['servico_profissional'];
										$servico_adicional = $_POST['servico_adicional'];
										$servico_adicional2 = $_POST['servico_adicional2'];
										$servico_adicional3 = $_POST['servico_adicional3'];
										$servico_adicional4 = $_POST['servico_adicional4'];
										$servico_pagamento = $_POST['servico_pagamento'];
										$servico_id = addslashes($_POST['servico_id']);
											
										$servico = new Servico();
										$servico->db = new DB;
										$servico->servico_status = $servico_status;
										$servico->servico_data = $servico_data;
										$servico->servico_profissional = $servico_profissional;
										$servico->servico_id = intval($_REQUEST['servico_id']);
										$servico->atualizastatus();
										
										require_once '../plugin/email/email.php';
										global $mail;
										$smtp = new Smtpr();
										$smtp->getSmtp();
										$mail->Port = $smtp->smtp_port;
										$mail->Host = $smtp->smtp_host;
										$mail->Username = $smtp->smtp_username;
										$mail->From = $smtp->smtp_username;
										$mail->Password = $smtp->smtp_password;
										$mail->FromName = $smtp->smtp_fromname;
										$mail->Subject = utf8_decode("Agendamento (Status Atualizado) - " . $site->site_meta_titulo);
										$mail->AddBCC($servico->servico_email);
										$mail->AddCC($smtp->smtp_username);
										$mail->AddAddress($smtp->smtp_username);
										
										if($_POST['servico_status'] == 1)
										{
											$servico_status = 'Confirmado';
										}
										else if($_POST['servico_status'] == 2)
										{
											$servico_status = 'Finalizado e Atendido';
										}
										else if($_POST['servico_status'] == 3)
										{
											$servico_status = 'Pago e Confirmado';
										}
										else
										{
											$servico_status = 'Não Confirmado';
										}

										
										$mail->AddReplyTo($servico_email);
										$body = "<b>Data do envio: </b> $data <br />";
										$body .= "<b>Nome:</b> $servico_nome <br />";
										$body .= "<b>Celular (WhatsApp):</b> $servico_icon <br />";
										$body .= "<b>E-mail:</b> $servico_email <br />";
										$body .= "<b>Profissional designado: </b>$servico_profissional <br />";
										$body .= "<b>Data escolhida: </b>$servico_data <br />";
										$body .= "<b>Horário escolhido: </b>$servico_horario <br />";
										$body .= "<b>O status do seu agendamento foi alterado para: </b>$servico_status <br /><br />";
										$body .= "Confira os detalhes do seu agendamento nesse link: http://$site->site_sobre_titulo/retorno/$servico_id/. <br /><br />";
										$body .= "Qualquer dúvida, entre em contato conosco! <br /><br />";
										$body .= "Atenciosamente, <br /><br />";
										$body .= "$site->site_meta_titulo <br />";
										$body .= "$site->site_meta_desc<br />";
										$body .= "$site->site_meta_palavra<br /><br />";
																				
										$mail->Body = nl2br($body);
										
										
										if ($mail->Send()) {
											//echo '<script>alert("Atualizado com sucesso. O Cliente recebeu um e-mail sobre o Status! Agora será notificado pelo WhatsApp!");</script>';
											
											$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
											$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
											$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
											$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
											$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

											// check if is a mobile
											//if ($iphone || $android || $palmpre || $ipod || $berry == true)
											//{
											  //header('Location: https://api.whatsapp.com/send?phone=55$servico_icon&text=Ola $servico_nome, tudo bem? O status do seu agendamento para alterado para: *$servico_status* | Confira os detalhes do seu agendamento nesse link: *http://$site->site_sobre_titulo/app/retorno.php?id=$servico_id* Att, $site->site_meta_titulo');
											  //OR
											  //echo "<script>window.location='https://api.whatsapp.com/send?phone=55$servico_icon&text=Ola $servico_nome, tudo bem? O status do seu agendamento para alterado para: *$servico_status* | Confira os detalhes do seu agendamento nesse link: *http://$site->site_sobre_titulo/app/retorno.php?id=$servico_id* Att, $site->site_meta_titulo'</script>";
											//}

											// all others
											//else {
											  //header('Location: https://web.whatsapp.com/send?phone=55$servico_icon&text=Ola $servico_nome, tudo bem? O status do seu agendamento para alterado para: *$servico_status* | Confira os detalhes do seu agendamento nesse link: *http://$site->site_sobre_titulo/app/retorno.php?id=$servico_id* Att, $site->site_meta_titulo');
											  //OR
											  //echo "<script>window.location='https://web.whatsapp.com/send?phone=55$servico_icon&text=Ola $servico_nome, tudo bem? O status do seu agendamento para alterado para: *$servico_status* | Confira os detalhes do seu agendamento nesse link: *http://$site->site_sobre_titulo/app/retorno.php?id=$servico_id* Att, $site->site_meta_titulo'</script>";
											//}											
											
											echo "<div class='alert alert-success' id='msg_alert'> <h4><font style='color:#009900;font-weight:bold;'><strong>Atualizado com sucesso!</strong> O Cliente recebeu um e-mail sobre o Status! Clique no botão abaixo para notificá-lo pelo WhatsApp! </font></h4></div>";
											echo "<a href='https://api.whatsapp.com/send?phone=55$servico_icon&text=Ola $servico_nome, tudo bem? O status do seu agendamento do serviço: nº: $servico_id foi alterado para: *$servico_status* | Confira os detalhes do seu agendamento nesse link: http://$site->site_sobre_titulo/retorno/$servico_id/ Att, $site->site_meta_titulo' target='_blank'><img src='./images/notifica.png' /></a>";

											//echo "<script>location.href='https://api.whatsapp.com/send?phone=55$servico_icon&text=Ola $servico_nome, tudo bem? O status do seu agendamento para alterado para: *$servico_status* | Confira os detalhes do seu agendamento nesse link: $site->site_sobre_titulo/app/retorno.php?id=$servico_id Att, $site->site_meta_titulo';</script>";
											
                                        } else {
                                            echo "<p class='alert alert-danger' id='msg_alert'> Erro ao enviar  Mensagem: $mail->ErrorInfo</p>";
                                        }
                                    }
                                    $contatos = new Contato();
                                    $contatos->getContato();  
											//<form method="post" action="servico_fn.php?acao=atualizar">
                                    ?>                                    
									<div class="form-body">
										<form method="post" id="contactfrm" role="form">
												<input type="hidden" id="servico_id"  name="servico_id" value="<?= $servico->servico_id ?>">
												<input type="hidden" id="servico_nome"  name="servico_nome" value="<?= $servico->servico_nome ?>">
												<input type="hidden" id="servico_icon"  name="servico_icon" value="<?= $servico->servico_icon ?>">
												<input type="hidden" id="servico_data"  name="servico_data" value="<?= $servico->servico_data ?>">
												<input type="hidden" id="servico_horario"  name="servico_horario" value="<?= $servico->servico_horario ?>">
												<input type="hidden" id="servico_email"  name="servico_email" value="<?= $servico->servico_email ?>">

                                            <div class="form-group">
                                                <label class="control-label">Status Atual do Agendamento</label>
												<?php if (stripslashes($servico->servico_status) == 0): ?>
                                                <input class="form-control rounded" type="text" style="border:2px solid red;" id="servico_status_view" name="servico_status_view" readonly value="NÃO CONFIRMADO" />
                                                <?php endif; ?>
												<?php if (stripslashes($servico->servico_status) == 1): ?>
                                                <input class="form-control rounded" type="text" style="border:2px solid yellow;" id="servico_status_view" name="servico_status_view" readonly value="CONFIRMADO" />
                                                <?php endif; ?>
												<?php if (stripslashes($servico->servico_status) == 2): ?>
                                                <input class="form-control rounded" type="text" style="border:2px solid green;" id="servico_status_view" name="servico_status_view" readonly value="FINALIZADO E ATENDIDO" />
                                                <?php endif; ?>
												<?php if (stripslashes($servico->servico_status) == 3): ?>
                                                <input class="form-control rounded" type="text" style="border:2px solid blue;" id="servico_status_view" name="servico_status_view" readonly value="PAGO E CONFIRMADO" />
                                                <?php endif; ?>
												<select data-placeholder="Selecione um status" required name="servico_status" class="form-control" >
                                                    <option value="">Selecione um Novo Status</option>
                                                    <option value="1">CONFIRMADO</option>
													<option value="2">FINALIZADO E ATENDIDO</option>
													<option value="3">PAGO E CONFIRMADO</option>
													<option value="0">NÃO CONFIRMADO</option>
                                                </select>
											</div>
                                            <div class="form-group ">
                                                <label class="control-label">Será atendido(a) por</label>
                                                <input class="form-control rounded" type="text" id="servico_profissional" name="servico_profissional" readonly value="<?= stripslashes($servico->servico_profissional) ?>" />
                                                <select data-placeholder="Selecione um profissional" name="servico_profissional" class="form-control" >
                                                    <option value="<?= stripslashes($servico->servico_profissional) ?>">Selecione outro profissional</option>
                                                    <?php if (isset($profissional->db->data[0])): ?>
                                                        <?php foreach ($profissional->db->data as $categoria): ?>
                                                            <option value="<?= $categoria->profissional_nome ?>"><?= $categoria->profissional_nome ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>																						
                                            <div class="form-group">
											<button class="btn btn-primary" type="submit">Atualizar</button>   
											</div>
										
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End body content -->
            </section>
        </section>

        <!-- START @BACK TOP -->
        <div id="back-top" class="animated pulse circle">
            <i class="fa fa-angle-up"></i>
        </div><!-- /#back-top -->
        <!--/ END BACK TOP -->

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
        <!--/ END CORE PLUGINS -->

        <!-- START @PAGE LEVEL PLUGINS -->
        <script src="./assets/js/bootstrap-tagsinput.min.js"></script>
        <script src="./assets/js/jasny-bootstrap.fileinput.min.js"></script>
        <script src="./assets/js/holder.js"></script>
        <script src="./assets/js/bootstrap-maxlength.min.js"></script>
        <script src="./assets/js/jquery.autosize.min.js"></script>
        <script src="./assets/js/chosen.jquery.min.js"></script>
        <!--/ END PAGE LEVEL PLUGINS -->

        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="./assets/js/apps.js"></script>
        <script src="./assets/js/dark.form.js"></script>
        <script src="./assets/js/bootstrap-datepicker.js"></script>
        <script src="./assets/js/bootstrap-datepicker.pt-BR.js"></script>
        <!--/ END PAGE LEVEL SCRIPTS -->
        <!--/ END JAVASCRIPT SECTION -->

    </body>
    <script>
        $('#servico_data').datepicker({
          format: "dd/mm/yyyy",
            language: "pt-BR"
        });
function mascaraData(val) {
  var pass = val.value;
  var expr = /[0123456789]/;
  
  for (i = 0; i < pass.length; i++) {
    // charAt -> retorna o caractere posicionado no índice especificado
    var lchar = val.value.charAt(i);
    var nchar = val.value.charAt(i + 1);

    if (i == 0) {
      // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
      // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
      // instStr.search(expReg);
      if ((lchar.search(expr) != 0) || (lchar > 3)) {
        val.value = "";
      }

    } else if (i == 1) {

      if (lchar.search(expr) != 0) {
        // substring(indice1,indice2)
        // indice1, indice2 -> será usado para delimitar a string
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
        continue;
      }

      if ((nchar != '/') && (nchar != '')) {
        var tst1 = val.value.substring(0, (i) + 1);

        if (nchar.search(expr) != 0)
          var tst2 = val.value.substring(i + 2, pass.length);
        else
          var tst2 = val.value.substring(i + 1, pass.length);

        val.value = tst1 + '/' + tst2;
      }

    } else if (i == 4) {

      if (lchar.search(expr) != 0) {
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
        continue;
      }

      if ((nchar != '/') && (nchar != '')) {
        var tst1 = val.value.substring(0, (i) + 1);

        if (nchar.search(expr) != 0)
          var tst2 = val.value.substring(i + 2, pass.length);
        else
          var tst2 = val.value.substring(i + 1, pass.length);

        val.value = tst1 + '/' + tst2;
      }
    }

    if (i >= 6) {
      if (lchar.search(expr) != 0) {
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
      }
    }
  }

  if (pass.length > 10)
    val.value = val.value.substring(0, 10);
  return true;
}
    </script>
    <script>
        $('.servicoeditar').addClass('active');
        $('#servico_icon').val("<?= $servico->servico_icon ?>").trigger("chosen:updated");
        $(".sound").on("click", function () {
            ion.sound.play("button_push.mp3");
        });
    </script>
    <!--/ END BODY -->

</html>