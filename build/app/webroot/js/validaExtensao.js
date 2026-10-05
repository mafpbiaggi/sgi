function validaExtensao(id){

    // Monto um array com as extensões permitidas
    var extensoes = new Array('bmp','jpg','png');

    // Pego a extensão do arquivo colocado no input tipo file
    var ext = $('#'+id).val().split(".")[1].toLowerCase();

    // Faço um loop para verificar se extensao é permitida
    if($.inArray(ext, extensoes) == -1){
        alert("Arquivo não permitido: "+ext);
        $('#'+id).val("").empty();
    }
}

$('#arquivo').on('change', function(){
        validaExtensao('arquivo');
});
