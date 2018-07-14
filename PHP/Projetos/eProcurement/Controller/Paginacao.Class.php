<?php

class Paginacao {

    private $props = [];

    public function __get($name) {
        if (isset($this->props[strtolower($name)])) {
            return $this->props[strtolower($name)];
        } else {
            return false;
        }
    }

    public function __set($name, $value) {
        $this->props[strtolower($name)] = $value;
    }

    public function __construct($Tabela, $Filtro, $Inner = "", $campos = null) {
        $this->Paginacao($Tabela, $Filtro, $Inner, null, $campos);
    }

    public function Paginacao($Tabela, $Filtro, $Inner, $RegistrosPag = null, $campo = null) {
        include_once '../Model/DAO.Class.php';
        $objDao = new DAO();


        if ($Filtro) {
            $Filtro = $Inner . " WHERE " . $Filtro;
        } else {
            $Filtro = $Inner;
        }
        $this->Pagina = ((isset($_GET['Pagina']) && intval($_GET['Pagina']) > 1) ? (int) ($_GET['Pagina']) : 1) - 1;

        if ($objDao->getEmpresaPortal() == "MP") {
            if (is_null($RegistrosPag)) {
                $RegistrosPag = 10;
            }
            $this->Atual = $this->Pagina * $RegistrosPag; // Pula a quantidade de registros até os da página atual
            $this->Atual = $this->Atual + 1;
            $this->Limite = $this->Atual + $RegistrosPag; // Limite de registros por página\
            $this->SqlLimite = "";
            $retono = $objDao->Consultar($Tabela, "COUNT(0) CONT", $Filtro, 0, 100000000);
            $this->Total = $retono[0]['CONT'];
            $this->QuantidadePagina = ceil($this->Total / $RegistrosPag);
        } else {
            if (is_null($RegistrosPag)) {
                $RegistrosPag = 10;
            }
            $this->Atual = $this->Pagina * $RegistrosPag; // Pula a quantidade de registros até os da página atual
            $this->Limite = $RegistrosPag; // Limite de registros por página\
            $this->SqlLimite = "";
            if ($campo != "" && !is_null($campo)) {
                $registros = $objDao->ConsultarCustom("SELECT " . $campo . " FROM " . $Tabela . " " . $Filtro, 0, 100000000000000000000000000000000000000);
                $registros = count($registros->fetchAll(PDO::FETCH_BOTH));
                $this->Total = $registros;
            } else {
                $retono = $objDao->Consultar($Tabela, "COUNT(0) CONT", $Filtro, 0, 100000000);
                $this->Total = $retono[0]['CONT'];
            }

            $this->QuantidadePagina = ceil($this->Total / $RegistrosPag);
        }
    }

    public function MontaPaginas($Parametros = '') {
        if ($this->QuantidadePagina >= 1) {
            echo "<hr><div align='center'><ul class=\"pagination pagination-sm\">";
            if ($this->PaginaAtiva != 1) {
                echo "<li><a href=\"?Pagina=1{$Parametros}\">Primeira página</a></li>";
            }

            $Pagina = ((isset($_GET['Pagina']) && intval($_GET['Pagina']) > 1) ? (int) ($_GET['Pagina']) : 1);

            if ($Pagina < 5) {
                $Delimi = 10 - $Pagina;
            } else {
                $Delimi = $this->QuantidadePagina - $Pagina;
                if ($Delimi >= 5) {
                    $Delimi = 5;
                }
            }
            if ($Pagina < 5) {
                $DelimiAntes = $Pagina - 1;
            } elseif ($Pagina == $this->QuantidadePagina) {
                if (($Pagina - 5) > 0) {
                    $DelimiAntes = 10;
                } else {
                    $DelimiAntes = $Pagina - 1;
                }
            } else {
                $Antes = $Pagina - 4;
                if ($Antes > 4) {
                    $DelimiAntes = 10 - $Delimi - 1;
                } else {
                    $DelimiAntes = 4;
                }
            }

            if (($Pagina - $DelimiAntes) > 0) {
                for ($j = ($Pagina - $DelimiAntes); $j < $Pagina; $j++) {
                    $PaginaAtiva = ($j == $Pagina) ? "class=\"active\"" : "";
                    echo "<li {$PaginaAtiva}><a href=\"?Pagina={$j}{$Parametros}\">{$j}</a></li>";
                }
            } else {
                for ($j = 1; $j < $Pagina; $j++) {

                    $PaginaAtiva = ($j == $Pagina) ? "class=\"active\"" : "";
                    echo "<li {$PaginaAtiva}><a href=\"?Pagina={$j}{$Parametros}\">{$j}</a></li>";
                }
            }
            if (($Pagina + $Delimi) < $this->QuantidadePagina) {
                for ($i = $Pagina; $i <= ($Pagina + $Delimi); $i++) {
                    if ($Pagina == $i) {
                        $PaginaAtiva = (($i) == $Pagina) ? "class=\"active\"" : "";
                        echo "<li {$PaginaAtiva}><a href='#'>" . $i . "</a></li>";
                    } else {
                        $PaginaAtiva = (($i) == $Pagina) ? "class=\"active\"" : "";
                        echo "<li {$PaginaAtiva}><a href=\"?Pagina={$i}{$Parametros}\">{$i}</a></li>";
                    }
                }
            } else {
                for ($i = $Pagina; $i <= ($this->QuantidadePagina); $i++) {
                    if ($Pagina == $i) {
                        $PaginaAtiva = (($i) == $Pagina) ? "class=\"active\"" : "";
                        echo "<li {$PaginaAtiva}><a href='#'>" . $i . "</a></li>";
                    } else {
                        $PaginaAtiva = (($i) == $Pagina) ? "class=\"active\"" : "";
                        echo "<li {$PaginaAtiva}><a href=\"?Pagina={$i}{$Parametros}\">{$i}</a></li>";
                    }
                }
            }

            if ($this->PaginaAtiva != $this->QuantidadePagina) {
                echo "<li><a href=\"?Pagina={$this->QuantidadePagina}{$Parametros}\">Última página</a></li>";
            }

            echo "</ul></div>";
        }
    }

}
