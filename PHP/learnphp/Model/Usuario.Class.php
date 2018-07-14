<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 02/06/2018
 * Time: 22:01
 */

class Usuario
{
    private $id;
    private $nomeCompleto;
    private $email;
    private $senha;
    private $login;
    private $dataCriacao;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    /**
     * @param mixed $nome
     */
    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setPassword($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * @param mixed $dataCriacao
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;
    }

    public function loadById($id)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM usuarios WHERE id = :ID", array(
            ":ID"=>$id
        ));

        if(count($result) > 0){
            $this->setData($result[0]);
        }
    }

    public function __toString()
    {
        return json_encode(array(
            "id"=>$this->getId(),
            "nomeCompleto"=>$this->getNomeCompleto(),
            "email"=>$this->getEmail(),
            "senha"=>$this->getSenha(),
            "login"=>$this->getLogin(),
            "dataCriacao"=>$this->getDataCriacao()->format("d/m/Y H:i:s")
        ));
    }

    public function getList()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM usuarios ORDER BY login;");
    }

    public static function search($login)
    {
        $sql = new Sql();

        $sql->select("SELECT * FROM  usuarios WHERE login LIKE :SEARCH ORDER BY login", array(
            ":SEARCH"=>"%".$login."%"
        ));
    }
}