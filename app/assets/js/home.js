$(document).ready(function(){
    let baseUrl = $('input[name=base_url]').val()
    $('#datePicker').mask('00/0000')

    $('#form-receita :input').on('change', function(){
        $(this).removeClass('is-invalid')
    })

    $(".money-input").mask('000.000.000.000.000,00', {reverse: true});

    $('.selectMesAno').on('click', function(){
        let mesano = $(this).data('mesano')
        window.location.href = `${baseUrl}?mesano=${mesano}`
    })

    $('#proxMes').on('click', function(){
        let mesano = $(this).data('mesano')
        window.location.href = `${baseUrl}?mesano=${mesano}`
    })

    $('#btn-modal-receita').on('click', function(){
        resetInputs('form-receita')
        const id_tipo = 2;

        let dataAtual = getDataAtual()
        console.log(dataAtual);
        $('#data_recebimento').val(dataAtual)

        populateDropdown(id_tipo)
    })

    $('#salvar-receita').on('click', function(){
        $("#form-receita").submit()
    })

    $("#form-receita").on('submit', function(event){
        event.preventDefault()
        const id_tipo = 2;
        $('#form-receita input[name=tra_tipo]').val(id_tipo)

        let data = $(this).serializeArray()

        $.ajax({
            type: "POST",
            url: baseUrl+"api/inserir-receita",
            data: data,
            success: function(json){
                if(json.errors != undefined){
                    $(`#form-receita :input`).removeClass('is-invalid')

                    let errors = json.errors
                    Object.keys(errors).forEach(function(key) {
                        $(`:input[name=${key}]`).addClass('is-invalid')
                        $(`#msg_${key}`).text(errors[key])
                    })
                }

                if(json.messages != undefined){
                    if(json.messages == 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: 'Transação criada com sucesso.',
                            showCloseButton: false,
                            allowOutsideClick: false,
                            confirmButtonText: 'Fechar',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload()
                            }
                        })
                    }
                }
            },
            dataType: 'json'
        });
    })

    function getDataAtual(){
        data = new Date()

        var dia = String(data.getDate()).padStart(2, '0');
        var mes = String(data.getMonth() + 1).padStart(2, '0');
        var ano = data.getFullYear();

        return `${ano}-${mes}-${dia}`
    }

    function populateDropdown(idtipo){
        $.ajax({
            url: `${baseUrl}/home/categorias`,
            dataType: 'json',
            method: 'POST',
            data: {tipo: idtipo},
            success: function(response){
                if(response.categorias){
                    let categorias = response.categorias

                    $dropdown = $('#tags')
                    $dropdown.empty()
                    $dropdown.append($("<option />").val('').text("Selecione").attr('selected', 'selected'));
                    
                    $.each(categorias, function() {
                        $dropdown.append($("<option />").val(this.cat_id).text(this.cat_descricao));
                    });

                    $dropdown.append($("<option />").val('new').text("Criar nova categoria"));
                }
            }
        })
    }

    function resetInputs(formName){
        $(`#${formName} :input`).removeClass('is-invalid')
        $(`#${formName} :input`).val('').prop('checked', false);
    }
})