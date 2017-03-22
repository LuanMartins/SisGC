<?php
/**
 * Created by PhpStorm.
 * User: Android0660
 * Date: 19/03/2017
 * Time: 14:27
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Relatório de Vendas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<div class="container">
    
    <h2> Relatório Referente a Data: <?=$data?></h2>
    <table class="table">
        <thead>
        <tr>
            <th>Vendedor</th>
            <th>Comprador</th>
            <th>Valor</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($venda as $valores){?>
        <tr>
            <td><?= $valores->nome_vendedor ?></td>
            <td><?= $valores->nome_cliente ?></td>
            <td><?= $valores->valor ?> R$</td>
        </tr>

        <?php }?>

        </tbody>
    </table>


</div>

<div class="row">
    <div class="col-lg-5">

        <h3>Total Vendido Fiado:  <?= $valorTotal ?> R$</h3>
        <h3>Total Recebido:  <?= $valorFinal ?> R$</h3>

        </div>

</body>
</html>
