<?php

$mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);

if ($mysqli->connect_error) {
	header('Content-Type:text/html;charset=UTF-8');
	die('Falha na conexão: ' . $mysqli->connect_error);
}

# Adicionado por Carlu P. Azevedo, pois não consta no tutorial
if ($mysqli->character_set_name() != 'utf8') {
	$mysqli->set_charset('utf8');
}