<?php

    if(!isset($_SESSION)){ 
        session_start(); 
    }
    else{
        session_destroy();
        session_start(); 
    };

require __DIR__ . './../vendor/autoload.php';

use App\Entity\Cliente;

?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
    <title>Editar Cliente</title>
    <?php include_once __DIR__ . '/../includes/header.php'; ?>

</head>

<body>

    <?php include_once __DIR__ . '/../includes/navbar.php'; ?>

    <br>
    <div class="container">

        <div class="form-group">
            <div class="col-md-6 offset-md-3 h3">
                <center>EDITAR CLIENTE</center>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        if (isset($_GET['validation'])) {
            echo $_SESSION['erroCpf'];
        } else if (isset($_GET['connection'])) {
            echo $_SESSION['success'];
        } ?>
        <form method="POST">

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label> Nome Completo</label>
                    <input type="text" name="nome" class="form-control" placeholder="Digite seu nome" required="" autocomplete="off" value="<?=$obCliente->nome?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label> CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Digite seu CPF" required="" autocomplete="off" value="<?=$obCliente->cpf?>"> <!--Verifica se é número e limita a 11 dígitos -->
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label>Status</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <label class="form-control">
                                <input type="radio" name="status" value="ativo" checked> Ativo
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <label class="form-control">
                                <input type="radio" name="status" value="inativo" <?=$obCliente->status == 'inativo' ? 'checked' : ''?>> Inativo
                            </label>
                        </div>
                            <div class="inline">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Enviar</button>
                            </div>
                    </div>
                </div>
        </form>
    </div>


    <?php include_once __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>