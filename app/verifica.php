<?php
require_once '../loader.php';
@session_start();
require_once '../database/DB.php';
$db = new DB();
if (isset($_POST['email'])) {
    $email = addslashes(trim($_POST['email']));
    $db->str = "SELECT * FROM servico like servico_email =  '%$email%'";
    $db->query("$db->str")->fetchAll();
    if ($db->rows >= 1) {
        $_SESSION['CONECTADO'] = TRUE;
        $_SESSION['USER']['EMAIL'] = $db->data->servico_email;
        $_SESSION['USER']['NOME'] = $db->data[0]->servico_nome;
        $_SESSION['USER']['TEL'] = $db->data[0]->servico_icon;
        $_SESSION['USER']['ID'] = $db->data->servico_id;
        Filter:: redirect("home.php");
    } 
}