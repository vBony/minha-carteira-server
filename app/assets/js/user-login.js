$(document).ready(function(){
    $("#login-area").on("submit", function(event){
        event.preventDefault()
    })

    $(".registrar").on("click", function(){
        let base_url = $("#base_url").val()

        window.location.href = base_url + "user/register"
    })
})
