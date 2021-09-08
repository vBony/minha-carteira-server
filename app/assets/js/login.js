$(document).ready(function(){
    var url = new URL(window.location.href);
    var email = url.searchParams.get("email");

    if(email != undefined){
        $('input[name=usu_email]').val(email)
    }

    $('.form-control').on('change', function(){
        $(this).removeClass('is-invalid');
    })

    $('#form-login').on('submit', function(event){
        event.preventDefault()

        let baseUrl = $('input[name=base_url]').val()
        let data = $(this).serializeArray()

        $.ajax({
            type: "POST",
            url: baseUrl+"api/login",
            data: data,
            success: function(json){
                if(json.errors != undefined){
                    $('.form-control').removeClass('is-invalid')

                    let errors = json.errors
                    Object.keys(errors).forEach(function(key) {
                        $(`input[name=${key}]`).addClass('is-invalid')
                        $(`#msg_${key}`).text(errors[key])
                    })
                }

                if(json.messages != undefined){
                    if(json.messages == 'success'){
                        window.location.href = baseUrl
                    }
                }
            },
            dataType: 'json'
        });
    })
})