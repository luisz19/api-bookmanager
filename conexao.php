<?php
//Nesse arquivo contém a conexão com o banco mysql, vc coloca o nome da tabela, usuario e senha.

//Por padrão do mysql o user = root, senha = '';
class Conexao{
    private static $instance;

    public static function getConn(){
        if(!isset(self::$instance)){
            try {
                self::$instance = new \PDO('mysql:host=localhost;dbname=bookmanager', 'root', '');
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // 
            } catch (\PDOException $e) {
                echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
                exit();
            }
        }
        return self::$instance;
    }


}
?>