<?PHP

class Usuario 
{
    private $id;
    private $login;
    private $senha;
    private $dataCadastro;

    public function getId(){
        return $this->id;
    }

    public function setId($value){
        $this->id = $value;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($value){
        $this->login = $value;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($value){
        $this->senha = $value;
    }

    public function getDataCadastro(){
        return $this->dataCadastro;
    }

    public function setDataCadastro($value){
        $this->dataCadastro = $value;
    }
    //Carrega o objeto pelo ID
    public function loadById($id){
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuario WHERE id = :ID",array(
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
            "login"=>$this->getLogin(),
            "senha"=>$this->getSenha(),
            "datacriacao"=>$this->getDataCadastro()->format("d/m/Y H:i:s")
        ));
    }

    public static function getList(){
        $sql = new Sql();

        return  $sql->select("SELECT * FROM tb_usuario ORDER BY login;");
    }

    public static function search($login){
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuario WHERE login LIKE :SEARCH ORDER BY login", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function login($login, $password)
    {
        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuario WHERE login = :LOGIN AND senha = :PASSWORD",array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if(count($result) > 0){
            $this->setData($result[0]);
        }else{
            throw new Exception("Login e/ou senha inválidos.");
            
        }
    }

    public function setData($data)
    {
        $this->setId($data['id']);
        $this->setLogin($data['login']);
        $this->setSenha($data['senha']);
        $this->setDataCadastro(new Datetime($data['datacriacao']));
    }

    public function insert()
    {
        $sql = new Sql();
        $result = $sql->select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)",array(
            ':LOGIN'=>$this->getLogin(),
            ':PASSWORD'=>$this->getSenha()
        ));

        if(count($result) > 0){
            $this->setData($result[0]);
        }
    }

    public function update($login, $password){

        $this->setLogin($login);
        $this->setSenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuario SET login = :LOGIN, senha = :PASSWORD WHERE id = :IDUSUARIO", array(
            ':LOGIN'=>$this->getLogin(),
            ':PASSWORD'=>$this->getSenha(),
            ':IDUSUARIO'=>$this->getId()
        ));
    }

    public function delete(){
        $sql = new Sql();

        $sql->query("DELETE FROM tb_usuario WHERE id =:IDUSUARIO",array(
            ':IDUSUARIO'=>$this->getId()
        ));

        $this->setId(0);
        $this->setLogin("");
        $this->setSenha("");
        $this->setDataCadastro(new DateTime());
    }
}


?>