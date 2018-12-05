<?php

/*
 * @author phpstaff.com.br
 */
date_default_timezone_set('America/Sao_Paulo');

require_once 'Controle.php';
class Servico extends Controle {

    public $db;
    public $servico_id;
    public $servico_nome;
    public $servico_icon;
    public $servico_descricao;
    public $servico_valor;
    public $servico_valor_adicional;
    public $servico_valor_total;
    public $servico_unidade;
    public $servico_data;
    public $servico_horario;
    public $servico_email;
    public $servico_status;
    public $servico_profissional;
    public $servico_promocao;
    public $servico_adicional;
    public $servico_adicional2;
    public $servico_adicional3;
    public $servico_adicional4;
    public $servico_pagamento;
    public $result;

    public function __construct() {
        parent::__construct();
        require_once 'Registry.php';
        $registry = Registry::getInstance();
        if( $registry->get('db') == false ) {
            $registry->set('db', new DB);
        }
        $this->db = $registry->get('db');           
    }

    public function gravar() {
        $this->insert("servico", " servico_nome, servico_icon, servico_unidade, servico_descricao, servico_data, servico_horario, servico_email, servico_status, servico_profissional, servico_promocao, servico_adicional, servico_adicional2, servico_adicional3, servico_adicional4, servico_valor, servico_valor_adicional, servico_valor_total, servico_pagamento", " '$this->servico_nome','$this->servico_icon','$this->servico_unidade','$this->servico_descricao','$this->servico_data','$this->servico_horario','$this->servico_email','$this->servico_status','$this->servico_profissional','$this->servico_promocao', '$this->servico_adicional', '$this->servico_adicional2', '$this->servico_adicional3', '$this->servico_adicional4', '$this->servico_valor', '$this->servico_valor_adicional', '$this->servico_valor_total', '$this->servico_pagamento'");
    }

    public function atualizar() {
        $this->update("servico", "servico_nome  = '$this->servico_nome', servico_icon = '$this->servico_icon', servico_unidade = '$this->servico_unidade',"
                . " servico_descricao = '$this->servico_descricao', servico_data = '$this->servico_data', servico_horario = '$this->servico_horario', servico_email = '$this->servico_email', servico_status = '$this->servico_status', servico_profissional = '$this->servico_profissional' , servico_promocao = '$this->servico_promocao', servico_adicional = '$this->servico_adicional', servico_adicional2 = '$this->servico_adicional2', servico_adicional3 = '$this->servico_adicional3', servico_adicional4 = '$this->servico_adicional4', servico_valor = '$this->servico_valor', servico_valor_adicional = '$this->servico_valor_adicional', servico_valor_total = '$this->servico_valor_total', servico_pagamento = '$this->servico_pagamento'", "servico_id = '$this->servico_id'");
    }

    public function atualizastatus() {
        $this->update("servico", "servico_status  = '$this->servico_status', servico_data = '$this->servico_data', servico_profissional = '$this->servico_profissional'", "servico_id = '$this->servico_id'");
    }
	
    public function remover() {
        $this->delete("servico", "servico_id = '$this->servico_id'");
    }

    public function getServico() {
        $this->select("servico", "", "*", "", "WHERE servico_id = $this->servico_id", "");
    }

    public function getServicosNaoConf() {
        $this->select("servico", "", "*", "", "WHERE servico_status = 0 ORDER BY servico_data DESC", "");
    }
    public function getServicosNaoConfHoje() {
        $datacorrente = date('d/m/Y');
		$this->select("servico", "", "*", "", "WHERE servico_status = 0 AND servico_data = '$datacorrente' ORDER BY servico_data DESC", "");
    }
	
    public function getServicosNaoConfAmanha() {
        $amanha = date ('d/m/Y', mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));
		$this->select("servico", "", "*", "", "WHERE servico_status = 0 AND servico_data = '$amanha' ORDER BY servico_data DESC", "");
    }
	
    public function getServicosConf() {
        $this->select("servico", "", "*", "", "WHERE servico_status IN (1,3) ORDER BY servico_data DESC", "");
    }
    public function getServicosConfHoje() {
        $datacorrente = date('d/m/Y');
		$this->select("servico", "", "*", "", "WHERE servico_status IN (1,3) AND servico_data = '$datacorrente' ORDER BY servico_data DESC", "");
    }
	
    public function getServicosConfAmanha() {
        $amanha = date ('d/m/Y', mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));
		$this->select("servico", "", "*", "", "WHERE servico_status IN (1,3) AND servico_data = '$amanha' ORDER BY servico_data DESC", "");
    }
	
    public function getServicosAtend() {
        $this->select("servico", "", "*", "", "WHERE servico_status = 2 ORDER BY servico_data DESC", "");
    }
    public function getServicosAtendHoje() {
        $datacorrente = date('d/m/Y');
		$this->select("servico", "", "*", "", "WHERE servico_status = 2 AND servico_data = '$datacorrente' ORDER BY servico_data DESC", "");
    }
		
    public function getServicosDia() {
		
		$datacorrente = date('d/m/Y');
        $this->db->query("SELECT * FROM servico WHERE servico_data = '$datacorrente' ORDER BY servico_status DESC")->fetchAll(); //OR 
        $this->db->data;
    }
	
    public function getServicosDiaSeguinte() {
		date_default_timezone_set('America/Sao_Paulo');
		$dataseguinte = date('d/m/Y');
		$nDays = 1;
		$newDate = strtotime($dataseguinte . '+ '.$nDays.'days');
		$teste = newDate('d/m/Y', $soma); //format new date
        $this->db->query("SELECT * FROM servico WHERE servico_data = '$teste' ORDER BY servico_status DESC")->fetchAll(); //OR 
        $this->db->data;
    }
	
			
    public function getServicoEmail() {
		$this->select("servico", "", "*", "", " WHERE servico_email = 'superjjbh@gmail.com' ORDER BY servico_data DESC", "");
    }
		
    //public function getAgenda0() {
       // $busca = $_SESSION['email'];
      //  $this->db->query("SELECT * FROM servico WHERE servico_email like '%$busca%' AND servico_status = 0 ORDER BY servico_data ASC")->fetchAll(); //OR 
      //  $this->db->data;
    //}
	
    public function getAgenda0() {
        $busca = $_SESSION['email'];
		$this->select("servico", "", "*", "", "WHERE servico_email like '%$busca%' AND servico_status = 0 ORDER BY servico_data DESC", "");
    }
	
    public function getAgenda1() {
        $busca = $_SESSION['email'];
		$this->select("servico", "", "*", "", "WHERE servico_email like '%$busca%' AND servico_status IN (1,3) ORDER BY servico_data DESC", "");
    }
    public function getAgenda2() {
        $busca = $_SESSION['email'];
		$this->select("servico", "", "*", "", "WHERE servico_email like '%$busca%' AND servico_status = 2 ORDER BY servico_data DESC", "");
    }
		
    public function getAgendaTotal() {
        $busca = $_POST['email'];
        $this->db->query("SELECT COUNT(*) FROM servico WHERE servico_email like '%$busca%'")->fetchAll(); //OR 
        $this->db->data;
    }	
	
    public function getSearch() {
        $busca = $_POST['busca'];
		$this->select("servico", "", "*", "", "WHERE servico_nome like '%$busca%' ORDER BY servico_data DESC", "");
    }
		
    public function getSearchStatus() {
		$status = $_POST['status'];
		$this->select("servico", "", "*", "", "WHERE servico_status like '%$status%' ORDER BY servico_data DESC", "");
    }
	
    public function getSearchData() {
		$inicio = date("d/m/Y", strtotime($_POST['inicio']));
		$fim = date("d/m/Y", strtotime($_POST['fim']));
		$this->select("servico", "", "*", "", "WHERE servico_data BETWEEN '$inicio' AND '$fim' ORDER BY servico_data DESC", "");
    }
	
    public function getJason() {
        $this->getJSON("servico", "servico_id = '$this->servico_id'");
    }

}
?>
