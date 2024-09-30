$(document).ready(function(){
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.date').mask('00/00/0000');
    $('.card').mask('0000 0000 0000 0000');
    $('.valid').mask('00/00');
    $('.code').mask('000');
    $('.zipcode').mask('00000-000');
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
});