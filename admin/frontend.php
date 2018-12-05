<?php
include_once '../loader.php';
@session_start();
if (!isset($_SESSION['LOGADO']) || $_SESSION['LOGADO'] == FALSE) {
    @header('location:' . Validacao::getBase() . 'admin/logar/');
    exit;
}
$site = new Site();
$site->getMeta();

$icones = new Icon();
$icones->getIcones();

$modulo_aparencia = new ModuloAparencia();
$modulo_aparencia->getModuloAparencia();

$modulo1 = new Modulo1();
$modulo1->getModulo1();

$modulo2 = new Modulo2();
$modulo2->getModulo2();

$modulo3 = new Modulo3();
$modulo3->getModulo3();

$modulo4 = new Modulo4();
$modulo4->getModulo4();

$modulo5 = new Modulo5();
$modulo5->getModulo5();

$modulo6 = new Modulo6();
$modulo6->getModulo6();

$modulo7 = new Modulo7();
$modulo7->getModulo7();

$modulo8 = new Modulo8();
$modulo8->getModulo8();

$modulo9 = new Modulo9();
$modulo9->getModulo9();

$modulo10 = new Modulo10();
$modulo10->getModulo10();

$modulo11 = new Modulo11();
$modulo11->getModulo11();

$contato = new Contato();
$contato->getContato();

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
        <link href="./assets/css/ion.rangeSlider.css" rel="stylesheet">
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
        <link href="./assets/css/summernote.css" rel="stylesheet">
        <!--/ END THEME STYLES -->

        <!-- START @IE SUPPORT -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="./assets/js/html5shiv.min.js"></script>
        <script src="./assets/js/respond.min.js"></script>
        <![endif]-->
        <!--/ END IE SUPPORT -->
		<script language="javascript">
		function habilitar(){
		  if(document.getElementById('Ativado').checked == true){
			document.getElementById('site_imagem').disabled = false;
			document.getElementById('site_imagem').focus();			
		  }
		  if(document.getElementById('Desativado').checked == true){
			document.getElementById('site_imagem').disabled = true;
			document.getElementById('site_imagem').value = null;
		  }
		}
		</script>  
		<script language="javascript">
		function topo()
		{
			parent.scroll(0,0);
		}		
		</script> 
		<script type="text/javascript">
		function carregar()
		{
			topo();
			habilitar();
		}		
		</script>		
    </head>
    <body onload="carregar();">
        <!--[if lt IE 9]>
        <p class="upgrade-browser">Upps!! You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <section id="wrapper" class="page-sound">
            <?php require_once './navegacao.php'; ?>
            <?php require_once './menu.php'; ?>
            <section id="page-content">
                <div class="header-content">
                    <h2><i class="fa fa-cog"></i> Dados do App</span></h2>
                    <div class="breadcrumb-wrapper hidden-xs">
                        <span class="label">Você está em :</span>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="home/">Dashboard</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Dados do App</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="body-content animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel rounded shadow">
                                <div class="panel-sub-heading">
                                    <div class="callout callout-info" style="padding-top: 19px;"><p><strong>Gerenciar "Sobre nós" e "Dados do App e Expediente"</strong></p></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="panel-body no-padding">
                                    <div class="form-body">
                                        <div class="panel-group" id="accordion">
                                            <!-- **************************** MODULO APARÊNCIA ****************************-->
                                            <div class="panel panel-lilac hidden">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#aparencia">
                                                            <i class="fa fa-list"></i> Aparência do Site<span class="pull-right"><i class="fa fa-edit"></i></span> 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="aparencia" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <form enctype="multipart/form-data" method="post" action="modulo_aparencia_fn.php?acao=atualizar">
                                                            <div class="form-group" >
                                                                <label class="control-label"><i class="fa fa-paint-brush"></i> Cores do site</label>
                                                                <select class="form-control input-sm mb-15 rounded" id="modulo_aparencia_cor" name="modulo_aparencia_cor" style="text-transform: uppercase;" >
                                                                    <option value="">Selecione uma Cor</option>
                                                                    <option value="blue">Azul</option>
                                                                    <option value="coffee">Coffee</option>
                                                                    <option value="dark">Preto</option>
                                                                    <option value="green">Verde</option>
                                                                    <option value="light">Azul Claro</option>
                                                                    <option value="orange">Laranja</option>
                                                                    <option value="red">Vermelho</option>
                                                                    <option value="pink">Violeta</option>
                                                                    <option value="yellow">Amarelo</option>
                                                                    <option value="sea-green">Verde Água</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group" >
                                                                <label class="control-label"><i class="fa fa-"></i> Tela Wide ou Boxed</label>
                                                                <select class="form-control input-sm mb-15 rounded" id="modulo_aparencia_wide" name="modulo_aparencia_wide" style="text-transform: uppercase;" >
                                                                    <option value="">Selecione um tipo</option>
                                                                    <option value="bwide">Wide</option>
                                                                    <option value="boxedLayout">Boxed</option>
                                                                </select>
                                                            </div>                                                            
                                                            <div class="form-group">
                                                                <label class="control-label">Favicon</label>
                                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                    <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                                    <span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new">Selecione  Favicon</span><span class="fileinput-exists">Mudar  Favicon</span><input type="file" id="modulo_aparencia_favicon" name="modulo_aparencia_favicon" /></span>
                                                                    <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Imagem da Logo</label>
                                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                    <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                                    <span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new">Selecione Logo</span><span class="fileinput-exists">Mudar Logo</span><input type="file" id="modulo_aparencia_logo" name="modulo_aparencia_logo" /></span>
                                                                    <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
                                                                </div>
                                                                <input class="form-control rounded" type="hidden" id="modulo_aparencia_id" name="modulo_aparencia_id" value="<?= $modulo_aparencia->modulo_aparencia_id ?>" />
                                                            </div>
                                                            <div class="form-footer">
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary" type="submit">Atualizar</button>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- **************************** MODULO APARÊNCIA ****************************-->
                                            <div class="panel panel-lilac hidden">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#One">
                                                            <i class="fa fa-list"></i> Topo <span class="pull-right"><i class="fa fa-edit"></i></span> 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="One" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <form enctype="multipart/form-data" method="post" action="modulo1_fn.php?acao=atualizar">
                                                            <div class="form-group">
                                                                <label class="control-label"><i class="fa fa-exclamation-triangle" style="color:yellow"></i> Status do Módulo</label>
                                                                <select class="form-control input-sm mb-15 rounded" id="modulo1_status" name="modulo1_status">
                                                                    <option value="">Selecione uma Opção</option>
                                                                    <option value="1">Ativado</option>
                                                                    <option value="0">Desativado</option>
                                                                </select>
                                                            </div>


                                                            <br />
                                                            <div class="form-group">
                                                                <label class="control-label">Título</label>
                                                                <textarea class="form-control rounded" type="text" id="modulo1_nome"  name="modulo1_nome" style="max-height:50px;" placeholder="Texto com duas cores use exemplo (Welcome to <span class='colored'> oxygen</span>)"><?= stripslashes($modulo1->modulo1_nome) ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Subtítulo </label>
                                                                <textarea class="form-control rounded" type="text" id="modulo1_subtitulo1"  name="modulo1_subtitulo1" style="max-height:50px;" placeholder="Texto com duas cores use exemplo (Welcome to <span class='colored'> oxygen</span>)"><?= stripslashes($modulo1->modulo1_subtitulo1) ?></textarea>
                                                                <input type="hidden" id="modulo1_id"  name="modulo1_id" value="<?= $modulo1->modulo1_id ?>" />
                                                            </div>

                                                            <div class="form-footer">
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary" type="submit">Atualizar</button>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- **************************** MODULO 1 ****************************-->


                                            <!-- **************************** MODULO 3 ****************************-->
                                            <div class="panel panel-custom">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#Three">
                                                            <i class="fa fa-list"></i> Sobre nós  <span class="pull-right"><i class="fa fa-edit"></i></span> 
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div id="Three" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <form method="post" enctype="multipart/form-data" action="modulo3_fn.php?acao=atualizar">
                                                            <div class="form-group">
                                                                <div class="panel-body">
                                                                    <div class="form-group">
                                                                        <label class="control-label"><i class="fa fa-exclamation-triangle" style="color:yellow"></i> Status do Módulo</label>
                                                                        <select class="form-control input-sm mb-15 rounded" id="modulo3_status" name="modulo3_status">
                                                                            <option value="">Selecione uma Opção</option>
                                                                            <option value="1">Ativado</option>
                                                                            <option value="0">Desativado</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Título</label>
                                                                        <textarea class="form-control rounded" type="text"  name="modulo3_nome" style="max-height:50px;"><?= stripslashes($modulo3->modulo3_nome) ?></textarea>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group">
                                                                            <div class="row-fluid">
                                                                                <div class="col-md-11 pull-right">
                                                                                    <label class="control-label">Foto</label>
                                                                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                                        <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                                                        <span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new">Selecione a Imagem</span><span class="fileinput-exists">Mudar de Imagem</span><input type="file" id="modulo3_imagem" name="modulo3_imagem"></span>
                                                                                        <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    <img src="thumb.php?w=100&h=100&zc=0&src=../images/<?= $modulo3->modulo3_imagem ?>" class="img-thumbnail" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div style="margin-bottom: 20px;"></div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Descrição</label>
                                                                        <textarea class="form-control rounded" type="text" id="modulo3_descricao"  name="modulo3_descricao" style="max-height:50px;"><?= stripslashes($modulo3->modulo3_descricao) ?></textarea>
                                                                    </div>
                                                                    <div class="form-footer">
                                                                        <div class="text-center">
                                                                            <button class="btn btn-primary" type="submit">Atualizar</button>
                                                                            <input class="form-control rounded" type="hidden" id="modulo3_id" name="modulo3_id" value="<?= $modulo3->modulo3_id ?>" />
                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- **************************** MODULO 3 ****************************-->


                                            <!-- **************************** MODULO 5 ****************************-->

                                            <div class="panel panel-custom">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#accordionfive" >
                                                            <i class="fa fa-list"></i> Dados do App e Expediente  <span class="pull-right"><i class="fa fa-edit"></i></span> 
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div id="accordionfive" class="panel-collapse collapse">
                                                    <form method="post" action="site_fn.php?acao=atualizar">
                                                        <div class="panel-body">
                                                            <div class="form-group ">
																<label class="control-label">Título do App</label>
																<input class="form-control rounded" type="text"  id="site_meta_titulo"  name="site_meta_titulo" required value="<?= stripslashes($site->site_meta_titulo) ?>">
                                                            </div>
                                                            <div class="form-group ">
																<label class="control-label">Endereço Web do App</label>
																<input class="form-control rounded" type="text"  id="site_sobre_titulo"  name="site_sobre_titulo" required value="<?= stripslashes($site->site_sobre_titulo) ?>">
                                                            </div>
															<div class="callout callout-warning">
																<h6 class="no-margin" style="padding-top: 10px;">  Preencha dessa forma: DDDNÚMERO. Exemplo: 31986407398</a></h6>
															</div>
                                                            <div class="form-group ">
																<label class="control-label"> Número do WhatsApp (Exclusivo para o Aplicativo)</label>
																<input class="form-control rounded" type="text"  id="site_meta_autor"  name="site_meta_autor" required value="<?= stripslashes($site->site_meta_autor) ?>">
                                                            </div>
                                                            <div class="form-group ">
																<label class="control-label"> Telefone Geral</label>
																<input class="form-control rounded" type="text"  id="site_meta_desc"  name="site_meta_desc" required value="<?= stripslashes($site->site_meta_desc) ?>">
                                                            </div>
                                                            <div class="form-group ">
																<label class="control-label"> E-mail Geral</label>
																<input class="form-control rounded" type="text"  id="site_meta_palavra"  name="site_meta_palavra" required value="<?= stripslashes($site->site_meta_palavra) ?>">
                                                            </div>
															<div class="callout callout-warning">
																<h6 class="no-margin" style="padding-top: 10px;">  Saiba como obter o código para adicionar a galeria de fotos do seu Instagram nesse link: <a href="https://lightwidget.com/" target="_blank">OBTER CÓDIGO</a></br>Assista esse vídeo, e veja como obter esse código: LINK</h6>
															</div>
                                                            <div class="form-group ">
																<label class="control-label"> Código Galeria Instagram</label>
                                                                <textarea class="form-control rounded" type="text"  name="site_sobre" style="max-height:50px;"><?= stripslashes($site->site_sobre) ?></textarea>
                                                            </div>
                                                            <br />
															<label class="control-label">Habilitar Pagamento Online PagSeguro</label>
															<div class="callout callout-warning">
																<h6 class="no-margin" style="padding-top: 10px;">  Se a opção abaixo estiver "Ativado", os pagamentos online pelo PagSeguro, referente aos serviços, estarão habilitados.</a></h6>
															</div>
															<div class="form-group">
																<input type="radio" onClick="habilitar()" name="site_logo" id="Ativado" value="Ativado" <?php echo ($site->site_logo=='Ativado')?'checked':'' ?> > Ativado</br>
																<input type="radio" onClick="habilitar()" name="site_logo" id="Desativado" value="Desativado" <?php echo ($site->site_logo=='Desativado')?'checked':'' ?> > Desativado
																</br>
																<label class="control-label">E-mail cadastrado no PagSeguro</label>
																<input type="text" class="form-control rounded" placeholder="Quando 'Ativado' Informar E-mail" required id="site_imagem" name="site_imagem" value="<?= $site->site_imagem ?>">
                                                            </div>
															<div class="callout callout-warning">
																<h6 class="no-margin" style="padding-top: 10px;">  Informe o expediente completo, com os dias da semana, quando há atendimento! Ex.: Atendemos de Segunda a Sábado de 9:00 às 18:00</a></h6>
															</div>
                                                            <div class="form-group">
																<label class="control-label"> Expediente completo</label>
																<input type="text" class="form-control rounded" id="site_analytics" required name="site_analytics" value="<?= $site->site_analytics ?>">
																<input type="hidden"  id="site_id"  name="site_id" value="<?= $site->site_id ?>" />
															</div>
															

                                                            <div class="form-footer">
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary" type="submit">Atualizar</button>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- **************************** MODULO 5 ****************************-->


                                            <!-- **************************** MODULO 7 ****************************-->
                                            <div class="panel panel-lilac hidden">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#accordionseven">
                                                            <i class="fa fa-list"></i> Catálogo de Veículos  <span class="pull-right"><i class="fa fa-edit"></i></span> 
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div id="accordionseven" class="panel-collapse collapse">
                                                    <form method="post" action="modulo7_fn.php?acao=atualizar">
                                                        <div class="panel-body">
                                                            <div class="form-group ">
                                                                <label class="control-label"><i class="fa fa-exclamation-triangle" style="color:yellow"></i> Status do Módulo</label>
                                                                <select class="form-control input-sm mb-15 rounded" id="modulo7_status" name="modulo7_status">
                                                                    <option value="">Selecione uma Opção</option>
                                                                    <option value="1">Ativado</option>
                                                                    <option value="0">Desativado</option>
                                                                </select>
                                                            </div>


                                                            <div class="form-group">
                                                                <label class="control-label">Título</label>
                                                                <textarea class="form-control rounded" type="text"  name="modulo7_nome" style="max-height:50px;"><?= stripslashes($modulo7->modulo7_nome) ?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Descricao</label>
                                                                <textarea class="form-control rounded" type="text"  name="modulo7_descricao" style="max-height:50px;"><?= stripslashes($modulo7->modulo7_descricao) ?></textarea>
                                                                <input class="form-control rounded" type="hidden" id="modulo7_id" name="modulo7_id" value="<?= $modulo7->modulo7_id ?>" />
                                                            </div>

                                                            <div class="form-footer">
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary" type="submit">Atualizar</button>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- **************************** MODULO 7 ****************************-->

                                            <!-- **************************** MODULO 9 ****************************-->
                                            <div class="panel panel-lilac hidden">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#accordionnine">
                                                            <i class="fa fa-list"></i> Contato  <span class="pull-right"><i class="fa fa-edit"></i></span> 
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div id="accordionnine" class="panel-collapse collapse">
                                                    <form enctype="multipart/form-data" method="post" action="modulo9_fn.php?acao=atualizar">
                                                        <div class="panel-body">
                                                            <div class="form-group ">
                                                                <label class="control-label"><i class="fa fa-exclamation-triangle" style="color:yellow"></i> Status do Módulo</label>
                                                                <select class="form-control input-sm mb-15 rounded" id="modulo9_status" name="modulo9_status">
                                                                    <option value="">Selecione uma Opção</option>
                                                                    <option value="1">Ativado</option>
                                                                    <option value="0">Desativado</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Título</label>
                                                                <textarea class="form-control rounded" type="text"   name="modulo9_nome" style="max-height:50px;"><?= stripslashes($modulo9->modulo9_nome) ?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Subtítulo</label>
                                                                <textarea class="form-control rounded" type="text"   name="modulo9_subtitulo" style="max-height:50px;"><?= stripslashes($modulo9->modulo9_subtitulo) ?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Botão</label>
                                                                <input class="form-control rounded" type="text" name="modulo9_button" value="<?= stripslashes($modulo9->modulo9_button) ?>" />
                                                                <input class="form-control rounded" type="hidden" id="modulo9_id" name="modulo9_id" value="<?= $modulo9->modulo9_id ?>" />
                                                            </div>

                                                            <div class="form-group hidden">
                                                                <label class="control-label">Imagem</label>
                                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                    <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                                    <span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new">Selecione a Imagem</span><span class="fileinput-exists">Mudar de Imagem</span><input type="file" id="modulo9_imagem" name="modulo9_imagem"></span>
                                                                    <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
                                                                </div>
                                                            </div>

                                                            <div class="form-footer">
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary" type="submit">Atualizar</button>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- **************************** MODULO 9 ****************************-->
                                            <!-- **************************** MODULO 10 ****************************-->
                                            <div class="panel panel-lilac hidden">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#accordionten">
                                                            <i class="fa fa-list"></i> Página Serviços  <span class="pull-right"><i class="fa fa-edit"></i></span> 
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div id="accordionten" class="panel-collapse collapse">
                                                    <form enctype="multipart/form-data" method="post" action="modulo10_fn.php?acao=atualizar">
                                                        <div class="panel-body">
                                                            <div class="form-group ">
                                                                <label class="control-label"><i class="fa fa-exclamation-triangle" style="color:yellow"></i> Status do Módulo</label>
                                                                <select class="form-control input-sm mb-15 rounded" id="modulo10_status" name="modulo10_status">
                                                                    <option value="">Selecione uma Opção</option>
                                                                    <option value="1">Ativado</option>
                                                                    <option value="0">Desativado</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-sm-12 control-label">Paginação</label>
                                                                <div class="col-sm-12">
                                                                    <div class="slider-primary">
                                                                        <input id="pagina" type="text" name="modulo10_paginacao" value="<?= $modulo10->modulo1_paginacao ?>" />
                                                                    </div>
                                                                    <br />
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Título</label>
                                                                <textarea class="form-control rounded" type="text"  name="modulo10_nome" style="max-height:50px;"><?= stripslashes($modulo10->modulo10_nome) ?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Subtítulo</label>
                                                                <textarea class="form-control rounded" type="text"  name="modulo10_subtitulo" style="max-height:50px;"><?= stripslashes($modulo10->modulo10_subtitulo) ?></textarea>
                                                            </div>

                                                            <div class="form-group hidden">
                                                                <label class="control-label"> Ícones</label>
                                                                <select  class="chosen-select mb-15" data-placeholder="Selecione um Ícone" id="modulo10_icon" name="modulo10_icon">
                                                                    <option value="">Selecione um Ícone</option>
                                                                    <?php foreach ($icones->db->data as $modulo10_icon) : ?>
                                                                        <option  value="<?= $modulo10_icon->icones_nome ?>"><?= $modulo10_icon->icones_nome ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group  hidden">
                                                                <label class="control-label">Texto</label>
                                                                <input class="form-control rounded" type="text" name="modulo10_button" value="<?= stripslashes($modulo10->modulo10_button) ?>" />
                                                            </div>

                                                            <div class="form-group  hidden">
                                                                <label class="control-label">Botão</label>
                                                                <input class="form-control rounded" type="text" name="modulo10_button1" value="<?= stripslashes($modulo10->modulo10_button1) ?>" />
                                                                <input class="form-control rounded" type="hidden" id="modulo10_id" name="modulo10_id" value="<?= $modulo10->modulo10_id ?>" />
                                                            </div>

                                                            <div class="form-group hidden">
                                                                <label class="control-label">Imagem</label>
                                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                    <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                                    <span class="input-group-addon btn btn-success btn-file"><span class="fileinput-new">Selecione a Imagem</span><span class="fileinput-exists">Mudar de Imagem</span><input type="file" id="modulo10_imagem" name="modulo10_imagem"></span>
                                                                    <a href="#" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Remover</a>
                                                                </div>
                                                            </div>

                                                            <div class="form-footer">
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary" type="submit">Atualizar</button>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- **************************** MODULO 10 ****************************-->
                                            <!-- **************************** MODULO 11 ****************************-->
                                            <div class="panel panel-lilac hidden">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#accordioneleven">
                                                            <i class="fa fa-list"></i> Rodapé <span class="pull-right"><i class="fa fa-edit"></i></span> 
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div id="accordioneleven" class="panel-collapse collapse">
                                                    <form method="post" action="modulo11_fn.php?acao=atualizar">
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                <label class="control-label">Título do Mapa</label>
                                                                <input class="form-control rounded" type="text" name="modulo11_nome" value="<?= stripslashes($modulo11->modulo11_nome) ?>" />
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Direitos Reservados</label>
                                                                <input class="form-control rounded" type="text" name="modulo11_button" value="<?= stripslashes($modulo11->modulo11_button) ?>" />
                                                                <input class="form-control rounded" type="hidden" id="modulo11_id" name="modulo11_id" value="<?= $modulo11->modulo11_id ?>" />
                                                            </div>
                                                            <div class="form-footer">
                                                                <div class="text-center">
                                                                    <button class="btn btn-primary" type="submit">Atualizar</button>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- **************************** MODULO 11 ****************************-->
                                        </div>
                                    </div><!-- /.panel-body -->
                                </div><!-- /.panel -->
                            </div><!-- /.col-md-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.body-content -->
                    <!--/ End body content -->
            </section><!-- /#page-content -->
        </section><!-- /#wrapper -->
        <!--/ END WRAPPER -->
                <?php require_once './footer.php'; ?>
        <!-- START @BACK TOP -->
        <div id="back-top" class="animated pulse circle">
            <i class="fa fa-angle-up"></i>
        </div><!-- /#back-top -->
        <!--/ END BACK TOP -->

        <script src="./assets/js/jquery.min.js"></script>
        <script src="./assets/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="./assets/js/handlebars.js"></script>
        <script src="./assets/js/typeahead.bundle.min.js"></script>
        <script src="./assets/js/jquery.nicescroll.min.js"></script>
        <script src="./assets/js/index.js"></script>
        <script src="./assets/js/jquery.easing.1.3.min.js"></script>
        <script src="./assets/ionsound/ion.sound.min.js"></script>
        <script src="./assets/js/bootbox.js"></script>
        <script src="./assets/js/bootstrap-tagsinput.min.js"></script>
        <script src="./assets/js/jasny-bootstrap.fileinput.min.js"></script>
        <script src="./assets/js/holder.js"></script>
        <script src="./assets/js/bootstrap-maxlength.min.js"></script>
        <script src="./assets/js/jquery.autosize.min.js"></script>
        <script src="./assets/js/chosen.jquery.min.js"></script>
        <script src="./assets/js/summernote.min.js"></script>
        <script src="./assets/js/summernote-pt-BR.js"></script>
        <!--/ END PAGE LEVEL PLUGINS -->

        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="./assets/js/apps.js"></script>
        <script src="./assets/js/ion.rangeSlider.min.js"></script>
        <script src="./assets/js/dark.form.js"></script>
        <script src="./assets/js/jquery.rtnotify.js"></script>
        <script src="./assets/js/jquery.maskedinput.min.js"></script>
    </body>
    <script>
        $(document).ready(function () {
            $('#modulo3_descricao').summernote({
                lang: 'pt-BR'
            });
        });

        $("#depoimento").ionRangeSlider({
            min: 1,
            max: 30,
            from: <?= $modulo5->modulo5_limite ?>
        });
    </script>

    <script>
        $("#pagina").ionRangeSlider({
            min: 1,
            max: 300,
            from: <?= $modulo10->modulo10_paginacao ?>
        });
    </script>
    <script>
<?php if (isset($_GET['success'])): ?>
                $(document).ready(function () {
                    $.rtnotify({title: "Procedimento Realizado!",
                        type: "default"});				
                });				
<?php endif; ?>
        $(function ($) {
            $("#contato_telefone1").mask("(99) 9999-9999");
            $("#contato_telefone2").mask("(99) 99999-9999");
            $("#contato_telefone4").mask("(99) 99999-9999");
        });
		
            $('.unidade').addClass('active');

            $('.atualizar').on('click', function () {
                var id = $(this).attr('data-update');
                $('#modulo2_id').val(id);
                var url = "modulo2_fn.php?acao=Json";
                $.getJSON(url, {area_id: id}, function (data) {
                    //console.log(data);
                    $('#modal-16  #modulo2_id').val(data.area_id);
                    $('#modal-16  #modulo2_nome').val(data.area_nome);
                });
                $('#modal-16').modal('show');
            });

            $('.delete').on('click', function () {
                var url = $(this).attr('data-url');
                $('#MODALREMOVE').modal('show');
                $('#btn-confirm-remove').on('click', function () {
                    window.location = url;
                });
            });

            $(function () {
                reloadActions();
            });
            function reloadActions() {
                var sortedIDs = $(".selector").sortable("toArray");
                $("#galeria").sortable({opacity: 0.6, cursor: "move",
                    stop: function (event, ui) {
                        var ids = $("#galeria").sortable("toArray");
                        var url = 'area_fn.php?acao=posicao';
                        $.post(url, {item: ids}, function (data) {
                            //console.log(data);
                        });
                    }
                });
				</script>
    <script>

        $('#frontend').addClass('active');
        $('#modulo_aparencia_cor').val('<?= $modulo_aparencia->modulo_aparencia_cor ?>');
        $('#modulo_aparencia_wide').val('<?= $modulo_aparencia->modulo_aparencia_wide ?>');        
        $('#modulo1_status').val('<?= $modulo1->modulo1_status ?>');
        $('#modulo2_status').val('<?= $modulo2->modulo2_status ?>');
        $('#modulo3_status').val('<?= $modulo3->modulo3_status ?>');

        $('#modulo4_status').val('<?= $modulo4->modulo4_status ?>');
        $('#modulo5_status').val('<?= $modulo5->modulo5_status ?>');
        $('#modulo6_status').val('<?= $modulo6->modulo6_status ?>');

        $('#modulo7_status').val('<?= $modulo7->modulo7_status ?>');
        $('#modulo8_status').val('<?= $modulo8->modulo8_status ?>');
        $('#modulo9_status').val('<?= $modulo9->modulo9_status ?>');
        $('#modulo10_status').val('<?= $modulo10->modulo10_status ?>');
        $('#modulo10_icon').val('<?= $modulo10->modulo10_icon ?>').trigger("chosen:updated");

    </script>
</html>