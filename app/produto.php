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

$blog = new Modulo10();
$blog->getModulo10();

$produto_id = intval($_GET['id']);
$produto = new Produto();
$produto->produto_id = $produto_id;
//$produto->db = new DB;
$produto->getProduto();

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
<meta name="description" content="biotic - mobile and tablet web app template" />
<meta name="keywords" content="mobile css template, mobile html template, jquery mobile template, mobile app template, html5 mobile design, mobile design" />
<title><?= $site->site_meta_titulo ?></title>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.css">
<link type="text/css" rel="stylesheet" href="style.css" />
<link type="text/css" rel="stylesheet" href="css/colors/yellow.css" />
<link type="text/css" rel="stylesheet" href="css/swipebox.css" />
<script type="text/javascript">
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
              <h2 class="page_title"><?= stripslashes($produto->produto_nome) ?> - R$ <?= stripslashes($produto->produto_preco) ?></h2> 
              <div class="page_content"> 
					<?php if (stripslashes($site->site_logo) == 'Ativado'): ?>
					<div align="right">
						<form target="pagseguro" action="https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx" method="post">
						  <input type="hidden" name="email_cobranca" value="<?= stripslashes($site->site_imagem) ?>" />
						  <input type="hidden" name="tipo" value="VER" />
						  <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/184x42-carrinho-cinza-assina.gif" name="submit" alt="Visualizar carrinho de compras" />
						</form>
					</div>
					<?php endif; ?>
				<div align="center" class="imgBorder" style="min-height: 100px; margin-top:5px">
				<img src="../images/team/<?= $produto->produto_imagem ?>" alt="" class="img-responsive" /> 
				</div>              
					<h2 class="page_title">Categoria:</h2>
					<h3><?= $produto->produto_categoria ?></h3>
					<h2 class="page_title">Preço do Produto:</h2>
					<h3>R$ <?= $produto->produto_preco ?></h3>
					<?php if (stripslashes($site->site_logo) == 'Ativado'): ?>
					<form target="pagseguro" method="post" action="https://pagseguro.uol.com.br/checkout/checkout.jhtml">
					  <input type="hidden" name="email_cobranca" value="<?= stripslashes($site->site_imagem) ?>" />
					  <input type="hidden" name="tipo" value="CBR" />
					  <input type="hidden" name="moeda" value="BRL" />
					  <input type="hidden" name="item_id" value="<?= stripslashes($produto->produto_id) ?>" />
					  <input type="hidden" name="item_descr" value="<?= stripslashes($produto->produto_nome) ?>" />
					  <input type="hidden" name="item_quant" value="1" />
					  <input type="hidden" name="item_valor" value="<?= $produto->produto_preco ?>" />
					  <input type="hidden" name="frete" value="0" />
					  <input type="hidden" name="peso" value="0" />
					  <input type="image" name="submit" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/184x42-comprar-cinza-assina.gif" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
					</form>
					<?php endif; ?>
					<h2 class="page_title">Descrição do Produto:</h2>
					<h3><?= $produto->produto_descricao ?></h3>
					</br>
					

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
                    <?= $contatos->contato_endereco ?> <br/><br/>
                </address>	
				<p><?= $contatos->contato_telefone1 ?> - <?= $contatos->contato_telefone2 ?></p>
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
</body>
</html>
