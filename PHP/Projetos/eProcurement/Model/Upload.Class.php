<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Upload
 *
 * @author RodrigoIsensee
 */
include_once '../Model/Base.Class.php';

class Upload extends Base {

    private $arquivo;
    private $altura;
    private $largura;
    private $pasta;
    private $validaExtensao;

    function __construct($arquivo, $altura, $largura, $pasta, $validaExtensao = 0) {
        $this->arquivo = $arquivo;
        $this->altura = $altura;
        $this->largura = $largura;
        $this->pasta = $pasta;
        $this->validaExtensao = $validaExtensao;
    }

    private function getExtensao() {
//retorna a extensao da imagem	
        $extensao = explode('.', $this->arquivo['name']);
        return $extensao = strtolower(end($extensao));
    }

    private function extensaoValida($extensao) {
        if ($this->getEmpresaPortal() == "HI") {
            $extensoes = array('cmx', 'cdr', 'jpg');
        } else {
            $extensoes = array('gif', 'jpeg', 'jpg', 'png', 'odt', 'txt', 'doc', 'docx', 'xls', 'xlsx', 'pdf');
        }
// extensoes permitidas 
        if (in_array($extensao, $extensoes))
            return true;
    }

//largura, altura, tipo, localizacao da imagem original
    private function redimensionar($imgLarg, $imgAlt, $tipo, $img_localizacao) {
//descobrir novo tamanho sem perder a proporcao 
        if ($imgLarg > $imgAlt) {
            $novaLarg = $this->largura;
            $novaAlt = round(($novaLarg / $imgLarg) * $imgAlt);
        } elseif ($imgAlt > $imgLarg) {
            $novaAlt = $this->altura;
            $novaLarg = round(($novaAlt / $imgAlt) * $imgLarg);
        } else {
//altura == largura 
            $novaAltura = $novaLargura = max($this->largura, $this->altura);
//redimencionar a imagem
// //cria uma nova imagem com o novo tamanho	
            $novaimagem = imagecreatetruecolor($novaLarg, $novaAlt);
            switch ($tipo) {
                case 1:
// gif 
                    $origem = imagecreatefromgif($img_localizacao);
                    imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $novaLarg, $novaAlt, $imgLarg, $imgAlt);
                    imagegif($novaimagem, $img_localizacao);
                    break;
                case 2:
// jpg 
                    $origem = imagecreatefromjpeg($img_localizacao);
                    imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $novaLarg, $novaAlt, $imgLarg, $imgAlt);
                    imagejpeg($novaimagem, $img_localizacao);
                    break;
                case 3:
// png 
                    $origem = imagecreatefrompng($img_localizacao);
                    imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $novaLarg, $novaAlt, $imgLarg, $imgAlt);
                    imagejpeg($novaimagem, $img_localizacao);
                    break;
            }
//destroi as imagens criadas 
            imagedestroy($novaimagem);
            imagedestroy($origem);
        }
    }

    public function salvar() {
        $extensao = $this->getExtensao();
//gera um nome unico para a imagem em funcao do tempo 
        if ($extensao == 'png') {
            $extensao = 'jpg';
        }
        $novo_nome = time() . rand() . '.' . $extensao;
//localizacao do arquivo 
         $destino = $this->pasta . $novo_nome;
//move o arquivo 
        if ($this->validaExtensao == 1) {
            $extensaoValida = $this->extensaoValida($extensao);
        } else {
            $extensaoValida = true;
        }
        if ($extensaoValida) {
//pega a largura, altura, tipo e atributo da imagem 
            list($largura, $altura, $tipo, $atributo) = getimagesize($destino);
// testa se é preciso redimensionar a imagem
            if (($largura > $this->largura) || ($altura > $this->altura))
                $this->redimensionar($largura, $altura, $tipo, $destino);
        }else {
            include_once './Funcionalidades.Class.php';
            $objFuncionalidades = new Funcionalidades();

            $objFuncionalidades->ExibeMensagem("Extensao de arquivo não é válida");
            $objFuncionalidades->VoltarPaginaAnterior();
        }
        if (!move_uploaded_file($this->arquivo['tmp_name'], $destino)) {
            if ($this->arquivo['error'] == 1) {
                return "Tamanho excede o permitido";
            } else {
                return "Erro " . $this->arquivo['error'];
            }
        }


        return $novo_nome;
    }

}
?>


