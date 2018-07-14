<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Erros
 *
 * @author Rodrigo
 */
class Erros {
    public function manipuladorErros($Padroes, $errno, $errstr = '', $errfile = '', $errline = '') {
        include_once '../Controller/Padroes.Class.php';
        include_once '../Controller/Email.class.php';
        include_once '../Controller/Funcionalidades.class.php';
        $ObjPadroesInterno = new Padroes();
        $ObjEmail = new Email();
        $ObjFuncionalidades = new Funcionalidades();
        $ObjPadroesInterno = $Padroes;
        if (error_reporting() == 0)
            return;

        // Verifica se não foi chamada por uma 'exception'
        if (func_num_args() == 5) {
            $exception = null;
            list($errno, $errstr, $errfile, $errline) = func_get_args();
            //$backtrace = array_reverse(debug_backtrace());
        } else {
            $exc = func_get_arg(0);
            $errno = $exc->getCode(); // Nome do erro
            $errstr = $exc->getMessage(); // Descrição do erro
            $errfile = $exc->getFile(); // Arquivo
            $errline = $exc->getLine(); // Linha
            //$backtrace = $exc->getTrace();
        }

        // A variável $backtrace pode ser usada para fazer um Back Trace do erro
        // "Nome" de cada tipo de erro
        $errorType = array(E_ERROR => 'ERROR', E_WARNING => 'WARNING', E_PARSE => 'PARSING ERROR', E_NOTICE => 'NOTICE', E_CORE_ERROR => 'CORE ERROR', E_CORE_WARNING => 'CORE WARNING', E_COMPILE_ERROR => 'COMPILE ERROR', E_COMPILE_WARNING => 'COMPILE WARNING', E_USER_ERROR => 'USER ERROR', E_USER_WARNING => 'USER WARNING', E_USER_NOTICE => 'USER NOTICE', E_STRICT => 'STRICT NOTICE', E_RECOVERABLE_ERROR => 'RECOVERABLE ERROR');
        // Define o "nome" do erro atual
        if (array_key_exists($errno, $errorType)) {
            $err = $errorType[$errno];
        } else {
            $err = 'CAUGHT EXCEPTION';
        }
        // Se está ativo o LOG de erros, salva uma mensagem no log, usando o formato padrão
        if (ini_get('log_errors')) {
            error_log(sprintf("PHP %s:  %s in %s on line %d", $err, $errstr, $errfile, $errline));
        }
        // Mensagem para o email
        $mensagem = "[ ERRO NO PHP ]<br>Site:  {$ObjPadroes->getNomeProjeto()} <br>";
        $mensagem .= "Tipo de erro: {$err} <br>Arquivo:  {$errfile} <br>Linha:  {$errline}<br>Descricao:  {$errstr} <br>";
        if (isset($_SERVER['REMOTE_ADDR'])) {
            $mensagem .= "<br>[ DADOS DO VISITANTE ]<br>";
            $mensagem .= "IP: " . $_SERVER['REMOTE_ADDR'] . "<br>";
            $mensagem .= "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "<br>";
        }
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = (preg_match('/HTTPS/i', $_SERVER["SERVER_PROTOCOL"])) ? 'https' : 'http';
            $url .= '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $mensagem .= "<br>URL: {$url}<br>";
        }
        if (isset($_SERVER['HTTP_REFERER'])) {
            $mensagem .= "Referer:  {$_SERVER['HTTP_REFERER']} <br>";
        }
        $mensagem .= "<br/>Data: " . date("d/m/Y H:i:s") . "<br>";
        $Destinatarios = array();
        $Destinatarios[] = $ObjPadroes->getEmailAdministrador();
        $ObjFuncionalidades->ExibeMensagem("Ocorreu um erro ao processar a acao desejada, o administrador ja foi acinado, tente novamente mais tarde.");
        return $ObjEmail->EnviaEmail($mensagem, "Controle de Erros", $Destinatarios, 0);
    }

}
