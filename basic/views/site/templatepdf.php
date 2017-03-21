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
    <title>Bootstrap Example</title>
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
            <td><?= $valores->user->username ?></td>
            <td><?= $valores->compradorIdcomprador->nome ?></td>
            <td><?= $valores->valor ?> R$</td>
        </tr>

        <?php }?>

        </tbody>
    </table>


</div>

<div class="row">
    <div class="col-lg-5">

        <h3>Total Vendido:  <?= $valorTotal ?> R$</h3>

        </div>

</body>
</html>
