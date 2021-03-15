<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
</head>

<body>
    <?php

    require("conexao.php");

    $resultado = '';

    $sql = mysqli_query($connect, "Select * from produtos");

    foreach ($sql as $key) {
        $resultado .= '
                       
                    <tr>
                        <td>'.$key["nome"].'</td>
                        <td>'.$key["qtd"].'</td>
                        <td>'.$key["preco"].'</td>
                        <td> <a href="carrinho.php?acao=add&id='.$key["id"].'"> Comprar </a> </td>
                    </tr>
       
                      ';
    }

    ?>
</body>

<table style="border:1px #e1e1e1 solid">
<thead>
  <tr>
    <th>Nome</th>
    <th>Qtd</th>
    <th>Preço</th>
    <th>Ação</th>
  </tr>
</thead>
<tbody>
  <?=$resultado ?>
</tbody>
</table>
</html>