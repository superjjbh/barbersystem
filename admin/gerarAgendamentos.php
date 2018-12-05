<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include("conexao.php");
$grupo = selectAllPessoa();

//var_dump($grupo);

$arqexcel = "<meta charset='UTF-8'>";

$arqexcel .= "<table border='1'>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Contato</th>
                    <th>E-mail</th>
                    <th>Serviço</th>
                    <th>Valor</th>
					<th>Data</th>
                    <th>Horário</th>
                    <th>Unidade</th>
                    <th>Profissional</th>
                    <th>Serv. Adic. 1</th>
                    <th>Serv. Adic. 2</th>
                    <th>Serv. Adic. 3</th>
                    <th>Serv. Adic. 4</th>
                    <th>Valor Serviços Adicionais</th>
                    <th>Valor Total</th>
                    <th>Forma de Pgto</th>
                    <th>Status</th>				
                </tr>
            </thead>
            <tbody>";
                
                    foreach ($grupo as $pessoa) { 
				if($pessoa['servico_status'] == 1 || $pessoa['servico_status'] == 3)
				{
					$pessoa['servico_status'] = 'Confirmado';
				}
				else if($pessoa['servico_status'] == 2)
				{
					$pessoa['servico_status'] = 'Atendido e Finalizado';
				}
				else
				{
					$pessoa['servico_status'] = 'Não Confirmado';
				}
           $arqexcel .="        <tr>
                    <td>{$pessoa["servico_nome"]}</td>
                    <td>{$pessoa["servico_icon"]}</td>
                    <td>{$pessoa["servico_email"]}</td>
                    <td>{$pessoa["servico_descricao"]}</td>
                    <td>{$pessoa["servico_valor"]}</td>
                    <td>{$pessoa["servico_data"]}</td>
                    <td>{$pessoa["servico_horario"]}</td>
                    <td>{$pessoa["servico_unidade"]}</td>
                    <td>{$pessoa["servico_profissional"]}</td>
                    <td>{$pessoa["servico_adicional"]}</td>
                    <td>{$pessoa["servico_adicional2"]}</td>
                    <td>{$pessoa["servico_adicional3"]}</td>
                    <td>{$pessoa["servico_adicional4"]}</td>
                    <td>{$pessoa["servico_valor_adicional"]}</td>
                    <td>{$pessoa["servico_valor_total"]}</td>
                    <td>{$pessoa["servico_pagamento"]}</td>
                    <td>{$pessoa["servico_status"]}</td>
                    </tr>";
                  }
                
          $arqexcel .="  </tbody>
        </table>";
          
          header("Content-Type: application/xls");
          header("Content-Disposition:attachment; filename = relatorio.xls");
          echo $arqexcel;

