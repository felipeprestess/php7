<?php

include_once "../Model/Base.Class.php";

class DAO extends Base {
    /* Método construtor do banco de dados */

    public function __construct() {

        define("SEPARADOR", ", ");
        define("VIRGULA", ", ");
        define("IGUAL", " = ");
        define("WHERE", " WHERE ");
        define("E", " AND ");
        define("OR", " OR ");
        define("ORDER", " ORDER BY ");
        define("UPDATE", " UPDATE ");
        define("FROM", " FROM ");
        define("JOIN", " JOIN ");
        define("INNER_JOIN", " INNER JOIN ");
        define("LEFT_JOIN", " LEFT JOIN ");
        define("RIGHT_JOIN", " RIGHT JOIN ");
        define("SELECT", " SELECT ");
        define("SET", " SET ");
        define("INSERT", " INSERT ");
        define("VALUES", " VALUES ");
        define("INTO", " INTO ");
        define("IN", " IN ");
        define("NOT_IN", " NOT IN ");
        define("ON", " ON ");
        define("TUDO", " * ");
        define("ASPA", "'");
        define("ESPACO", " ");
        define("APAR", " ( ");
        define("FPAR", " ) ");
        define("ASC", " ASC ");
        define("DESC", " DESC ");
        define("COUNT", " COUNT(*) ");
        define("BETWEEN", " BETWEEN ");
        define("DIFERENTE", " <> ");
        define("MAIOR", " > ");
        define("MENOR", " < ");
        define("MAIOR_IGUAL", " >= ");
        define("MENOR_IGUAL", " <= ");
        define("MAXIMO", " MAX");
        define("MINIMO", " MIN");
        define("SOMA", " SUM");
        define("MEDIA", " AVG");
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

    /*
      public static $dbtype = "mysql";
      public static $host = "192.168.0.6";
      public static $port = "3306";
      public static $user = "rodrigo_linux";
      public static $password = "123";
      //public static $db = "teste";

      public static $db = "portal_vendas_ptv";
     */
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
        $objBase = new Base();
        if ($objBase->getEmpresaPortal() == "PT") {
            if ($objBase->getBase() == "TST") {
                try {
                    $this->Conexao = new PDO("informix:host=192.168.5.45; service=1950; database=logix; server=logixsoc; protocol=onsoctcp; EnableScrollableCursors=1", "forge", "3pr0cur3m3nt", array(PDO::ATTR_PERSISTENT => TRUE, PDO::ATTR_PREFETCH => 500));

                    $this->Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $i) {
                    die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
                }
            } else {
                try {
                    $this->Conexao = new PDO("informix:host=192.168.5.3; service=1950; database=logix; server=logixsoc; protocol=onsoctcp; EnableScrollableCursors=1", "root", "kalu69", array(PDO::ATTR_PERSISTENT => TRUE, PDO::ATTR_PREFETCH => 500));

                    $this->Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $i) {
                    die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
                }
            }
            /*
             */


            $query = $this->Conexao->prepare("set isolation to dirty read");
            $query->execute();
            $query = $this->Conexao->prepare("SET LOCK MODE TO WAIT");
            $query->execute();
            return ($this->Conexao);
        }
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

    public function Executar($query, $insertid = false) {
        $query = $this->Conectar()->prepare($query);
        $Result = $query->execute();
        self::__destruct();
        return $Result;
    }

    public function ConsultarComFiltroTeste($table, $fields = "*", $filtro = null, $inicio = 0, $registros = 1000000, $params = null, $order = null) {
        $table = $table;
        if (isset($filtro) && !is_null($filtro) && $filtro != "") {

            $filtro = " WHERE {$filtro}";
        } else {
            $filtro = null;
        }

        $ini = (int) $inicio;
        if ($this->getEmpresaPortal() == 'PT') {
            if (isset($ini)) {
                $query = "SELECT SKIP {$inicio} FIRST  {$registros} {$fields} FROM {$table} {$params} {$filtro}";
            } else {
                $query = "SELECT  {$fields} FROM {$table} {$params} {$filtro}";
            }
        }
        echo $query;
        $Result = $this->Conectar()->prepare($query);
        $Result->execute();


        if (($Result) && (count($Result) > 0)) {
            return $Result;
        } else {
            return false;
        }
    }

    public function ConsultarComFiltro($table, $fields = "*", $filtro = null, $inicio = 0, $registros = 1000000, $params = null, $order = null) {
        $table = $table;
        if (isset($filtro) && !is_null($filtro) && $filtro != "") {

            $filtro = " WHERE {$filtro}";
        } else {
            $filtro = null;
        }

        $ini = (int) $inicio;
        if ($this->getEmpresaPortal() == 'PT') {
            if (isset($ini)) {
                $query = "SELECT SKIP {$inicio} FIRST  {$registros} {$fields} FROM {$table} {$params} {$filtro}";
            } else {
                $query = "SELECT  {$fields} FROM {$table} {$params} {$filtro}";
            }
        }
// echo $query;
        $Result = $this->Conectar()->prepare($query);
        $Result->execute();


        if (($Result) && (count($Result) > 0)) {
            return $Result;
        } else {
            return false;
        }
    }

    public function ConsultarCarlos($table, $fields = "*", $params = null) {
        $table = $table;
        $params = ($params) ? " {$params}" : null;
        $query = "SELECT {$fields} FROM {$table} {$params}";
//echo $query;
        $Result = $this->Conectar()->prepare($query);
        $Result->execute();
        if (($Result) && (count($Result) > 0)) {
            return $Result;
        } else {
            return false;
        }
    }

    /* Método select que retorna um array de objetos */

    public function Consultar($tabela, $campos = "*", $parametros = null) {
        try {
            $tabela = $tabela;
            $parametros = ($parametros) ? " {$parametros}" : null;
            $sql = "SELECT {$campos} FROM {$tabela} {$parametros}";
//echo $sql."<br/>";
            $query = $this->Conectar()->prepare($sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

// Contar numero de linhas
        $count = count($query);
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

    public function ConsultarTeste($tabela, $campos = "*", $parametros = null) {
        try {
            $tabela = $tabela;
            $parametros = ($parametros) ? " {$parametros}" : null;
            $sql = "SELECT {$campos} FROM {$tabela} {$parametros}";
            echo $sql . "<br/>";
            $query = $this->Conectar()->prepare($sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

// Contar numero de linhas
        $count = count($query);
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

    public function ConsultarCustom($sql) {
        try {

            $query = $this->Conectar()->prepare($sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

// Contar numero de linhas
        $count = count($query);
//Se teve retorno da consulta gravará dos no array
        if ($count > 0) {

            return $query;
        } else {
            return false;
        }
        self::__destruct();
    }

    public function InserirCustom($sql) {
        try {

            $query = $this->Conectar()->prepare($sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

// Contar numero de linhas
        $count = count($query);
//Se teve retorno da consulta gravará dos no array

        return $query;

        self::__destruct();
    }

    /* Metodo select que retorna um arrar de objetos com inner na tabela Base */

    public function ConsultarInnerEntidadePadraoTeste($tabela, $campos = "*", $parametros = null, $parametroInner) {
        include_once '../Model/Base.Class.php';
        $objBase = new Base();
        try {
            $tabela = $tabela;

            $parametros = ($parametros) ? " {$parametros}" : null;
            $sql = "SELECT * FROM {$tabela} INNER JOIN " . BASE_TABLENAME . " ENT ON (ENT." . BASE_ID . " = {$parametroInner}) {$parametros}";
            echo $sql . "<br/>";
            $query = $this->Conectar()->prepare($sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

// Contar numero de linhas
        $count = count($query);
//Se teve retorno da consulta gravará dos no array
        if ($count > 0) {
            while ($result = $query->fetch(PDO::FETCH_BOTH)) {
                $dados[] = $result;
            }

            return $dados;
        } else {
            return false;
        }
        self::__destruct();
    }

    public function ConsultarInnerEntidadePadrao($tabela, $campos = "*", $parametros = null, $parametroInner) {
        include_once '../Model/Base.Class.php';
        $objBase = new Base();
        try {
            $tabela = $tabela;

            $parametros = ($parametros) ? " {$parametros}" : null;
            $sql = "SELECT * FROM {$tabela} INNER JOIN " . BASE_TABLENAME . " ENT ON (ENT." . BASE_ID . " = {$parametroInner}) {$parametros}";
//echo $sql."<br/>";
            $query = $this->Conectar()->prepare($sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

// Contar numero de linhas
        $count = count($query);
//Se teve retorno da consulta gravará dos no array
        if ($count > 0) {
            while ($result = $query->fetch(PDO::FETCH_BOTH)) {
                $dados[] = $result;
            }

            return $dados;
        } else {
            return false;
        }
        self::__destruct();
    }

    public function Inserir($table, array $data) {

        $table = $table; //podemos passar um prefixo pr� estabelecido
        $data = $this->Escapar($data);
//Pegamos apenas os nomes chaves do array e colocamos dentro de uma variavel # $var = "key1, key2, key3";
        $fields = implode(', ', array_keys($data));
//Pegamos o conteudo do array e colocamos dentro de uma variavel # $var = "dados1, dados2, dados3";
//$values = "'" . implode("', '", $data) . "'";
        foreach ($data as $value) {
            if ($contador == 0) {
                $separador = " ";
            } else {
                $separador = ", ";
            }
            if (substr_count(strtoupper($value), "SELECT") > 0 ||
                    substr_count(strtoupper($value), "TO_DATE") > 0 ||
                    substr_count(strtoupper($value), "DATETIME") > 0 ||
                    substr_count(strtoupper($value), "GETDATE") > 0 ||
                    substr_count(strtoupper($value), "SYSDATE") > 0) {
                $values = $values . $separador . $value . "";
            } else {
                $values = $values . $separador . "'" . $value . "'";
            }
            $contador++;
        }
        $sql = "INSERT INTO {$table} ( {$fields} ) VALUES ( {$values} )";
//var_dump($sql);
        try {
            $query = $this->Conectar()->prepare($sql);
            $query->execute();
            return true;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function ConsultarAuditoria($tabela, array $data, $parametros = null) {
        try {
            $tabela = $tabela;
            $parametros = ($parametros) ? " {$parametros}" : null;

            $data = $this->Escapar($data);
//Pegamos apenas os nomes chaves do array e colocamos dentro de uma variavel # $var = "key1, key2, key3";
            $fields = implode(', ', array_keys($data));

            $sql = "SELECT {$fields} FROM {$tabela} {$parametros}";

            $query = $this->Conectar()->prepare($sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

// Contar numero de linhas
        $count = count($query);
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

    public function ConsultarAuditoriaTeste($tabela, array $data, $parametros = null) {
        try {
            $tabela = $tabela;
            $parametros = ($parametros) ? " {$parametros}" : null;

            $data = $this->Escapar($data);
//Pegamos apenas os nomes chaves do array e colocamos dentro de uma variavel # $var = "key1, key2, key3";
            $fields = implode(', ', array_keys($data));

            $sql = "SELECT {$fields} FROM {$tabela} {$parametros}";

            $query = $this->Conectar()->prepare($sql);
            $query->execute();
        } catch (PDOException $i) {
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

// Contar numero de linhas
        $count = count($query);
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

    public function InserirTeste($table, array $data, $inserir = TRUE) {
        $table = $table; //podemos passar um prefixo pr� estabelecido
        $data = $this->Escapar($data);
//Pegamos apenas os nomes chaves do array e colocamos dentro de uma variavel # $var = "key1, key2, key3";
        $fields = implode(', ', array_keys($data));
//Pegamos o conteudo do array e colocamos dentro de uma variavel # $var = "dados1, dados2, dados3";
//$values = "'" . implode("', '", $data) . "'";
        foreach ($data as $value) {
            if ($contador == 0) {
                $separador = " ";
            } else {
                $separador = ", ";
            }
            if (substr_count(strtoupper($value), "SELECT") > 0 ||
                    substr_count(strtoupper($value), "TO_DATE") > 0 ||
                    substr_count(strtoupper($value), "DATETIME") > 0 ||
                    substr_count(strtoupper($value), "GETDATE") > 0 ||
                    substr_count(strtoupper($value), "SYSDATE") > 0) {
                $values = $values . $separador . $value . "";
            } else {
                $values = $values . $separador . "'" . $value . "'";
            }
            $contador++;
        }
        $sql = "INSERT INTO {$table} ( {$fields} ) VALUES ( {$values} )";


        echo $sql . "<br/>";
        if ($inserir) {
            try {
                $query = $this->Conectar()->prepare($sql);
                $query->execute();
                return true;
            } catch (Exception $e) {
                throw new Exception($e);
            } finally {
                self::__destruct();
            }
        }
    }

    /* Método insert que insere valores no banco de dados e retorna o último id inserido */

    /* public function Inserir($sql, $parametros = null) {
      $query = $this->Conectar()->prepare($sql);
      $query->execute($parametros);
      $rs = $Conexao->lastInsertId() or die(print_r($query->errorInfo(), true));
      self::__destruct();
      return $rs;
      }
     */

    public function Atualizar($table, array $data, $where = null, $insertid = false) {
        $table = $table;
        $where = ($where) ? "{$where}" : null;
        $data = $this->Escapar($data);
//Pegamos o array passado via pametros e colocamos dentro de um array usado para enviar os dados no UPDATE
        foreach ($data as $key => $value) {
            if (substr_count(strtoupper($value), "SELECT") > 0 ||
                    substr_count(strtoupper($value), "TO_DATE") > 0 ||
                    substr_count(strtoupper($value), "DATETIME") > 0 ||
                    substr_count(strtoupper($value), "GETDATE") > 0 ||
                    substr_count(strtoupper($value), "MDY") > 0 ||
                    substr_count(strtoupper($value), "SYSDATE") > 0) {
                $fields[] = "{$key} = {$value}";
            } else {
                $fields[] = "{$key} = '{$value}'";
            }
        }
//Fazemos junção dos dados contidos no array para ficar dentro de uma variavel # $array = "{$key} = '{$value}";
        $fields = implode(', ', $fields);

        $query = "UPDATE {$table} SET {$fields} {$where}";
//echo $query . "<br/>";
        return $this->Executar($query, $insertid);
    }

    public function AtualizarTeste($table, array $data, $where = null, $insertid = false) {
        $table = $table;
        $where = ($where) ? "{$where}" : null;
        $data = $this->Escapar($data);
//Pegamos o array passado via pametros e colocamos dentro de um array usado para enviar os dados no UPDATE
        foreach ($data as $key => $value) {
            if (substr_count(strtoupper($value), "SELECT") > 0 ||
                    substr_count(strtoupper($value), "TO_DATE") > 0 ||
                    substr_count(strtoupper($value), "DATETIME") > 0 ||
                    substr_count(strtoupper($value), "GETDATE") > 0 ||
                    substr_count(strtoupper($value), "MDY") > 0 ||
                    substr_count(strtoupper($value), "SYSDATE") > 0) {
                $fields[] = "{$key} = {$value}";
            } else {
                $fields[] = "{$key} = '{$value}'";
            }
        }
//Fazemos junção dos dados contidos no array para ficar dentro de uma variavel # $array = "{$key} = '{$value}";
        $fields = implode(', ', $fields);

        $query = "UPDATE {$table} SET {$fields} {$where}";
        echo $query . "<br/>";
        return $this->Executar($query, $insertid);
    }

//deletar registros da tabela
    public function Deletar($table, $where = null) {
        $table = $table;
        $where = ($where) ? " {$where}" : null;

        $query = "DELETE FROM {$table}{$where}";

        return $this->Executar($query);
    }

    public function DeletarTeste($table, $where = null) {
        $table = $table;
        $where = ($where) ? " {$where}" : null;

        $query = "DELETE FROM {$table}{$where}";
        echo $query;
        return $this->Executar($query);
    }

}
