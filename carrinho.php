<?php

session_start();

if (!isset($_SESSION['carrinho'])) {

    $_SESSION['carrinho'] = array();
}

if (isset($_GET['acao'])) {

    if ($_GET['acao'] == 'add') {

        $id = intval($_GET['id']);

        if (!isset($_SESSION['carrinho'][$id])) {

            $_SESSION['carrinho'][$id] = 1;
        } else {
            $_SESSION['carrinho'][$id] += 1;
        }

    }

    if ($_GET['acao'] == 'del') {
        $id = intval($_GET['id']);

        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
    }

    if ($_GET['acao'] == 'up') {

        if (is_array($_POST['prod'])) {

            foreach ($_POST['prod'] as $id => $qtd) {

                $id  = intval($id);
                $qtd = intval($qtd);

                if (!empty($qtd) || $qtd != 0) {
                   
                    $_SESSION['carrinho'][$id] = $qtd;

                }else{

                    unset($_SESSION['carrinho'][$id]);
                }
            }
        }

    }
}

?>

<table>
<caption>Carrinho de Compras</caption>
<thead>
  <tr>
    <th>Produto</th>
    <th>qtd</th>
    <th>valor</th>
    <th>subtotal</th>
  </tr>
</thead>
<form action="?acao=up" method="post">
<tfoot>
    <tr>
    <td collspan="5">

     <input type="submit" value="Alterar carrinho" />

    <td >
    </td>
    </tr>
    <td collspan="5">

     <a href="index.php"> continuar Comprando </a>

    </td>



</tfoot>



<tbody>

<?php
require "conexao.php";
$total = 0;

if (count($_SESSION['carrinho']) == 0) {
    echo "<tr>
                 <td>
                 Nenhum produro adicionado.....
                 </td>
             </tr>";
} else {
    foreach ($_SESSION['carrinho'] as $id => $qtd) {

        $sql = mysqli_query($connect, "Select * from produtos WHERE id = '$id'");

        $ln = mysqli_fetch_assoc($sql);

        $nome = $ln['nome'];
        $preco = number_format($ln['preco'], "2", ",", ".");
        $sub = number_format($ln['preco'] * $qtd, "2", ",", ".");

        $total += intval($sub);

        echo ' <tr>
                <td>' . $nome . '</td>
                <td><input type="text" size="3" name="prod[' . $id . ']" value="' . $qtd . '" /> </td>
                <td>' . $preco . '</td>
                <td>' . $sub . '</td>
                <td> <a href="?acao=del&id=' . $id . '">Remover </a></td>
               </tr>
             ';

    }
       
       echo '<tr> 
                 <td colspan="4">Total</td>
                 <td>'. number_format($total, "2", ",", ".").'</td>
             </tr>';

}

?>

</tbody>

</form>
</table>