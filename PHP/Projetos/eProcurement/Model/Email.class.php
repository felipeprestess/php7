<?php

include_once '../Controller/Padroes.Class.php';
include_once '../Includes/PHPMailer/_lib/class.phpmailer.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author Rodrigo
 */
class Email extends PHPMailer {

    private $Host;
    private $Usuario;
    private $Senha;

    function __construct() {
        define("EMAIL_TABLENAME",  $this->getSchema()."joi_email_eml");
        define("EMAIL_ID", "eml_id");
        define("EMAIL_HOST", "eml_host");
        define("EMAIL_USUARIO", "eml_usuario");
        define("EMAIL_SENHA", "eml_senha");
    }

    function getHost() {
        return $this->Host;
    }

    function getUsuario() {
        return $this->Usuario;
    }

    function getSenha() {
        return $this->Senha;
    }

    function setHost($Host) {
        $this->Host = $Host;
    }

    function setUsuario($Usuario) {
        $this->Usuario = $Usuario;
    }

    function setSenha($Senha) {
        $this->Senha = $Senha;
    }

    public function EnviaEmail($Mensagem = null, $Assunto = null, $Remetente = "", $Destinatarios = null, $Anexo = null) {
        //Primeiro setamos o cabeçalho:
        $header = " Content-type: text/html; charset=iso-8859-1\r\n";
        //instanciamos o objeto
        $mail = new PHPMailer();
        // Informamos que vamos enviar através de SMTP
        $mail->IsSMTP();
        // Colocamos o servidor smtp
        $mail->Host = $this->Host();
        // Se seu servidor de smtp necessita de autenticação, devemos habilitar este item:
        $mail->SMTPAuth = true;
        // colocamos agora o usuário e senha do servidor smtp
        $mail->Username = $this->Usuario();
        $mail->Password = $this->Senha();
        // Agora vamos informar qual email vai aparecer como remetente
        $mail->From = (string) $Remetente;
        $mail->FromName = (string) "";
        //Agora vamos adicionar alguns destinatários

        foreach ($Destinatarios as $value) {
            $mail->AddAddress($value, "");
        }

        //Podemos setar qual é o tamanho do texto por linha pra quebrar a linha de forma automática
        $mail->WordWrap = 50;
        //Vamos colocar o assunto do email
        $mail->Subject = $Assunto;
        //vamos anexar os arquivos:
        //$mail->AddAttachment("../Relatorios/" . $Nome . ".pdf");
        //Setamos a propriedade do HTML para true
        $mail->IsHTML(true);
        //Colocamos o texto do email
        $mail->Body = $Mensagem;
        //e mandamos enviar:
        return $mail->Send();
    }

}
