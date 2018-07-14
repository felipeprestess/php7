function RemoveAtributo(Campo, Atributo) {
    $('#' + Campo).removeAttr(Atributo);
}
function AdicionaAtributo(Campo, Atributo, Valor) {
    $('#' + Campo).attr(Atributo, Valor);
}