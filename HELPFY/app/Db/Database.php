<?php
namespace App\Db;

use \PDO;
use PDOException;
class Database{

    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'helpfy';

    /**
     * Usuário do banco
     *@var string
     */
    const USER = 'root';

    /**
     * Senha do usuário BD
     */
    const PASS = '';

    /**
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instância de Conexão com o BD
     *@var PDO
     */
    private $connection;

    /**
     * Define a tabela e instancia a conexão
     * @var string
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection(); 
    }

    /**
     * Método responsável por criar uma conexão com o banco de dados
     */
    private function setConnection(){
        try{
        $this->connection = new PDO('mysql:host=localhost;dbname=helpfy', 'root' , '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// Retornar erro fatal, caso vá para o catch. Recebe 2 parâmetros, O atributo, depois o valor dele.

        }catch(PDOException $e){
            die('ERROR: '. $e->getMessage());
            
        }
    }

    /**
     * Métodos responsáveis por executar queries dentro do banco de dados
     * @param string $query 
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = []){
        try{
            $statement = $this->connection->prepare($query);
            $statement ->execute($params);
            return $statement;
        }catch(PDOException $e){
            die('ERROR: '. $e->getMessage());
            
        }
    }

    /**
     * Método responsável por inserir dados no banco de dados
     * @param array $values [field => value]
     * @return interger ID Inserido
     */
    
    public function insert($values){

        //Dados da query
        $fields = array_keys($values); //Recebe os campos em array.
        $binds  = array_pad([],count($fields), '?') ; //Recebe os valores em array, e apresenta a quantidade de valores do mesmo tamanho de campo.

        // Monta a query
        $query = 'INSERT INTO '. $this->table.' ('.implode(',',$fields).') VALUES('.implode(',',$binds).')';

        //Executa o insert
        $this->execute($query, array_values($values)); 

        //Retorna o ID inserido
        return $this->connection->lastInsertId();

    }

}
