function AddMessageOther(message){
    if ($('.empty').length){
        $('.message-box').html('<input type="text" id="message-input" placeholder="Escreva sua mensagem..."><button class="snd" type="submit"><i class="fa-regular fa-paper-plane"></i></button>');
    }
    $('#flood').val(0);
    scrollBottom();
    $('#chat-box').append(`<div class="line"><div class="message"><p>${message}</p></div></div>`);
}
function AddMessage(message){
    if ($('.empty').length){
        $('.empty').hide();
    }
    scrollBottom();
      $('#flood').val(parseInt($('#flood').val())+1);
    $('#chat-box').append(`<div class="line my-line"><div class="message me"><p>${message}</p></div></div>`);
}
function AlertError(error){
    $('.message-box').html(`<div class="empty">${error}</div>`);
}
function scrollBottom(){
    $('#chat-box').animate({
        scrollTop: $('#chat-box')[0].scrollHeight 
    }, 100);
}
$(document).ready(function(){
    scrollBottom();
    // Send a message
    $('#chat-form').submit(function(e) {
        e.preventDefault();
        let url = $(location).attr('href');
        let message = $('#message-input').val();

        $.ajax({
            url: url,
            method: "POST",
            data: {
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                message: message
            },
            success: function(response) {
                $('#message-input').val('');
                AddMessage(message);
                if($('#flood').val() == 5){
                    AlertError('Aguarde uma resposta do usuário.');
                }
            }
        });
    });
    setInterval(function() {
        fetch($(location).attr('href')+'/update')
            .then(response => response.json())
            .then(data => {
                data.forEach(function(item, index) {
                    AddMessageOther(item.message);
                });
            })
            .catch(error => console.log('Erro:', error));
    }, 5000); 
});