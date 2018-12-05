<?php 
$id = $_POST['id'];
?>
<script language="JavaScript"> 
window.location="servico.php?id=<?= stripslashes($id) ?>"; 
</script> 

<noscript> 
Se não for direcionado automaticamente, clique <a href="servico.php?id=<?= stripslashes($id) ?>">aqui</a>. 
</noscript>