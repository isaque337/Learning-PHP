<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

Class Cliente{
    /**
     * Identificador do cliente
     * @var integer
     */
    public $id;

    /**
     * Nome do cliente
     * @var string
     */
    public $nome;

    /**
     * Nome do cpf
     * @var integer
     */
    public $cpf;

    /**
     * Status (ativo ou inativo)
     * @var string 
     */
    public $status;

    /**
     * Método responsável por cadastrar um cliente no BD
     */
    public function cadastrar(){
        //Inserir o cliente no banco
        $obDatabase = new Database('cliente');
        $this->id = $obDatabase->insert([
                                        'nome'    => $this->nome,
                                        'cpf'     => $this->cpf,
                                        'status'  => $this->status
                                       ]);
        //Retornar sucesso
        return true;
    }

    /**
     * Método responsável por atualizar um cliente no BD
     * @return boolean
     */
    public function atualizar(){
        return (new Database('cliente'))->update('id = ' .$this->id,[
                                                                        'nome'    => $this->nome,
                                                                        'cpf'     => $this->cpf,
                                                                        'status'  => $this->status
        ]);
    }


    /**
     * Método responsável por excluir um cliente no BD
     * @return boolean
     */
    public function excluir(){
        return (new Database('cliente'))->delete('id = '. $this->id);
    }

     /**
      * Método responsável por obter os clientes do banco de dados
      * @param string where
      * @param string $order
      * @param string limit
      * @return array
      */
    public static function getClientes($where = null, $order = null, $limit = null){
        return (new Database('cliente'))->select($where, $order, $limit)
                                        ->fetchAll(PDO::FETCH_CLASS, self::class);
        
    }
    /**
     * Método responsável por buscar um cliente com base em seu id;
     * @param integer $id
     * @return Cliente
     */
    public static function getCliente($id){
        return (new Database('cliente'))->select('id = ' .$id)
                                        ->fetchObject(self::class);
    }

    
}