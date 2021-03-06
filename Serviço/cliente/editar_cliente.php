<?php
session_start();
require __DIR__ . './../vendor/autoload.php';

use App\Entity\Cliente;

// Validação do ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: ./../index.php?status=error');
    exit;  
}

//CONSULTA O CLIENTE
$obCliente = Cliente::getCliente($_GET['id']);

// Validação do cliente
if(!$obCliente instanceof Cliente){
    header('location: ./../index.php?status=error');
    exit;
}

//Validação do formulário 

if (isset($_POST['nome'], $_POST['cpf'], $_POST['status'])) {

    $obCliente->nome = $_POST['nome'];
    $obCliente->cpf = $_POST['cpf'];
    $obCliente->status = $_POST['status'];
    $obCliente->atualizar();
    

    $_SESSION['success'] = "<div class='alert alert-success alert-dismissible fade show d-flex justify-content-center col-md-6 offset-md-3' id='success' role='alert'>
                                <strong>Cliente editado com sucesso!</strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-label=Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                            </div>";
    header('location: gerenciar.php?connection=success');
    exit;
}
//Colocar validador de CPF
//Colocar else de, caso não tenha alteração, informar não alterado.
//Colocar else de, caso tenha número no nome, validation failed.

include_once __DIR__ . '/cadastrado.php';