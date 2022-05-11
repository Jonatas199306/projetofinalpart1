const actionOptions = document.querySelectorAll('input[name=action-options]');

const labelImportacao = document.querySelector(`label[for=importacao]`);
const labelConsulta = document.querySelector(`label[for=consulta]`);

const containerImportacao = document.getElementById('container_importacao');
const containerConsulta = document.getElementById('container_consulta');
const arqRetornoInput = document.getElementById('arq_retorno');
const arqRetornoInputLabel = document.querySelector('label[for=arq_retorno]');

actionOptions.forEach(action => {

    action.onchange = changeOption(action.id);
});

function changeOption(id) {

    return function () {

        if (id === 'importacao') {

            labelImportacao.classList.add('btn-secondary');
            labelImportacao.classList.remove('btn-outline-secondary');

            labelConsulta.classList.add('btn-outline-secondary');
            labelConsulta.classList.remove('btn-secondary');

            containerImportacao.classList.remove('d-none');
            containerConsulta.classList.add('d-none');
        } else {

            labelConsulta.classList.add('btn-secondary');
            labelConsulta.classList.remove('btn-outline-secondary');

            labelImportacao.classList.add('btn-outline-secondary');
            labelImportacao.classList.remove('btn-secondary');

            containerImportacao.classList.add('d-none');
            containerConsulta.classList.remove('d-none');
        }
    }
}

arqRetornoInput.onchange = function () {

    const arqRetorno = arqRetornoInput.files[0];

    if (arqRetorno === undefined) return;

    sendFileInRequest(arqRetorno);
};

function sendFileInRequest(arqRetorno) {

    const formData = new FormData();
    formData.append('arq_retorno', arqRetorno);

    arqRetornoInput.setAttribute('disabled', '');

    // arqRetornoInputLabel.classList.add('disabled');
    arqRetornoInputLabel.innerHTML = `<i class="bx bx-loader spin"></i> Processando arquivo...`;


    $.ajax({
        method: 'POST',
        url: '/retorno/importar',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

            arqRetornoInput.removeAttribute('disabled');

            // arqRetornoInputLabel.classList.remove('disabled');
            arqRetornoInputLabel.innerHTML = `<i class="bx bx-file"></i> Selecionar arquivo`;
        }
    });
}

