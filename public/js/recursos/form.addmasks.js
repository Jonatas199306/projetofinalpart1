function addMasks() {
    // se existirem na página, aplciar máscara
    $("#cnpj").length && $("#cnpj").mask("99.999.999/9999-99");
    $("#cpf").length && $("#cpf").mask("999.999.999-99");
    $('#favorecido_cnpj').length && $('#favorecido_cnpj').mask("99.999.999/9999-99");

    // máscara telefone (carregamento da pagina)
    if($('#telefone').length) {

        $('#telefone').mask($('#telefone').val().length == 11 ? '(99)99999-999?9' : '(99)9999-9999?9');

        $('#telefone').focusout(function(event) {

            $(this).unmask();
            let phone = $(this).val().replace(/\D/g, '');
            if(phone.length > 10) {

                $('#telefone').mask("(99)99999-999?9");
            } else {

                $('#telefone').mask("(99)9999-9999?9");
            }
        });
    }

    if($('#celular').length) {

        $('#celular').mask($('#celular').val().length == 11 ? '(99)99999-999?9' : '(99)9999-9999?9');

        $('#celular').focusout(function(event) {

            $(this).unmask();
            let phone = $(this).val().replace(/\D/g, '');
            if(phone.length > 10) {

                $('#celular').mask("(99)99999-999?9");
            } else {

                $('#celular').mask("(99)9999-9999?9");
            }
        });
    }

}
