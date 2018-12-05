<?php
require_once '../loader.php';
@session_start();

$site = new Site();
$site->getMeta();

$modulo_aparencia = new ModuloAparencia();
$modulo_aparencia->getModuloaparencia();

$topo = new Modulo1();
$topo->getModulo1();

$menu = new Modulo2();
$menu->getModulo2();

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

$categoria = new Categoria();
$categoria->db = new DB;
$categoria->db->url = "categoria";
$categoria->db->paginate(12);
$categoria->getCategorias();

$produtos = new Produto();
$produtos->db = new DB;
$produtos->db->url = "produto";
$produtos->db->paginate(12);
$produtos->getProdutos();

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
<meta name="author" content="SINDEVO.COM" />
<meta name="description" content="<?= $site->site_meta_titulo ?>" />
<meta name="keywords" content="mobile css template, mobile html template, jquery mobile template, mobile app template, html5 mobile design, mobile design" />
<title><?= $site->site_meta_titulo ?></title>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700,900' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.css">
<link type="text/css" rel="stylesheet" href="style.css" />
<link type="text/css" rel="stylesheet" href="css/colors/yellow.css" />
<link type="text/css" rel="stylesheet" href="css/swipebox.css" />
</head>
<body>

<div data-role="page" id="features" class="secondarypage" data-theme="b">

    <div data-role="header" data-position="fixed">
        <div class="nav_left_button"><a href="#" class="nav-toggle"><span></span></a></div>
        <div class="nav_center_logo"><?= $site->site_meta_titulo ?></div>
        <div class="nav_right_button"><a href="#right-panel"><img src="images/icons/white/user.png" alt="" title="" /></a></div>
        <div class="clear"></div>
    </div><!-- /header -->

    <div role="main" class="ui-content">
       <div class="pages_maincontent">
              <h2 class="page_title">nossos produtos</h2> 
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
				<section class="widget search clearfix">
					<div class="contactform">
					<form class="form-inline" role="form" method="post" action="produto_busca.php">
						<div class="input-group input-group">
							<select name="busca" onchange="this.form.submit();" required >
							  <option value="">Buscar por Categoria</option>
                                <?php if (isset($categoria->db->data[0])): ?>
                                    <?php foreach ($categoria->db->data as $categorias): ?>
									<option value="<?= stripslashes($categorias->categoria_nome) ?>"><?= stripslashes($categorias->categoria_nome) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
							</select>
						</div>
					</form>
					  <div class="call_button"><a href="produtos.php" class="external"><i class="fa fa-phone"></i>Listar Todos</a></div>
					</div>
				</section>				  
				<ul class="features_list_detailed">
			<?php if (isset($_POST['busca'])) : ?>
					<?php $produtos->getBusca(); ?>
						<?php if (isset($produtos->db->data[0])): ?>									
							<?php foreach ($produtos->db->data as $e): ?>
					  <li>
					  <div class="feat_small_icon"><img src="../images/team/<?= $e->produto_imagem ?>" alt="" title="" /></div>		 
					  <div class="feat_small_details"> 
					  <h3><a href="produto.php?id=<?= $e->produto_id ?>" data-transition="slidefade"><?= stripslashes($e->produto_nome) ?> - R$ <?= stripslashes($e->produto_preco) ?></a></h3>
					  <span><b>Categoria: </b><?= stripslashes($e->produto_categoria) ?></span><br>
					  <span><b>Valor: R$ </b><?= stripslashes($e->produto_preco) ?></span><br>
					  <span><b>Descrição: </b><?= stripslashes(Validacao::cut($e->produto_descricao, 30, '...')) ?></span>
					  </div>
					  <div class="view_more"><a href="produto.php?id=<?= $e->produto_id ?>" data-transition="slidefade"><img src="images/mais.png" alt="" title="" /></a></div>
					  </li> 
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endif; ?>		  
				  </ul>
									<div align="center" class="a2a_kit a2a_kit_size_32 a2a_default_style">
									<h2>Compartilhar</h2>
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
	   <hr/>
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
</body>
</html>

