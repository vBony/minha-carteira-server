$(document).ready(function(){
    let baseUrl = $('input[name=base_url]').val()
    $('#datePicker').mask('00/0000')

    $(".money-input").mask('000.000.000.000.000,00', {reverse: true});

    $('.selectMesAno').on('click', function(){
        let mesano = $(this).data('mesano')
        window.location.href = `${baseUrl}?mesano=${mesano}`
    })

    $('#proxMes').on('click', function(){
        let mesano = $(this).data('mesano')
        window.location.href = `${baseUrl}?mesano=${mesano}`
    })
})