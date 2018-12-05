<?php
session_start();
require_once '../loader.php';
$site = new Site();
$site->getMeta();

$modulo_aparencia = new ModuloAparencia();
$modulo_aparencia->getModuloaparencia();

$topo = new Modulo1();
$topo->getModulo1();

$modulo2 = new Modulo2();
$modulo2->getModulo2();

$sobre = new Modulo3();
$sobre->getModulo3();

$portfolio = new Modulo7();
$portfolio->getModulo7();

$contato = new Modulo9();
$contato->getModulo9();

$contatos = new Contato();
$contatos->getContato();

$unidade = new Unidade();
$unidade->db = new DB;
$unidade->db->url = "unidade";
$unidade->db->paginate(24);
$unidade->getUnidades();

$pagina_id = intval($_GET['id']);
$pagina = new Pagina();
$pagina->pagina_id = "$pagina_id";
$pagina->getPagina();

$portfolio_id = intval($_GET['id']);
$categoria_portfolio = new Area1();
$categoria_portfolio->getAreas1();

$horario = new Horario();
$horario->db = new DB;
$horario->getAreas();

date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
<link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="images/apple-touch-startup-image-640x1096.png">
<meta name="author" content="JM Tecnologia" />
<meta name="description" content="<?= $site->site_meta_titulo ?>" />
<meta name="keywords" content="mobile css template, mobile html template, jquery mobile template, mobile app template, html5 mobile design, mobile design" />
<title><?= $site->site_meta_titulo ?></title>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.css">
<link type="text/css" rel="stylesheet" href="style.css" />
<link type="text/css" rel="stylesheet" href="css/colors/yellow.css" />
<link type="text/css" rel="stylesheet" href="css/swipebox.css" />
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/jquery.steps.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/modernizr-2.6.2.min.js"></script>
<script src="js/jquery.cookie-1.3.1.js"></script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.steps.js"></script>


</head>
<body>


<div data-role="page" id="about" class="secondarypage" data-theme="b">

    <div data-role="header" data-position="fixed">
        <div class="nav_left_button"><a href="#" class="nav-toggle"><span></span></a></div>
        <div class="nav_center_logo"><?= $site->site_meta_titulo ?></div>
        <div class="nav_right_button"><a href="#right-panel"><img src="images/icons/white/user.png" alt="" title="" /></a></div>
        <div class="clear"></div>
    </div><!-- /header -->

    <div role="main" class="ui-content">
	
            <script>
                $(function ()
                {
                    $("#wizard").steps({
                        headerTag: "h2",
                        bodyTag: "section",
                        transitionEffect: "slideLeft"
                    });
                });
            </script>
    
       <div class="pages_maincontent">
              <h2 class="page_title"><?= stripslashes($pagina->pagina_nome) ?> - R$ <?= stripslashes($pagina->pagina_autor) ?></h2> 
              <div class="page_content"> 
				<div align="center" class="imgBorder" style="min-height: 100px; margin-top:5px">
				<img src="../images/blog/<?= $pagina->pagina_imagem ?>" alt="" class="img-responsive" /> 
				</div>              
					<h2 class="page_title">Descrição do Serviço:</h2>
					<p><?= $pagina->pagina_descricao ?></p>
					</br>
					<h2 class="page_title">Agendamento On line</h2>
					<p>Envie seus dados, data e horário para verificarmos a disponibilidade, para melhor atendê-lo!</p>
					
				<div id="wizard">
                <h2>First Step</h2>
                <section>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut nulla nunc. Maecenas arcu sem, hendrerit a tempor quis, 
                        sagittis accumsan tellus. In hac habitasse platea dictumst. Donec a semper dui. Nunc eget quam libero. Nam at felis metus. 
                        Nam tellus dolor, tristique ac tempus nec, iaculis quis nisi.</p>
                </section>

                <h2>Second Step</h2>
                <section>
                    <p>Donec mi sapien, hendrerit nec egestas a, rutrum vitae dolor. Nullam venenatis diam ac ligula elementum pellentesque. 
                        In lobortis sollicitudin felis non eleifend. Morbi tristique tellus est, sed tempor elit. Morbi varius, nulla quis condimentum 
                        dictum, nisi elit condimentum magna, nec venenatis urna quam in nisi. Integer hendrerit sapien a diam adipiscing consectetur. 
                        In euismod augue ullamcorper leo dignissim quis elementum arcu porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Vestibulum leo velit, blandit ac tempor nec, ultrices id diam. Donec metus lacus, rhoncus sagittis iaculis nec, malesuada a diam. 
                        Donec non pulvinar urna. Aliquam id velit lacus.</p>
                </section>

                <h2>Third Step</h2>
                <section>
                    <p>Morbi ornare tellus at elit ultrices id dignissim lorem elementum. Sed eget nisl at justo condimentum dapibus. Fusce eros justo, 
                        pellentesque non euismod ac, rutrum sed quam. Ut non mi tortor. Vestibulum eleifend varius ullamcorper. Aliquam erat volutpat. 
                        Donec diam massa, porta vel dictum sit amet, iaculis ac massa. Sed elementum dui commodo lectus sollicitudin in auctor mauris 
                        venenatis.</p>
                </section>

                <h2>Forth Step</h2>
                <section>
                    <p>Quisque at sem turpis, id sagittis diam. Suspendisse malesuada eros posuere mauris vehicula vulputate. Aliquam sed sem tortor. 
                        Quisque sed felis ut mauris feugiat iaculis nec ac lectus. Sed consequat vestibulum purus, imperdiet varius est pellentesque vitae. 
                        Suspendisse consequat cursus eros, vitae tempus enim euismod non. Nullam ut commodo tortor.</p>
                </section>
				</div>		
									<div class="contactform">
									<form method="post" action="confirmaragenda.php" id="contactfrm" role="form" name="form" onSubmit="return enviardados();">
                                            <div>
												<label>Seu Nome:</label>
                                                <input type="text" name="servico_nome" id="servico_nome" required value="<?php echo $_SESSION['nome']?>" placeholder="Informe seu nome" title="Por favor informe seu nome"/>
                                            </div>
                                            <div>
												<label>Seu E-mail:</label>
                                                <input type="email" name="servico_email" id="servico_email" required value="<?php echo $_SESSION['email']?>" placeholder="Informe seu email" title="Por favor informe um endereço de email válido"/>
                                            </div>											
                                            <div>
                                                <label>Informe o número do WhatsApp</label>
                                                <label>Obs.: Somente os números com DDD</label>
                                                <input type="text" name="servico_icon" id="servico_icon" required value="<?php echo $_SESSION['telefone']?>" maxlength="11" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Exemplo: 31986407398" title="Por favor informe o celular"/>
                                            </div>
											<div>
											<br>
											<hr>
                                                <label>(Opcional) Add + Serviços ao Agendamento</label>
												<p align="center"><font style='color:#009900;font-weight:bold;'>Adicione até 4 serviços adicionais, além do serviço selecionado:</font></p><h3 align="center"><font style='color:blue;font-weight:bold;'><?= stripslashes($pagina->pagina_nome) ?> R$ <?= stripslashes($pagina->pagina_autor) ?>
												</h3></font>
												
											
											
											<script>
											$('body').on('change', '#servico_adicional', function() {
											  //$('#servico_adic_valor').val($(this).val());
											  $('#servico_adic_descricao').val($("option:selected", this).text());
											  $('#servico_adic_valor1').val($("option:selected", this).data('pagina_autor'))
											});

											$('#servico_adicional').trigger('change');
											
											$('body').on('change', '#servico_adicional2', function() {
											  //$('#servico_adic_valor').val($(this).val());
											  $('#servico_adic_descricao').val($("option:selected", this).text());
											  $('#servico_adic_valor2').val($("option:selected", this).data('pagina_autor'))
											});

											$('#servico_adicional2').trigger('change');
											
											$('body').on('change', '#servico_adicional3', function() {
											  //$('#servico_adic_valor').val($(this).val());
											  $('#servico_adic_descricao').val($("option:selected", this).text());
											  $('#servico_adic_valor3').val($("option:selected", this).data('pagina_autor'))
											});

											$('#servico_adicional3').trigger('change');
											
											$('body').on('change', '#servico_adicional4', function() {
											  //$('#servico_adic_valor').val($(this).val());
											  $('#servico_adic_descricao').val($("option:selected", this).text());
											  $('#servico_adic_valor4').val($("option:selected", this).data('pagina_autor'))
											});

											$('#servico_adicional4').trigger('change');
														
											</script>
												<?php $adicional = new Pagina(); ?>
												<?php $adicional->getAdicionais($pagina_id) ?>

									<div data-role="tabs" id="tabs">
									  <div data-role="navbar">
										<ul>
										  <li><a href="#um" >Serv.1</a></li>
										  <li><a href="#dois">Serv.2</a></li>
										  <li><a href="#tres">Serv.3</a></li>
										  <li><a href="#quatro">Serv.4</a></li>
										</ul>
									  </div>
									  <br>
												<div id="um" >
												<select data-placeholder="Escolha outro serviço" onblur="somar();" id="servico_adicional" name="servico_adicional" tabindex="2" >
                                                <option value="">Serviço Adicional 1</option>
												<?php if (isset($adicional->db->data[0])): ?>
                                                        <?php foreach ($adicional->db->data as $servicos): ?>
														<option value="<?= stripslashes($servicos->pagina_nome) ?>" data-pagina_autor="<?= $servicos->pagina_autor ?>"><?= stripslashes($servicos->pagina_nome) ?></option>
														<?php endforeach; ?>
												<?php endif; ?>
                                                </select>
                                                <input readonly type="text" style="text-align: center;" id="servico_adic_valor1" name="servico_adic_valor1" class="valor_a_vista" value="" />
                                                <hr>
												</div>
												<div id="dois">
												<select data-placeholder="Escolha outro serviço" onblur="somar();" id="servico_adicional2" name="servico_adicional2" tabindex="2" >
                                                <option value="">Serviço Adicional 2</option>
												<?php if (isset($adicional->db->data[0])): ?>
                                                        <?php foreach ($adicional->db->data as $servicos): ?>
														<option value="<?= stripslashes($servicos->pagina_nome) ?>" data-pagina_autor="<?= $servicos->pagina_autor ?>"><?= stripslashes($servicos->pagina_nome) ?></option>
														<?php endforeach; ?>
												<?php endif; ?>
                                                </select>
                                                <input readonly type="text" style="text-align: center;" id="servico_adic_valor2" name="servico_adic_valor2" class="valor_a_vista" value="" />
                                                <hr>
												</div>
												<div id="tres" >
                                                <select data-placeholder="Escolha outro serviço" onblur="somar();" id="servico_adicional3" name="servico_adicional3" tabindex="2" >
                                                <option value="">Serviço Adicional 3</option>
												<?php if (isset($adicional->db->data[0])): ?>
                                                        <?php foreach ($adicional->db->data as $servicos): ?>
														<option value="<?= stripslashes($servicos->pagina_nome) ?>" data-pagina_autor="<?= $servicos->pagina_autor ?>"><?= stripslashes($servicos->pagina_nome) ?></option>
														<?php endforeach; ?>
												<?php endif; ?>
                                                </select>
                                                <input readonly type="text" style="text-align: center;" id="servico_adic_valor3" name="servico_adic_valor3" class="valor_a_vista" value="" />
                                                <hr>
												</div>
												<div id="quatro" >
                                                <select data-placeholder="Escolha outro serviço" onblur="somar();" id="servico_adicional4" name="servico_adicional4" tabindex="2" >
                                                <option value="">Serviço Adicional 4</option>
												<?php if (isset($adicional->db->data[0])): ?>
                                                        <?php foreach ($adicional->db->data as $servicos): ?>
														<option value="<?= stripslashes($servicos->pagina_nome) ?>" data-pagina_autor="<?= $servicos->pagina_autor ?>"><?= stripslashes($servicos->pagina_nome) ?> </option>
														<?php endforeach; ?>
												<?php endif; ?>
                                                </select>
                                                <input readonly type="text" style="text-align: center;" id="servico_adic_valor4" name="servico_adic_valor4" class="valor_a_vista" value="" />												
												<hr>
												</div>
											</div>
												<label>Resumo dos valores:</label>
													Valor do Serviço solicitado: <?= stripslashes($pagina->pagina_nome) ?>
													<input readonly type="text" style="text-align: center;" name="servico_valor" id="servico_valor" value="<?= stripslashes($pagina->pagina_autor) ?>" />
													Valor Serviço(s) Adicional(is): <input readonly type="text" value="0" style="text-align: center;" name="servico_valor_adicional" id="servico_valor_adicional" onblur="soma()" />
													<b>Total:<input readonly type="text" id="servico_valor_total" name="servico_valor_total" style="text-align: center;" value="<?= stripslashes($pagina->pagina_autor) ?>" onblur="calcular()" ></b>
                                                <select data-placeholder="Forma de Pagamento" required id="servico_pagamento" name="servico_pagamento" tabindex="2" >
                                                <option value="">Forma de Pagamento</option>
														<option value="Direto na Barbearia">Direto na Barbearia </option>
														<option value="Online (Pagseguro)">Pagamento Online (Pagseguro) </option>
                                                </select>
												<p align="center"><font style='color:red;font-weight:bold;'>Caso escolha 'Pagamento Online (Pagseguro)', o link para pagamento será liberado somente após a confirmação do agendamento! </font></p>
												<hr>
											</div>
													<script>
													function somar() {
														var inputs = $(".valor_a_vista").size();
														var total = 0;
														if(document.getElementById("servico_adic_valor1").value == "")
														{
														$("#servico_adic_valor1").val(total);	
														}
														if(document.getElementById("servico_adic_valor2").value == "")
														{
														$("#servico_adic_valor2").val(total);	
														}
														if(document.getElementById("servico_adic_valor3").value == "")
														{
														$("#servico_adic_valor3").val(total);	
														}
														if(document.getElementById("servico_adic_valor4").value == "")
														{
														$("#servico_adic_valor4").val(total);	
														}
														for(var i=1; i<=inputs; i++) {
															total+=parseFloat($("#servico_adic_valor"+i).val());
														}
														$("#servico_valor_adicional").val(total.toFixed(3).slice(0,-1));
														var valor = parseFloat(document.getElementById("servico_valor").value);
														var adicional = parseFloat(document.getElementById("servico_valor_adicional").value);
														document.getElementById("servico_valor_total").value = (valor + adicional).toFixed(3).slice(0,-1);
													};
													</script>

                                            <div>
                                                <label>Escolha uma Unidade</label>
                                                <select data-placeholder="Obrigatório selecionar a unidade" required id="servico_unidade" name="servico_unidade" tabindex="2" >
                                                    <option value="">Selecione uma Unidade</option>
													<?php if (isset($unidade->db->data[0])): ?>
														<?php foreach ($unidade->db->data as $categoria): ?>
														<option value="<?= stripslashes($categoria->unidade_nome) ?>"><?= stripslashes($categoria->unidade_nome) ?></option>
														<?php endforeach; ?>
													<?php endif; ?>
                                                </select>
                                            </div>											
											
                                            <div>
                                                <label>Escolha a data desejada <font style='color:#009900;font-weight:bold;'>(Hoje é <?php echo date('d/m/Y'); ?>)</font></label>
                                                
												<input type="date" min="<?php echo date('Y-m-d'); ?>" name="servico_data" id="servico_data" required maxlength="10" value="<?php echo date('d/m/Y'); ?>" placeholder="Informe a data" title="Por favor escolha uma data"/>
                                            </div>
											
                                            <div>
                                                <label>Escolha um horário desejado</label>
                                                <select data-placeholder="Obrigatório selecionar a área" required id="servico_horario" name="servico_horario" tabindex="2" >
                                                    <option value="">Selecione um horário</option>
                                                    <?php if (isset($horario->db->data[0])): ?>
                                                        <?php foreach ($horario->db->data as $categoria): ?>
                                                            <option value="<?= $categoria->horario_nome ?>"><?= $categoria->horario_nome ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>											
											
                                            <div>
												<label>Mensagem(Opcional)</label>
                                                <input type="text" name="mensagem" id="mensagem" value="" placeholder="Mensagem Opcional" title="Mensagem"/>
                                            </div>

                                            <div class="result"></div>
											<input type="hidden" name="servico_descricao" style="text-transform:uppercase" value="<?= stripslashes($pagina->pagina_nome) ?>">
											<input type="hidden" name="servico_status" value="0">
											<input type="hidden" name="servico_pagina" style="text-transform:uppercase" value="<?= stripslashes($pagina->pagina_id) ?>">
											<input type="hidden" name="servico_profissional" value="A confirmar ou o Profissional que estiver disponível">
											<input type="hidden" name="hoje" id="hoje" value="<?php echo date('Y-m-d'); ?>">
											<div class="call_button"><button name="submit" type="submit" class="btn btn-primary" id="submit"> Enviar Agendamento</button></div>

                                        </form>
										</div>
									</div>
									<div align="center" class="a2a_kit a2a_kit_size_32 a2a_default_style">
									<h2 align="center">Compartilhar</h2>
									<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
									<a class="a2a_button_facebook"></a>
									<a class="a2a_button_twitter"></a>
									<a class="a2a_button_google_plus"></a>
									<a class="a2a_button_pinterest"></a>
									<a class="a2a_button_linkedin"></a>
									<a class="a2a_button_whatsapp"></a>
									<a class="a2a_button_email"></a>
									<a class="a2a_button_google_gmail"></a>
									</div>
									<script async src="https://static.addtoany.com/menu/page.js"></script>
									
       </div>
	   <hr/>
				<div align="center">
				<p><b><?= $site->site_meta_titulo ?></b></p>
				<address>
				<p>Contato: <?= $site->site_meta_desc ?> <br> E-mail: <?= $site->site_meta_palavra ?></p>
                </address>	
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
<script src="js/jquery.mobile-1.4.5.min.js"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/email.js"></script>
<script type="text/javascript" src="js/jquery.swipebox.js"></script>
<script src="js/jquery.mobile-custom.js"></script>
</body>
</html>
