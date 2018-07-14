<?PHP
$hierarquia = array(
    array(
        'nome_cargo'=>'CEO',
        'subordinados'=>array(
            //Início: Diretor Comercial
            array(
                'nome_cargo'=>'Diretor Comercial',
                'subordinados'=>array(
                    //Início: Gerente de Vendas
                    array('nome_cargo'=>'Gerente de Vendas')
                    //Término: Gerente de Venda
                )
            ),
            //Término: Diretor Comercial
            //Início: Diretor Financeiro
            array(
                'nome_cargo'=>'Diretor Financeiro',
                'subordinados' => array(
                    //Inicio: Gerente de contas a pagar
                    array(
                        'nome_cargo'=>'Gerente de contas a pagar',
                        'subordinados'=>array(
                            //Inicio: Supervisor de Pagamentos
                            array('nome_cargo'=>'Supervisor de Pagamentos')
                            //termino: Supervisor de pagamentos
                        )
                        ),
                    //Termino: Gerente de contas a pagar
                    //inicio: Gerente de compras
                    array(
                        'nome_cargo'=>'Gerente de Compras',
                        'subordinados'=>array(
                            //Inicio: Supervisor de suprimentos
                            array('nome_cargo'=>'Supervisor de Suprimentos')
                            //Termino:Supervisor de suprimentos
                        )
                    )
                    
                )
            )
            //Término: Diretor Financeiro
        )
    )
);

function exibe($cargos){
    $html = '<ul>';

    foreach ($cargos as $cargo) {
        $html .= "<li>";
        $html .= $cargo['nome_cargo'];

        if(isset($cargo['subordinados']) && count($cargo['subordinados']) > 0){
           $html .= exibe($cargo['subordinados']);
        }

        $html .= "</li>";
    }

    $html.= '</ul>';
return $html;
}
echo exibe($hierarquia);
?>