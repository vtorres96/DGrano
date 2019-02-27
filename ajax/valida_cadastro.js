$(function ($) {
    $('#formulario_cadastro').on('submit', function () {
        
        var formulario = $(this);
        var botao = $('#salvar_cadastro');
        var mensagem = $('#mensagem_cadastro');
        botao.button('loading');

        $(this).ajaxSubmit({
            dataType: 'json',
            success: function (retorno) {
                if (retorno.sucesso) {
                    mensagem.attr('class', 'alert alert-success');
                    formulario.resetForm();
                } else {
                    mensagem.attr('class', 'alert alert-danger');
                }
                mensagem.html(retorno.mensagem);
                botao.button('reset');
            },
            error: function () {
                mensagem.attr('class', 'alert alert-danger');
                mensagem.html('Oops, ocorreu um erro');
                botao.button('reset');
            }
        });
        return false;
    });
});
