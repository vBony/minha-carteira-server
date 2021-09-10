$(document).ready(function(){
    $('.form-control').on('change', function(){
        $(this).removeClass('is-invalid');
    })

    $('#form-register').on('submit', function(event){
        event.preventDefault()

        let baseUrl = $('input[name=base_url]').val()
        let data = $(this).serializeArray()
        let email = $('input[name=usu_email]').val()

        $.ajax({
            type: "POST",
            url: baseUrl+"api/criar-conta",
            data: data,
            success: function(json){
                if(json.errors != undefined){
                    $('.form-control').removeClass('is-invalid')

                    let errors = json.errors
                    Object.keys(errors).forEach(function(key) {
                        $(`input[name=${key}]`).addClass('is-invalid')
                        $(`#msg_${key}`).text(errors[key])

                        if(key == 'usu_senha'){
                            $(`input[name=repita_senha`).addClass('is-invalid')
                        }
                    })
                }

                if(json.messages != undefined){
                    if(json.messages == 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: 'Conta cadastrada com sucesso.',
                            showCloseButton: false,
                            allowOutsideClick: false,
                            confirmButtonText: 'Realizar login',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = baseUrl+`login?email=${email}`
                            }
                        })
                    }
                }
            },
            dataType: 'json'
        });
    })
})