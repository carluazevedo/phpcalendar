<?php

include 'config.php';
include 'banco.php';
include 'funcoes.php';
include 'classes/Tarefas.php';

$tarefas = new Tarefas($mysqli);

$tem_erros = false;
$erros_validacao = array();

if (tem_post()) {
	// Upload de arquivos
	$tarefa_id = $_POST['tarefa_id'];

	if (!isset($_FILES['anexo'])) {
		$tem_erros = true;
		$erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar';
	} else {
		if (tratar_anexo($_FILES['anexo'])) {
			$anexo = array();
			$anexo['tarefa_id'] = $tarefa_id;
			$anexo['nome'] = $_FILES['anexo']['name'];
			$anexo['arquivo'] = $_FILES['anexo']['name'];
		} else {
			$tem_erros = true;
			$erros_validacao['anexo'] = 'Envie apenas anexos nos formatos zip, pdf ou txt';
		}
	}

	if (!$tem_erros) {
		$tarefas->gravar_anexo($anexo);
	}
}

$tarefa = $tarefas->buscar_tarefa($_GET['id']);
$anexos = $tarefas->buscar_anexos($_GET['id']);

include 'template_tarefa.php';