$(document).ready(function(){
    $('#form-register').on('submit', function(event){
        event.preventDefault()

        let baseUrl = $('input[name=base_url]').val()
        let data = $(this).serializeArray()

        $.ajax({
            type: "POST",
            url: baseUrl+"/user/register",
            data: data,
            success: function(data){
                console.log(data);
            },
            dataType: 'json'
        });
    })
})