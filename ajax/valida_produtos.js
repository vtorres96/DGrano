$(function ($) {
    $('.formulario').on('submit', function () {

        var formulario = $(this)
        var botao = $('#salvar')
        var mensagem = $('#mensagem')
        botao.button('loading')

        $(this).ajaxSubmit({
            dataType: 'json',
            success: function (retorno) {
                if (retorno.sucesso) {
                    mensagem.attr('class', 'alert alert-success')
                    formulario.resetForm()
                } else {
                    mensagem.attr('class', 'alert alert-danger')
                }
                mensagem.html(retorno.mensagem)
                botao.button('reset')
            },
            error: function () {
                mensagem.attr('class', 'alert alert-danger')
                mensagem.html('Talvez você já tenha adicionado este produto.')
                botao.button('reset')
            }
        })
        return false
    })
})   