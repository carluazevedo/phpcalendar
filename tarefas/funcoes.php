<?php

function traduz_prioridade($codigo) {
	$prioridade = '';
	switch ($codigo) {
		case 1:
			$prioridade = 'Baixa';
			break;
		case 2:
			$prioridade = 'Média';
			break;
		case 3:
			$prioridade = 'Alta';
			break;
	}

	return $prioridade;
}

function traduz_data_para_banco($data) {
	if ($data == '') {
		return '';
	}

	$dados = explode('/', $data);

	if (count($dados) != 3) {
		return $data;
	}

	$data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

	return $data_mysql;
}

function traduz_data_para_exibir($data) {
	if ($data == '' || $data == '0000-00-00') {
		return '';
	}

	$dados = explode('-', $data);

	if (count($dados) != 3) {
		return $data;
	}

	$data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

	return $data_exibir;
}

function traduz_concluida($concluida) {
	if ($concluida == 1) {
		return 'Sim';
	}

	return 'Não';
}

function tem_post() {
	if (count($_POST) > 0) {
		return true;
	}

	return false;
}

function validar_data($data) {
	$padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
	$resultado = preg_match($padrao, $data);

	if (!$resultado) {
		return false;
	}

	$dados = explode('/', $data);

	$dia = $dados[0];
	$mes = $dados[1];
	$ano = $dados[2];

	$resultado = checkdate($mes, $dia, $ano);

	return $resultado;
}

function tratar_anexo($anexo) {
	$padrao = '/^.+(\.pdf|\.zip|\.txt)$/';
	$resultado = preg_match($padrao, $anexo['name']);

	if (!$resultado) {
		return false;
	}

	move_uploaded_file($anexo['tmp_name'], "anexos/{$anexo['name']}");

	return true;
}

function enviar_email($tarefa, $anexos = array()) {
	include 'bibliotecas/PHPMailer/PHPMailerAutoload.php';

	$corpo = preparar_corpo_email($tarefa, $anexos);

	$email = new PHPMailer();

	$email->isSMTP();
	$email->Host = 'smtp.mail.yahoo.com.br';
	$email->Port = 587;
	$email->SMTPSecure = 'tls';
	$email->SMTPAuth = true;
	$email->Username = 'carlu_azevedo@yahoo.com.br';
	$email->Password = 'passwd225car785lu86';
	$email->setFrom('carlu_azevedo@yahoo.com.br', 'Avisador de Tarefas');
	$email->addAddress(EMAIL_NOTIFICACAO, 'Carlu Pereira Azevedo');
	$email->Subject = "Aviso de tarefa: {$tarefa['nome']}";
	$email->msgHTML($corpo);

	foreach ($anexos as $anexo) {
		$email->addAttachment("anexos/{$anexo['arquivo']}");
	}

	if(!$email->send()) {
		echo "Mailer Error: " . $email->ErrorInfo;
	} else {
		echo "Message sent!";
	}
}

function preparar_corpo_email($tarefa, $anexos) {
	// Aqui vamos pegar o conteúdo
	// processado do template_email.php

	// Falar para o PHP que não é para enviar
	// o processamento para o navegador:
	ob_start();

	// Incluir o arquivo template_email.php:
	include 'template_email.php';

	// Guardar o conteúdo do arquivo em uma variável:
	$corpo = ob_get_contents();

	// Falar para o PHP que ele pode voltar
	// a mandat conteúdos para o navegador.
	ob_end_clean();

	return $corpo;
}