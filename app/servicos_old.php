<?php
require_once '../loader.php';
$site = new Site();
$site->getMeta();

$modulo_aparencia = new ModuloAparencia();
$modulo_aparencia->getModuloaparencia();

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

$pagina = new Pagina();
$pagina->getBlog();

$projeto = new Portfolio();
$projeto->getPortfolios();

$categoria_portfolio = new Area1();
$categoria_portfolio->db = new DB;
$categoria_portfolio->getAreas1();

$categoria_blog = new Area();
$categoria_blog->db = new DB;
$categoria_blog->getAreas();

$pagina = new Pagina();
$pagina->db->url = "blog/";
$pagina->db->paginate($blog->modulo10_paginacao);
$pagina->getPaginas();
//$pagina->getPaginasAss();

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
<meta name="description" content="biotic - mobile and tablet web app template" />
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
              <h2 class="page_title">serviços</h2> 
              <div class="page_content"> 
    
      
	  <ul class="features_list_detailed">
                                    <?php if (isset($pagina->db->data[0])): ?>									
                                        <?php foreach ($pagina->db->data as $trabalhos): ?>
          <li>
          <div class="feat_small_icon"><img src="../images/blog/<?= $trabalhos->pagina_imagem ?>" alt="" title="" /></div>		 
          <div class="feat_small_details"> 
          <h4><a href="servico.php?id=<?= $trabalhos->pagina_id ?>" data-transition="slidefade"><?= stripslashes($trabalhos->pagina_nome) ?></a> - <?= stripslashes($trabalhos->area_nome) ?></h4>
		  <?php if (!empty($trabalhos->pagina_autor)) : ?>
          <h4>R$ <?= stripslashes($trabalhos->pagina_autor) ?></h4>
		  <?php else: ?>
		  <h4>Consulte-nos</h4>
		  <?php endif; ?>
          </div>
          <div class="view_more"><a href="servico.php?id=<?= $trabalhos->pagina_id ?>" data-transition="slidefade"><img src="images/load_posts_disabled.png" alt="" title="" /></a></div>
          </li> 
                                        <?php endforeach; ?>
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
									<!-- AddToAny END -->
	   <hr/>
				<div align="center">
				<p><b><?= $site->site_meta_titulo ?></b></p>
				<address>
                    <?= $contatos->contato_endereco ?> <br/><br/>
                </address>	
				<p><?= $contatos->contato_telefone1 ?> - <?= $contatos->contato_telefone2 ?></p>
								
				</div>
      </div>
      </div>

    </div><!-- /content -->

    <div data-role="panel" id="left-panel" data-display="reveal" data-position="left">

              <nav class="main-nav">
                <ul>
                  <li><a href="index.html" data-transition="slidefade"><img src="images/icons/white/home.png" alt="" title="" /><span>Home</span></a></li>
				  <li><a href="sobre.php" data-transition="slidefade"><img src="images/icons/white/sobre.png" alt="" title="" /><span>Sobre nós</span></a></li>
                  <li><a href="servicos.php" data-transition="slidedown"><img src="images/icons/white/servico.png" alt="" title="" /><span>Serviços</span></a></li>
                  <li><a href="galeria.html" data-transition="slidefade"><img src="images/icons/white/galeria.png" alt="" title="" /><span>Galeria</span></a></li>
                  <li><a href="promocoes.php" data-transition="slidefade"><img src="images/icons/white/desconto.png" alt="" title="" /><span>Promoções</span></a></li>
                  <li><a href="depoimento.php" data-transition="slidefade"><img src="images/icons/white/depoimento.png" alt="" title="" /><span>Depoimentos</span></a></li>
                  <li><a href="whatsapp.html" data-transition="slidedown"><img src="images/icons/white/whatsapp.png" alt="" title="" /><span>WhatsApp</span></a></li>
                  <li><a href="ligar.html" data-transition="slidedown"><img src="images/icons/white/ligar.png" alt="" title="" /><span>Ligar</span></a></li>
                  <li><a href="social.php" data-transition="slidefade"><img src="images/icons/white/social.png" alt="" title="" /><span>Social</span></a></li>
                  <li><a href="#right-panel" class="external"><img src="images/icons/white/contato.png" alt="" title="" /><span>Contatos</span></a></li>
                  <li><a href="mapa.html" data-transition="slidefade"><img src="images/icons/white/mapa.png" alt="" title="" /><span>Localização</span></a></li>
                </ul>
              </nav>

    </div><!-- /panel -->

    <div data-role="panel" id="right-panel" data-display="reveal" data-position="right">
    
          <div class="user_login_info">
          
                    <div class="user_thumb_container">
                    <img src="images/profile.jpg" alt="" title="" /> 
                        <div class="user_thumb">
                        <img src="images/author.jpg" alt="" title="" />     
                        </div>  
                    </div>
                    
                    <div class="user_details">
                    <p>Barber System</p>
                        <ul class="user_social">
                        <li><a href="social.php"><img src="images/icons/white/twitter.png" alt="" title="" /></a></li>
                        <li><a href="social.php"><img src="images/icons/white/facebook.png" alt="" title="" /></a></li> 
                        <li><a href="social.php"><img src="images/icons/white/dribbble.png" alt="" title="" /></a></li>               
                        </ul> 
                    </div>  
 

                   <nav class="user-nav">
                        <ul>
                          <li><a href="features.html"><img src="images/icons/white/lock.png" alt="" title="" /><span>Acesso Restrito</span></a></li>
						  <li><a href="whatsapp.html" data-transition="slidedown"><img src="images/icons/white/whatsapp.png" alt="" title="" /><span>WhatsApp</span></a></li>
						  <li><a href="ligar.html" data-transition="slidedown"><img src="images/icons/white/ligar.png" alt="" title="" /><span>Ligar</span></a></li>
						  <li><a href="contato.php" data-transition="slidedown"><img src="images/icons/white/contato.png" alt="" title="" /><span>Contatos</span></a></li>
						  <li><a href="dev.html"><img src="images/icons/white/dev.png" alt="" title="" /><span>Desenvolvedor</span></a></li>
						  <li><img src="images/icons/white/versao.png" alt="" title="" /><span>Versão 6.29.18</span></li>
						</ul>
                   </nav>
          </div>
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

