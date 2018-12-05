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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script language="JavaScript">
 /*
 A função Mascara tera como valores no argumento os dados inseridos no input (ou no evento onkeypress)
 onkeypress="mascara(this, '## ####-####')"
 onkeypress = chama uma função quando uma tecla é pressionada, no exemplo acima, chama a função mascara e define os valores do argumento na função
 O primeiro valor é o this, é o Apontador/Indicador da Mascara, o '## ####-####' é o modelo / formato da mascara
 no exemplo acima o # indica os números, e o - (hifen) o caracter que será inserido entre os números, ou seja, no exemplo acima o telefone ficara assim: 11-4000-3562
 para o celular de são paulo o modelo deverá ser assim: '## #####-####' [11 98563-1254]
 para o RG '##.###.###.# [40.123.456.7]
 para o CPF '###.###.###.##' [789.456.123.10]
 Ou seja esta mascara tem como objetivo inserir o hifen ou espaço automáticamente quando o usuário inserir o número do celular, cpf, rg, etc 

 lembrando que o hifen ou qualquer outro caracter é contado tambem, como: 11-4561-6543 temos 10 números e 2 hifens, por isso o valor de maxlength será 12
 <input type="text" name="telefone" onkeypress="mascara(this, '## ####-####')" maxlength="12">
 neste código não é possivel inserir () ou [], apenas . (ponto), - (hifén) ou espaço
 

 function mascara(t, mask){
 var i = t.value.length;
 var saida = mask.substring(1,0);
 var texto = mask.substring(i)
 if (texto.substring(0,1) != saida){
 t.value += texto.substring(0,1);
 }
 }
 */
 </script>
<script language='JavaScript'>
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}
</script>
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
    
       <div class="pages_maincontent">
              <h2 class="page_title">Agendamento Online</h2> 
              <div class="page_content"> 
					<?php if (isset($_POST['servico_descricao'])): ?>
					<h3><b>Serviço ou Promoção Escolhido(a):</b> <?= stripslashes($_POST['servico_descricao']) ?> - R$ <?= stripslashes($_POST['servico_valor']) ?></h3></br> 
					<p>Preencha o restante do formulário para confirmar seu agendamento</p>
					<?php endif; ?>
									<div class="contactform">
					<?php if (isset($_POST['servico_descricao'])): ?>
									<form class="cmxform" method="post" action="confirmaragenda.php" id="contactfrm" role="form" name="form" onSubmit="return enviardados();">
                                            <h2 class="page_title">Dados Pessoais</h2>
											<div>
                                                <input type="text" name="servico_nome" id="servico_nome" class="form_input required" data-role="none" required value="<?php echo $_SESSION['nome']?>" placeholder="Informe seu nome" title="Por favor informe seu nome"/>
                                            </div>
                                            <div>
                                                <input type="email" name="servico_email" id="servico_email" class="form_input required" data-role="none" required value="<?php echo $_SESSION['email']?>" placeholder="Informe seu email" title="Por favor informe um endereço de email válido"/>
                                            </div>											
                                            <div>
                                                <input type="text" name="servico_icon" id="servico_icon" class="form_input required" data-role="none" required value="<?php echo $_SESSION['telefone']?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="11" placeholder="WhatsApp (Somente os números com DDD)" title="Por favor informe o celular"/>
                                            </div>
											<div>
											<br>
											<hr>
                                                <h2 class="page_title">Serviços Adicionais</h2>
												<h3 align="center"><font style='color:#009900;font-weight:bold;'>Adicione até 4 serviços a mais no agendamento!(opcional)
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
												</div>
											</div>
                                            <div>
											<h2 class="page_title">Dados do Agendamento</h2>
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
                                                <select data-placeholder="Forma de Pagamento" required id="servico_pagamento" name="servico_pagamento" tabindex="2" >
                                                <option value="">Forma de Pagamento</option>
														<option value="Direto na Barbearia">Direto na Barbearia </option>
														<?php if (stripslashes($site->site_logo) == 'Ativado'): ?>
														<option value="Online (Pagseguro)">Pagamento Online (Pagseguro) </option>
														<?php endif; ?>
                                                </select>
												<?php if (stripslashes($site->site_logo) == 'Ativado'): ?>
												<p align="center"><font style='color:red;font-weight:bold;'>Caso escolha 'Pagamento Online (Pagseguro)', o link para pagamento será liberado somente após a confirmação do agendamento! </font></p>
												<?php endif; ?>
											</div>
                                            <div>
                                                <input type="text" name="mensagem" id="mensagem" value="" class="form_input" data-role="none" placeholder="Mensagem(Opcional)" title="Mensagem"/>
                                            </div>
											<h2 class="page_title">Resumo de Valores</h2>
											<label>Serviço solicitado + Adicionais:</label>
													Valor do Serviço solicitado: <?= stripslashes($_POST['servico_valor']) ?>
													<input readonly type="text" style="text-align: center;" name="servico_valor" id="servico_valor" value="<?= stripslashes($_POST['servico_valor']) ?>" />
													Valor Serviço(s) Adicional(is): <input readonly type="text" value="0" style="text-align: center;" name="servico_valor_adicional" id="servico_valor_adicional" onblur="soma()" />
													<b>Total:<input readonly type="text" id="servico_valor_total" name="servico_valor_total" style="text-align: center;" value="<?= stripslashes($_POST['servico_valor']) ?>" onblur="calcular()" ></b>
												
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
														//document.getElementById("servico_valor_total").value = (valor + adicional).toFixed(3).slice(0,-1);
														var val = (valor + adicional).toFixed(3).slice(0,-1);
														document.getElementById("servico_valor_total").value = val.replace(".", ",");
													};
													</script>

											
											
											

                                            <div class="result"></div>
											<input type="hidden" name="servico_descricao" style="text-transform:uppercase" value="<?= stripslashes($_POST['servico_descricao']) ?>">
											<input type="hidden" name="servico_status" value="0">
											<input type="hidden" name="servico_pagina" style="text-transform:uppercase" value="<?= stripslashes($_POST['servico_pagina']) ?>">
											<input type="hidden" name="servico_profissional" value="A confirmar ou o Profissional que estiver disponível">
											<input type="hidden" name="hoje" id="hoje" value="<?php echo date('Y-m-d'); ?>">
											<div class="call_button"><button name="submit" type="submit" class="btn btn-primary" id="submit"> Enviar Agendamento</button></div>

                                        </form>
										<?php else: ?>
										<p align="center"><img src="images/aguardo.png" /></p>
										<h3 align="center"> Nenhum agendamento <font style="color:#f2195b;font-weight:bold;">ENCONTRADO</font> para o envio</h3></br>
										<h3 align="center"> <a href="home.php"><span>VOLTAR PARA HOME</span></a></h3></br>
										<h3 align="center"> <a href="servicos.php"><span>VOLTAR PARA LISTA DE SERVIÇOS</span></a></h3></br>
										<?php endif; ?>       
										</div>
									</div>
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
