<?php 
session_start();

require "conexao.php";

foreach ($_SESSION['dados'] as $key) {

    $query   = mysqli_query($connect, "INSERT INTO pedidos SET
    nome               = '$key[nome]',
    qtd                = '$key[qtd]',
    subtotal           = '$key[subtotal]',
    produtos_id        = '$key[produtos_id]'");
  

$idadd = mysqli_insert_id($connect);

if($query) $result = json_encode(array('success' => true, 'idadd' => $idadd));
else $result = json_encode(array('success'=> false));
echo $result;

}




