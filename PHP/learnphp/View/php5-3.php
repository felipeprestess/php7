<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 01/06/2018
 * Time: 13:01
 */

error_reporting(E_ALL & ~E_NOTICE);

    if($_REQUEST["action"] == "save"){
    $formValid = true;
    //var_dump($_REQUEST);
    $nome = strlen($_POST["nome"]);
    if($nome < 5 || $nome > 64){
        echo "O campo nome deve ter entre 5 e 64 caracteres";
        $formValid = false;
    }

    $idade = (int)$_POST["idade"];
    if( $idade < 4 || $idade > 120){
        echo "O campo idade deve ser digitado corretamente";
        $formValid = false;
    }

    $email = $_POST["email"];
    $regex = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
    if(!preg_match($regex, $email)){
        echo "O campo email deve ser preenchido corretamente";
        $formValid = false;
    }

    $sexo = $_POST["sexo"];
    if($sexo != 'M' && $sexo != 'F'){
        echo "O campo sexo deve ser preenchido";
        $formValid = false;
    }

    $curso = $_POST["curso"];
    if($curso == "" || $curso == "Selecione"){
        echo "O campo curso deve ser preenchido";
        $formValid = false;
    }

    $conhecimentos = $_POST["conhecimentos"];
    if(sizeof($conhecimentos) < 2){
        echo "É necessário marcar ao menos dois conhecimentos";
        $formValid = false;
    }

    if($formValid){
        echo "Formulário validado com sucesso!";
        exit();
    }
}

?>
<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Treinamento de envio de Formulário</title>
    <script>
        
        function validaForm() {
            var tamanhoNome = document.forms["formTeste"].nome.value.length;
            var idade = document.forms["formTeste"].idade.value;
            var email = document.forms["formTeste"].email.value;
            var campoSexo = document.forms["formTeste"].sexo;
            var sexo = false;
            var opcaoCurso = document.forms["formTeste"].curso.selectedIndex;
            var conhecimentos = document.forms["formTeste"].elements['conhecimentos[]'];
            var conhecimentoSelecionado = 0;

            if(tamanhoNome < 5 || tamanhoNome >64){
                alert("O campo nome deve ter entre 5 e 64 caracteres");
                return false;
            }

            if(isNaN(idade) || idade < 4 || idade > 120){
                alert("O campo idade deve ser informado corretamente");
            }

            if (email.length < 5 || email.length > 128 || email.indexOf('@') == -1 || email.indexOf('.') == -1){
                alert("O campo email deve ser informado corretamente");
            }
            
            for (var i = 0; i < campoSexo.length; i++){
                if(campoSexo[i].checked == true){
                    sexo = campoSexo[i].value;
                    break;
                }
            }

            if(!sexo){
                alert("O campo sexo deve ser preenchido.");
                return false;
            }

            if(opcaoCurso == 0){
                alert("O campo curso deve ser preenchido");
                return false;
            }

            for (var i = 0; i < conhecimentos.length; i++){
                if(conhecimentos[i].checked){
                    conhecimentoSelecionado++;
                }
            }

            if(conhecimentoSelecionado < 2){
                alert("É necessário ter ao mínimo 2 conhecimentos");
                return false;
            }

        }

        
    </script>

</head>
<body>
<form method="post" action="?action=save" name="formTeste">
    Nome:<input type="text" name="nome"  /><br>
    Idade: <input type="text" name="idade" /><br>
    E-Mail: <input type="email" name="email" /><br>
    Sexo: <input type="radio" name="sexo" value="F" />Feminino
    <input type="radio" name="sexo" value="M" />Masculino<br>
    Curso: <select name="curso">
        <option >Selecione</option>
        <option >Ciência da Computação</option>
        <option >Sistemas de Informação</option>
        <option >Engenharia de Software</option>
        <option >Tecnologia em Análise e Desenvolvimento de Sistemas</option>
    </select><br>
    Conhecimentos:
    <input type="checkbox" name="conhecimentos[]" value="Word">Microsoft Word
    <input type="checkbox" name="conhecimentos[]" value="HTML" >HTML
    <input type="checkbox" name="conhecimentos[]" value="JS" >JavaScript
    <input type="checkbox" name="conhecimentos[]" value="PHP" >PHP
    <input type="checkbox" name="conhecimentos[]" value="CSS" >CSS
    <input type="checkbox" name="conhecimentos[]" value="SQL" >SQL
    <input type="checkbox" name="conhecimentos[]" value="C#" >C#
    <input type="checkbox" name="conhecimentos[]" value="JAVA" >Java
    <br>
    <input type="reset" value="Limpar"/>
    <input type="submit" onclick="validaForm()" value="Enviar"/>
</form>
</body>
</html>
