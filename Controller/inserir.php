<?php
include_once "../Model/Conexao.php";

$conexao = new Conexao();
$conexao->insereDados($_POST);

?>