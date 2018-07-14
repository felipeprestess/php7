<?php

//include_once ("../Controller/Config.php");

class DAOMysql {
    /* Método construtor do banco de dados */

    public function __construct() {
        
    }

    /* Evita que a classe seja clonada */

    public function __clone() {
        
    }

    /* Método que destroi a conexão com banco de dados e remove da memória todas as variáveis setadas */

    public function __destruct() {
        $this->Desconectar();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    public static $dbtype = "mysql";
    public static $host = "localhost";
    public static $port = "3306";
    public static $user = "root";
    public static $password = "";
    public static $db = "crm_integrado";

    /* Metodos de configuração do banco */

    public function getDBType() {
        return self::$dbtype;
    }

    public function getHost() {
        return self::$host;
    }

    public function getPort() {
        return self::$port;
    }

    public function getUser() {
        return self::$user;
    }

    public function getPassword() {
        return self::$password;
    }

    public function getDB() {
        return self::$db;
    }

    /* Método de Conexão */

    public function Conectar() {
        try {
            $this->Conexao = new PDO($this->getDBType() . ":host=" . $this->getHost() . ";port=" . $this->getPort() . ";dbname=" . $this->getDB(), $this->getUser(), $this->getPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => true));
            $this->Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        //se houver exceção, exibe
        catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }
        return ($this->Conexao);
    }

    /* Método para Desconectar a conexão */

    public function Desconectar() {
        $this->Conexao = null;
    }

    //Escapar dados através do quote (PDO)
    public function Escapar($dados) {
        $Conexao = $this->Conectar();
        //Verifica se os dados a serem escapados não são um array caso contrário escapará para um array
        if (!is_array($dados)) {
            $dados = $Conexao->quote($dados);
        } else {
            $arr = $dados;
            foreach ($arr as $key => $value) {
                if ($key != "" && $key > 0) {
                    $key = $Conexao->quote($Conexao, $key);
                    $value = $Conexao->quote($Conexao, $value);
                    $dados[$key] = $value;
                }
            }
        }
        self::__destruct();
        return $dados;
    }

    /* Método select que retorna um array de objetos */

    public function Consultar($tabela, $campos = "*", $parametros = null) {
        try {
            $tabela = $tabela;
            $parametros = ($parametros) ? " {$parametros}" : null;
            $sql = "SELECT SQL_CACHE {$campos} FROM {$tabela}{$parametros}";
			//echo $sql."<br/>";
            $query = $this->Conectar()->prepare($sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

        // Contar numero de linhas
        $count = $query->rowCount();
        //Se teve retorno da consulta gravará dos no array
        if ($count > 0) {
            while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                $dados[] = $result;
            }
            return $dados;
        } else {
            return false;
        }
        self::__destruct();
    }

    public function ConsultarCuston($tabela, $campos = "*", $parametros = null) {
        try {
            $tabela = $tabela;
            $parametros = ($parametros) ? " {$parametros}" : null;
            $sql = "SELECT SQL_CACHE {$campos} FROM {$tabela}{$parametros}";
            $query = $this->Conectar()->prepare($sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

        return $query;
        self::__destruct();
    }
    
    public function ConsultarCustonScheduler($Sql) {
        try {
		
            $query = $this->Conectar()->prepare($Sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

        return $query;
        self::__destruct();
    }

    /* Método insert que insere valores no banco de dados e retorna o último id inserido */

    public function Inserir($sql, $parametros = null) {
        $query = $this->Conectar()->prepare($sql);
        $query->execute($parametros);
        $rs = $Conexao->lastInsertId() or die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }

    /* Método update que altera valores do banco de dados e retorna o número de linhas afetadas */

    public function Atualizar($sql, $parametros = null) {
        $query = $this->Conectar()->prepare($sql);
        $rs = $query->execute($parametros) or die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }
    public function AtualizarID($sql, $parametros = null) {
        $query = $this->Conectar()->prepare($sql);
        $rs = $query->execute($parametros) or die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $this->Conectar()->lastInsertId();
    }

    /* Método delete que excluí valores do banco de dados retorna o número de linhas afetadas */

    public function Deletar($sql, $parametros = null) {
        $query = $this->Conectar()->prepare($sql);
        $query->execute($parametros);
        $rs = $query->rowCount() or die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }

}
