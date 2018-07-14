<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Funcionalidades
 *
 * @author Rodrigo
 */
class Funcionalidades {

    public function Contar($dados) {
        return count($dados);
    }

    public function AchaDataBarra($data, $dias) {
        if ($data)
            $data = date("d-m-Y");
        list($dia, $mes, $ano) = explode("-", $data);
        $timestamp = mktime(0, 0, 0, $mes, $dia + $dias, $ano);
        $data = date("d-m-Y", $timestamp);

        return $data;
    }

    public function formatarNumeroParaBanco($valor, $idioma) {
        switch ($idioma) {
            case "en": $valor = str_replace(",", "", $valor);
                break;
            default: $valor = str_replace(",", ".", $valor);
                break;
        }

        return $valor;
    }

    public function Confirmar($mesagem) {
        $string = "<script>if(confirm('{$mesagem}')){

document.write('1');

}else{
document.write('2');
}</script>";
        if (print_r($string) == "1") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function CalculaData($data, $valorSomar = 0, $tipo = "d", $operador = "+") {
        if ($tipo == "d") {
            if ($operador == "+") {
                $dataSomada = date('Y-m-d', strtotime("+{$valorSomar} days", strtotime($data)));
            } else {
                $dataSomada = date('Y-m-d', strtotime("-{$valorSomar} days", strtotime($data)));
            }
        } elseif ($tipo == "m") {
            if ($operador == "+") {
                $dataSomada = date('Y-m-d', strtotime("+{$valorSomar} month", strtotime($data)));
            } else {
                $dataSomada = date('Y-m-d', strtotime("-{$valorSomar} month", strtotime($data)));
            }
        } elseif ($tipo == "y") {
            if ($operador == "+") {
                $dataSomada = date('Y-m-d', strtotime("+{$valorSomar} year", strtotime($data)));
            } else {
                $dataSomada = date('Y-m-d', strtotime("-{$valorSomar} year", strtotime($data)));
            }
        }
        return $dataSomada;
    }

    public function enviaEmail($destinatarios, $assunto, $conteudo, $arquivo) {
        include_once '../Model/Usuario.Class.php';
        include_once '../Controller/DAOUsuario.php';
        include_once '../Controller/Session.php';
        include_once '../Includes/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = function($str, $level) {
            echo "debug level {$level} message: {$str}<br>";
        };
        $mail->Host = 'zimbra.perto.com.br';
        $mail->Port = 587;
        $mail->Timeout = 300;
        $mail->CharSet = "ISO-8859-1";
        $mail->SMTPAuth = true;
        $mail->Username = "eprocurement@perto.com.br";
        $mail->Password = "Epr@!v20019)";
        $mail->setFrom('eprocurement@perto.com.br', 'E-Procurement'); #REMETENTE

        foreach ($destinatarios as $key => $value) {
            $mail->addAddress($value['email'], $value['nome']);
        }

        $mail->Subject = "{$assunto}";
        $mail->msgHTML("{$conteudo}");
        $mail->AltBody = "{$conteudo}";

        if ($arquivo != "" && !is_null($arquivo)) {
            $mail->addAttachment($arquivo);
        }



        if (!$mail->send()) {
            return 0;
        } else {
            return 1;
        }
    }

    public function geraSenha($tamanho = 15, $maiusculas = true, $numeros = true, $simbolos = false) {
        $lmin = '';
        $lmai = '';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        if ($maiusculas)
            $caracteres .= $lmai;
        if ($numeros)
            $caracteres .= $num;
        if ($simbolos)
            $caracteres .= $simb;
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }

    public function valida_cpf($cpf = false) {
// Exemplo de CPF: 025.462.884-23

        /**
         * Multiplica dÃ­gitos vezes posiÃ§Ãµes 
         *
         * @param string $digitos Os digitos desejados
         * @param int $posicoes A posiÃ§Ã£o que vai iniciar a regressÃ£o
         * @param int $soma_digitos A soma das multiplicaÃ§Ãµes entre posiÃ§Ãµes e dÃ­gitos
         * @return int Os dÃ­gitos enviados concatenados com o Ãºltimo dÃ­gito
         *
         */
        if (!function_exists('calc_digitos_posicoes')) {

            function calc_digitos_posicoes($digitos, $posicoes = 10, $soma_digitos = 0) {
// Faz a soma dos dÃ­gitos com a posiÃ§Ã£o
// Ex. para 10 posiÃ§Ãµes: 
//   0    2    5    4    6    2    8    8   4
// x10   x9   x8   x7   x6   x5   x4   x3  x2
//   0 + 18 + 40 + 28 + 36 + 10 + 32 + 24 + 8 = 196
                for ($i = 0; $i < strlen($digitos); $i++) {
                    $soma_digitos = $soma_digitos + ( $digitos[$i] * $posicoes );
                    $posicoes--;
                }

// Captura o resto da divisÃ£o entre $soma_digitos dividido por 11
// Ex.: 196 % 11 = 9
                $soma_digitos = $soma_digitos % 11;

// Verifica se $soma_digitos Ã© menor que 2
                if ($soma_digitos < 2) {
// $soma_digitos agora serÃ¡ zero
                    $soma_digitos = 0;
                } else {
// Se for maior que 2, o resultado Ã© 11 menos $soma_digitos
// Ex.: 11 - 9 = 2
// Nosso dÃ­gito procurado Ã© 2
                    $soma_digitos = 11 - $soma_digitos;
                }

// Concatena mais um dÃ­gito aos primeiro nove dÃ­gitos
// Ex.: 025462884 + 2 = 0254628842
                $cpf = $digitos . $soma_digitos;

// Retorna
                return $cpf;
            }

        }

// Verifica se o CPF foi enviado
        if (!$cpf) {
            return false;
        }

// Remove tudo que nÃ£o Ã© nÃºmero do CPF
// Ex.: 025.462.884-23 = 02546288423
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

// Verifica se o CPF tem 11 caracteres
// Ex.: 02546288423 = 11 nÃºmeros
        if (strlen($cpf) != 11) {
            return false;
        }

// Captura os 9 primeiros dÃ­gitos do CPF
// Ex.: 02546288423 = 025462884
        $digitos = substr($cpf, 0, 9);

// Faz o cÃ¡lculo dos 9 primeiros dÃ­gitos do CPF para obter o primeiro dÃ­gito
        $novo_cpf = calc_digitos_posicoes($digitos);

// Faz o cÃ¡lculo dos 10 dÃ­gitos do CPF para obter o Ãºltimo dÃ­gito
        $novo_cpf = calc_digitos_posicoes($novo_cpf, 11);

// Verifica se o novo CPF gerado Ã© idÃªntico ao CPF enviado
        if ($novo_cpf === $cpf) {
// CPF vÃ¡lido
            return true;
        } else {
// CPF invÃ¡lido
            return false;
        }
    }

    public function valida_cnpj($cnpj) {
// Deixa o CNPJ com apenas nÃºmeros
        $cnpj = substr(preg_replace('/[^0-9]/', '', $cnpj), 1);
// Garante que o CNPJ Ã© uma string
        $cnpj = (string) $cnpj;

// O valor original
        $cnpj_original = $cnpj;

// Captura os primeiros 12 nÃºmeros do CNPJ
        $primeiros_numeros_cnpj = substr($cnpj, 0, 12);

        /**
         * MultiplicaÃ§Ã£o do CNPJ
         *
         * @param string $cnpj Os digitos do CNPJ
         * @param int $posicoes A posiÃ§Ã£o que vai iniciar a regressÃ£o
         * @return int O
         *
         */
        if (!function_exists('multiplica_cnpj')) {

            function multiplica_cnpj($cnpj, $posicao = 5) {
// VariÃ¡vel para o cÃ¡lculo
                $calculo = 0;

// LaÃ§o para percorrer os item do cnpj
                for ($i = 0; $i < strlen($cnpj); $i++) {
// CÃ¡lculo mais posiÃ§Ã£o do CNPJ * a posiÃ§Ã£o
                    $calculo = $calculo + ( $cnpj[$i] * $posicao );

// Decrementa a posiÃ§Ã£o a cada volta do laÃ§o
                    $posicao--;

// Se a posiÃ§Ã£o for menor que 2, ela se torna 9
                    if ($posicao < 2) {
                        $posicao = 9;
                    }
                }
// Retorna o cÃ¡lculo
                return $calculo;
            }

        }

// Faz o primeiro cÃ¡lculo
        $primeiro_calculo = multiplica_cnpj($primeiros_numeros_cnpj);

// Se o resto da divisÃ£o entre o primeiro cÃ¡lculo e 11 for menor que 2, o primeiro
// DÃ­gito Ã© zero (0), caso contrÃ¡rio Ã© 11 - o resto da divisÃ£o entre o cÃ¡lculo e 11
        $primeiro_digito = ( $primeiro_calculo % 11 ) < 2 ? 0 : 11 - ( $primeiro_calculo % 11 );

// Concatena o primeiro dÃ­gito nos 12 primeiros nÃºmeros do CNPJ
// Agora temos 13 nÃºmeros aqui
        $primeiros_numeros_cnpj .= $primeiro_digito;

// O segundo cÃ¡lculo Ã© a mesma coisa do primeiro, porÃ©m, comeÃ§a na posiÃ§Ã£o 6
        $segundo_calculo = multiplica_cnpj($primeiros_numeros_cnpj, 6);
        $segundo_digito = ( $segundo_calculo % 11 ) < 2 ? 0 : 11 - ( $segundo_calculo % 11 );

// Concatena o segundo dÃ­gito ao CNPJ
        $cnpj = $primeiros_numeros_cnpj . $segundo_digito;

// Verifica se o CNPJ gerado Ã© idÃªntico ao enviado
        if ($cnpj === $cnpj_original) {
            return true;
        } else {
            return false;
        }
    }

    public function portalOnline() {
        include_once '../Controller/DAOPadroesModulo.php';

        $Derruba = buscaValorPadraoPorNome("Logoff Sistema");
        $Volta = buscaValorPadraoPorNome("Fim Logoff Sistema");

//COMEÇO CÓDIGO

        if (!is_null($Derruba) && $Derruba != '') {
            $separaDataHora = explode("T", $Derruba);
            $dt = $separaDataHora[0];
            $hr = $separaDataHora[1];

            $DateTimederruba = ($dt . ' ' . $hr);

            $separaDataHoraVolta = explode("T", $Volta);
            $dtVolta = $separaDataHoraVolta[0];
            $hrVolta = $separaDataHoraVolta[1];

            $DateTimeVolta = ($dtVolta . ' ' . $hrVolta);

            $Agora = date("Y-m-d H:i");

            if (strtotime($DateTimederruba) < strtotime($Agora) && strtotime($DateTimeVolta) > strtotime($Agora)) {
                return 0;
            } else {
                return 1;
            }
        }
    }

    public function EscapeManual($dados) {

        $escape = trim($dados);
        $escape = str_replace("'", "", $escape);
        $escape = str_replace("\'", "", $escape);
        $escape = str_replace("\"", "", $escape);
        $escape = str_replace("\\", "", $escape);
//$escape = str_replace("1=1","",$escape);
        return str_replace("=", "", $escape);
    }

    /*

      public function RemoverAcentos($dados){

      $remover = trim($dados);
      $remover = str_replace(" ", "_", $remover);
      $remover = str_replace("Ã£", "a", $remover);
      $remover = str_replace("Ã¡", "a", $remover);
      $remover = str_replace("Ã ", "a", $remover);
      $remover = str_replace("Ã©", "e", $remover);
      $remover = str_replace("Ãª", "e", $remover);
      $remover = str_replace("Ã¨", "e", $remover);
      $remover = str_replace("Ã­", "i", $remover);
      $remover = str_replace("Ã¬", "i", $remover);
      $remover = str_replace("Ã³", "o", $remover);
      $remover = str_replace("Ãµ", "o", $remover);
      $remover = str_replace("Ã§", "c", $remover);
      $remover = str_replace(",", "", $remover);
      $remover = str_replace("-", "", $remover);
      return  $remover;
      }
     */

    public function Maiuscula($str) {
        return mb_convert_case($str, MB_CASE_UPPER, 'UTF-8');
    }

    public function Minuscula($str) {
        return mb_convert_case($str, MB_CASE_LOWER, 'UTF-8');
    }

    public function ImagemSrc($dados) {
        preg_match_all(
                '/(<img.*?src=[\'|"])' . // A tag da imagem atÃ© src=' ou "
                '([^\'|"]*)' . // O endereÃ§o
                '([\'|"].*?\/?\>)' . // Fechamendo do src e o resto da tag de imagem
                '/mi', // PCRE_MULTILINE e PCRE_CASELESS
                $dados, // O HTML
                $imgs                    // Um array do que foi encontrado
        );
        return $imgs;
    }

    public function NumeroReal($dados) {
        $var = number_format($dados, 2, ",", ".");
        return $var;
    }

    public function MudarMesData($mes) {
        switch ($mes) {
            case "JAN": return "01";
                break;
            case "FEV": return "02";
                break;
            case "MAR": return "03";
                break;
            case "ABR": return "04";
                break;
            case "MAI": return "05";
                break;
            case "JUN": return "06";
                break;
            case "JUL": return "07";
                break;
            case "AGO": return "08";
                break;
            case "SET": return "09";
                break;
            case "OUT": return "10";
                break;
            case "NOV": return "11";
                break;
            case "DEZ": return "12";
                break;
        }
    }

    public function StringMesAtual() {
        $month = (int) date('m');

        switch ($month) {
            case 1:
                return "Janeiro";
                break;
            case 2:
                return "Fevereiro";
                break;
            case 3:
                return "Março";
                break;
            case 4:
                return "Abril";
                break;
            case 5:
                return "Maio";
                break;
            case 6:
                return "Junho";
                break;
            case 7:
                return "Julho";
                break;
            case 8:
                return "Agosto";
                break;
            case 9:
                return "Setembro";
                break;
            case 10:
                return "Outubro";
                break;
            case 11:
                return "Novembro";
                break;
            case 12:
                return "Dezembro";
                break;
            default :
                return NULL;
                break;
        }
    }

    public function ProtecaoAddSlashes() {
        if ($_REQUEST) {
            foreach ($_REQUEST as $key => $value) {
                $_REQUEST[$key] = trim(addslashes($value));
            }
        }
        if ($_POST) {
            foreach ($_POST as $key => $value) {
                $_POST[$key] = trim(addslashes($value));
            }
        }
        if ($_COOKIE) {
            foreach ($_COOKIE as $key => $value) {
                $_COOKIE[$key] = trim(addslashes($value));
            }
        }
        if ($_GET) {
            foreach ($_GET as $key => $value) {
                $_GET[$key] = trim(addslashes($value));
            }
        }
        /*
          if($_FILES)
          foreach($_FILES as $key => $value){if($value['name']){$_FILES[$key]['name'] = addslashes($value['name']);}}
         */
        return true;
    }

    public function RemoverAcentos($dados) {
        $remover = trim($dados);
        $remover = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $remover));
        return $remover;
    }

    public function RemoverAcentosGlobal() {
        if ($_REQUEST) {
            foreach ($_REQUEST as $key => $value) {
                $_REQUEST[$key] = $this->RemoverAcentos($value);
            }
        }
        if ($_POST) {
            foreach ($_POST as $key => $value) {
                $_POST[$key] = $this->RemoverAcentos($value);
            }
        }
        if ($_GET) {
            foreach ($_GET as $key => $value) {
                $_GET[$key] = $this->RemoverAcentos($value);
            }
        }
    }

    public function toUpperGlobal() {
        ini_set('display_errors', 1);
        ini_set('display_startup_erros', 1);
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        if ($_REQUEST) {
            foreach ($_REQUEST as $key => $value) {
                if (is_string($value)) {
                    $_REQUEST[$key] = strtoupper($value);
                }
            }
        }
        if ($_POST) {
            foreach ($_POST as $key => $value) {
                if (is_string($value)) {
                    $_POST[$key] = strtoupper($value);
                }
            }
        }
        if ($_GET) {
            foreach ($_GET as $key => $value) {
                if (is_string($value)) {
                    $_GET[$key] = strtoupper($value);
                }
            }
        }
    }

    public function Trim($dados) {
//Verifica se os dados sÃ£o diferentes de um array caso contrario faz o escape por uma string
        if (!is_array($dados)) {
            return trim($dados);
        } else {
            foreach ($dados as $key => $value) {
                $key = trim($key);
                $value = trim($value);
                $dados[$key] = $value;
            }
            return $dados;
        }
    }

//Limpamos a String de Caracteres html, limitamos exibiÃ§Ã£o atÃ© 256
//quebramos linha a cada 75 caracteres dando um enter com <br>
    public function LimpaString($str) {
        return wordwrap(substr(strip_tags($str), 0, 256), 75, "<br>\n");
    }

    public static function ExibeMensagem($Mensagem) {
        echo "<script type = 'text/javascript'>alert('{$Mensagem}');</script>";
    }

    public static function FecharGuia() {
        echo "<script type = 'text/javascript'>window.close();</script>";
    }

    public static function Redirecionar($Url) {
        echo "<script type = 'text/javascript'>location.href = '{$Url}';</script>";
    }

    public function AbrirNovaGria($Url) {
        echo "<script type = 'text/javascript'>window.open('{$Url}', '_blank');</script>";
    }

    public function VoltarPaginaAnterior() {
        echo "<script type = 'text/javascript'>javascript:history.go(-1);exit();</script>";
        exit();
    }

    public function EnviarRequisicaoAjax($Url) {
        echo "<script type='text/javascript'>
                var xhttp = new XMLHttpRequest();
                xhttp.open('GET', '{$Url}', true);
                xhttp.send(); 
             </script>";
    }

    public function PermissoesDoUsuarioAoLogar($IdUsuario) {
        include_once './Usuario.Class.php';
        include_once '../Controller/DAOUsuario.php';
        include_once './PerfilUsuario.Class.php';

        $ObjUsuario = new Usuario();
        $objPerfilUsuario = new PerfilUsuario();
        $ArrayPermissoes = array();

        $PefilUsuarioId = buscaPerfilDoUsuarioPorId($IdUsuario);

        $ArrayPermissoes = BuscaPermissoesAcessar($PefilUsuarioId[0][PERFILUSUARIO_PERFIL_ID], $IdUsuario);

        return $ArrayPermissoes;
    }

    public function MontaAcessoUsuarioNovo($IdUsuario) {
        include_once './Usuario.Class.php';
        include_once '../Controller/DAOUsuario.php';
        include_once '../Model/PerfilUsuario.Class.php';

        $ObjUsuario = new Usuario();
        $objPerfilUsuario = new PerfilUsuario();
        $ArrayPermissoes = array();

        $PefilUsuarioId = buscaPerfilDoUsuarioPorId($IdUsuario);
        $ArrayPermissoesPerfil = BuscaPermissoesPerfilAcessar($PefilUsuarioId[0][PERFILUSUARIO_PERFIL_ID]);

        return $ArrayPermissoesPerfil;
    }

    public function DataAtual() {
        $Data = date("Y-m-d");
        return $Data;
    }

    public function FormataData($data_a_formatar, $delimitador, $delimitadorSaida) {
        $dataExplode = explode($delimitador, date('Y' . $delimitador . 'm' . $delimitador . 'd', strtotime($data_a_formatar)));
        return $dataExplode[2] . $delimitadorSaida . $dataExplode[1] . $delimitadorSaida . $dataExplode[0];
    }

    public function FormatarMoeda($numero, $numeroCasas = 0) {
        include_once '../Controller/DAOPadroesModulo.php';

        if ($numeroCasas == 0 || is_null($numeroCasas)) {
            $numeroCasas = buscaValorPadraoPorNome("Quantidade de casa decimais");
        }
        return number_format($numero, $numeroCasas, ',', '.');
    }

    public static function InclusaoSucesso() {
        $mensagem = "Cadastro realizado com suceso!";
        echo "<script type = 'text/javascript'>alert('{$mensagem}');</script>";
    }

    public static function InclusaoErro($e = null) {
        $Exception = new Exception();
        if ($e != null) {
            $Exception = $e;
        }
        $mensagem = "Erro ao cadastrar! \\n Linha: {$Exception->getLine()} \\n Em: {$Exception->getFile()} \\n Mensagem: {$Exception->getMessage()}";
        echo "<script type = 'text/javascript'>alert('{$mensagem}');</script>";
    }

    public static function AtualizacaoSucesso() {
        $mensagem = "Cadastro atualizado com suceso!";
        echo "<script type = 'text/javascript'>alert('{$mensagem}');</script>";
    }

    public static function AtualizacaoErro($e = null) {
        $Exception = new Exception();
        if ($e != null) {
            $Exception = $e;
        }
        $mensagem = "Erro ao atualizar cadastro! \\n Linha: {$Exception->getLine()} \\n Mensagem: {$Exception->getMessage()}";
        echo "<script type = 'text/javascript'>alert('{$mensagem}');</script>";
    }

    public static function ExclusaoSucesso() {
        $mensagem = "Excluído com suceso!";
        echo "<script type = 'text/javascript'>alert('{$mensagem}');</script>";
    }

    public static function ExclusaoErro($e = null) {
        $Exception = new Exception();
        if ($e != null) {
            $Exception = $e;
        }
        $mensagem = "Erro ao excluir! \\n Linha: {$Exception->getLine()} \\n Mensagem: {$Exception->getMessage()}";
        echo "<script type = 'text/javascript'>alert('{$mensagem}');</script>";
    }

    public static function sanitizeString($str) {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        $str = preg_replace('/[^a-z0-9@.:\/*, ]/i', '_', $str);
        return $str;
    }

}
