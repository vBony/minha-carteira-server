$(document).ready(function(){
    $(".login").on("click", function(){
        let base_url = $("#base_url").val()

        window.location.href = base_url + "user/login"
    })
})