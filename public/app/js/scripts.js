
window.addEventListener('load', function () {
    document.querySelector('.pre-loader').className += ' hidden';
});
const USER_IMG = "http://localhost:8000/app/users/profile/";
const SEARCH = "http://localhost:8000/app/search/";
const IMAGES = "http://localhost:8000/app/images/";
const APP_URL = "http://localhost:8000/app";
const BASE_URL = "http://localhost:8000/";

function openMenu(){
    // Open menu
    $(".overlay").fadeIn().show();
    $(".Header .Menu").fadeIn(300).show();
    $(this).css('z-index', 9999);

}
function closeMenu(){
    // Close menu
    $(".Header .Menu").fadeOut(300).hide(300);
    $("#options-menu").fadeOut(300).hide(300);
    $(this).fadeOut(300).hide(300);
    $(".Header .mainMenu").css('z-index', 0);
    $(".overlay").fadeOut().hide(300);
}

function transformUsername() {
    let input = document.getElementById('username');
    let value = input.value;
    value = value.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    value = value.replace(/[\s.,]+/g, '-').toLowerCase();
    value = value.replace(/[^a-z0-9\-]/g, '');
    input.value = value;
}

function likePost(id, likes) {
    fetch(APP_URL+`/posts/${id}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            var att = likes+1;
            $('#like-'+id+' span').text(att);
            $('#like-'+id).attr('disabled', 'disabled');
            $('#like-'+id+' i').removeClass('fa-regular');
            $('#like-'+id+' i').addClass('fa-solid');
            $('#like-'+id+'').addClass('liked');
        });
}

function successNotify(text){
    $('.notification h4').text(text);
    $('.notification .confirm').hide();
    $('.notification .content').hide();
    $('.notification .cancel').text('OK');
}

function ConfirmEditComment(id, comment){
    let data = {
        comment: comment
    };
    fetch(APP_URL+`/edit-comment/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            },
        body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            $('#comment-'+id+' .txt').text(comment);
            successNotify('Seu comentário foi editado!');
        });
}

function ConfirmDeletePost(id){
    fetch(APP_URL+`/delete-post/${id}`)
        .then(response => response.json())
        .then(data => {
            $('.post-'+id+'').fadeOut(400);
            successNotify('Sua postagem foi apagada com sucesso!');
        });
}

function ConfirmDeleteCard(id){
    fetch(APP_URL+`/remove-credit-card/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            $('#card-'+id).fadeOut(400).hide(400);
            successNotify('Cartão de crédito removido com sucesso!');
        });
}

$(document).ready(function(){
    // open notification
    $('.openNotify').click(function(e){
        e.preventDefault();
        let notify = $(this).data('notify');
        let id = $(this).data('id');
        $('#'+notify).css('bottom', 0);
        $('#'+notify).slideToggle(400);
        $('.overlay-notify').fadeToggle(400);
        $('.Menu').fadeOut(400);
        $('.overlay').fadeOut(400);
        $('.notification .confirm').attr('data-id', id);
    })
    $('.notification .confirm').click(function(){
        let id = $(this).data('id');
        $(this).text('Processando...');
        ConfirmDeleteCard(id);
    });
    $('.notification .cancel').click(function(){
        $('.notification').slideToggle(400);
        $('.overlay-notify').fadeToggle(400);
    });
    $('.overlay-notify').click(function(){
        $('.notification').slideToggle(400);
        $('.overlay-notify').fadeToggle(400);
    });

    // open search
    $('#Search').click(function(e){
        e.preventDefault();
        $('#SearchBar').fadeToggle(400);
        $('.overlay-search').fadeToggle(400);
        $('#SearchBar input').select();
    });
    $('.overlay-search').click(function(){
        $('#SearchBar').fadeToggle(400);
        $('.overlay-search').fadeToggle(400);
        $('#ResultsSearch').fadeOut(400);
    });
    $('.overlay').click(function(){
        $('.Menu').fadeOut(400);
        $('#BoxNotifications').fadeOut(400);
    });
    $('.option-menu .edit').click(function(){
        let id = $(this).data('id');
        let comment = $('#comment-'+id+' .txt').text();
        $('#EditComment textarea').val(comment);
        $('#EditComment textarea').select();
    });
    $('#message').on('input', function() {
        let maxChars = 255;
        let currentLength = $(this).val().length;
        let remaining = maxChars - currentLength;
        $('#charCount').text(remaining + ' caracteres restantes');
        if (currentLength >= maxChars) {
            $(this).val($(this).val().substr(0, maxChars));
            $('#charCount').text('0 caracteres restantes');
        }
    });
    $('#SearchBar input').on('keyup', function() {
        let search = $(this).val();
        if (search !== '') {
            fetch(SEARCH+`${search}`)
                .then(response => response.json())
                .then(data => {

                    $('#ResultsSearch').html('');
                    $('#ResultsSearch').fadeIn(400);

                    if (data.length > 0) {
                        data.forEach(function(item) {
                            let top = "";
                            let verify = "";
                            let photo = item.photo;
                            let username = "---";
                            if(item.top == 1){
                                top = '<i class="king fa-solid fa-crown" aria-hidden="true"></i>';
                            }
                            if(item.verify == 1){
                                verify = '<i class="verify fa-solid fa-circle-check" aria-hidden="true"></i>';
                            }
                            if(!photo){
                                photo = IMAGES+"user-default.jpg";
                            } else {
                                photo = USER_IMG+photo;
                            }
                            if(item.username){
                                username = "@"+item.username;
                            }
                            $('#ResultsSearch').append('<a href="/'+item.username+'"><div class="user"><span class="img" style="background-image:url('+photo+')"></span><div class="infos"><p>' + item.name + ' '+verify+' '+top+'</p><sub>'+username+'</sub></div></div></a>');
                        });
                    } else {
                        $('#ResultsSearch').html('<p class="none">Nenhum criador encontrado.</p>');
                    }
                })
                .catch(error => console.log('Erro:', error));
        } else {
            $('#ResultsSearch').fadeOut(400);
            $('#ResultsSearch').html('');
        }
    });

    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.date').mask('00/00/0000');
    $('.phone').mask('(00) 00000-0000');
    $('.card').mask('0000 0000 0000 0000');
    $('.valid').mask('00/00');
    $('.code').mask('000');
    $('.zipcode').mask('00000-000');
    $('.money').mask('000.000.000.000.000,00', {reverse: true});

    $('#btn-add-photo').click(function(){
        $('#photos').click();
    });
    $('#btn-upload-profile').click(function(){
        $('#upload-photo').click();
    });
    $('.pageLogin .btn-loading').click(function(){
        $('.btn-loading button span').text('Entrando...');
    });
    $('.pageRegister .btn-loading').click(function(){
        $('.btn-loading button span').text('Regitrando...');
    });
    $('.page .btn-loading').click(function(){
        $('.btn-loading button span').text('Salvando...');
    });

    $('.newPost .send').click(function(){
        $('.newPost .send span').text('Postando...');
    });

    $('.comment .btn-loading').click(function(){
        $('.btn-loading button span').text('Publicando...');
    });

    $('.imgPost .image').on('dblclick', function() {
        alert('Você clicou duas vezes na imagem!');
    });
    $('.opcional-posting button').click(function(){
        $(this).toggleClass('active');
    });
    $('#schedule-button').click(function(){
        $('input[name=schedule]').val('');
        $('#tab-schedule').toggle(300);
    });
    $('#monetize-button').click(function(){
        $('input[name=value]').val('');
        $('#tab-monetize').toggle(300);
    });
    $('#announce-button').click(function(){
        $('input[name=announce]').prop('checked', false);
        $('#tab-announce').toggle(300);
        $('#24h-button').fadeToggle(0);
        $('input[name=24h]').val(0);
    });
    $('#nocomments-button').click(function(){
        if($('input[name=nocomments]').val() == 1){
            $('input[name=nocomments]').val(0);
        } else {
            $('input[name=nocomments]').val(1);
        }
    });
    $('#24h-button').click(function(){
        $('#announce-button').fadeToggle(0);
        $('input[name=announce]').prop('checked', false);
        if($('input[name=24h]').val() == 1){
            $('input[name=24h]').val(0);
        } else {
            $('input[name=24h]').val(1);
        }
    });

    $('.Notifications').click(function(e){
        e.preventDefault();
        $('#BoxNotifications').fadeIn(400);
        $('.overlay').fadeIn(400);
    });

    $('#options').click(function(){
        $(".overlay").fadeIn().show();
        $("#options-menu").fadeIn(300).show();
        $('#options-menu').css('z-index', 99999);
    });

    $('.comments .options').click(function(){
        let id = $(this).data('id');
        $(".overlay").fadeIn().show();
        $(".Menu[data-id="+id+"]").fadeIn(300).show();
        $(".Menu[data-id="+id+"]").css('z-index', 99999);
    });
    $('.options-post').click(function(){
        let id = $(this).data('id');
        $(".overlay").fadeIn().show();
        $(".menu-post[data-id="+id+"]").fadeIn(300).show();
        $(".menu-post[data-id="+id+"]").css('z-index', 99999);
    });
    $('#EditComment .confirm').click(function(){
        let id = $(this).data('id');
        let comment = $('#EditComment textarea').val();
        ConfirmEditComment(id, comment);
    });
    $('#DeletePost .confirm').click(function(){
        let id = $(this).data('id');
        let comment = $('#EditComment textarea').val();
        ConfirmDeletePost(id);
    });
    $('#options-comment .delete').click(function(e){
        e.preventDefault();
        let id = $(this).data('id');
        fetch(APP_URL+`/delete-comment/${id}`)
                .then(response => response.json())
                .then(data => {
                    let comments = $('.button-comment span').text() - 1;
                    $('.button-comment span').text(comments);
                    $('#comment-'+id).fadeOut(400);
                })
                .catch(error => console.log('Erro:', error));
    });
    $('.Menu a').click(function(){
        $('.overlay').fadeOut(400);
    });
    $('#btn-pix').click(function(){
        $('.subscribe .payment button').css('background-color', '#4b4b4b');
        $(this).css('background-color', '#CE5656');
        $('#method-pix').show();
        $('#method-card').hide();
    });
    $('input[name="plan"]').click(function(){
        $('.value-card').text($('label[for='+$('input[name="plan"]:checked').attr('id')+'] b').text());
    });
    $('#btn-card').click(function(){
        $('.subscribe .payment button').css('background-color', '#4b4b4b');
        $('.value-card').text($('label[for='+$('input[name="plan"]:checked').attr('id')+'] b').text());
        $(this).css('background-color', '#CE5656');
        $('#method-pix').hide();
        $('#method-card').show();
    });

    $('#valuegift').on('input', function() {
        let inputValue = $(this).val(); // Get the value of the input
        $('sup').text('R$ '+inputValue);
    });

    $('.payment .btn').click(function(){
        let valueVerify = parseFloat($('input[name="value"]').val().replace(/[^\d,.-]/g, '').replace(',', '.'));
        if(valueVerify < 10 || isNaN(valueVerify)){
            $('#error-value').fadeIn(100);
            $('input[name="value"]').val('10,00');
            $('sup').text('R$ 10,00');
        }
    });

    $('#PaymentPix').click(function(){
        $('.error').fadeOut();
        $('input[name="plan"]').attr('disabled', true);
        $('#PaymentPix span').text('Gerando PIX de pagamento...');
        let username = $('input[name="username"]').val();
        fetch(APP_URL+`/${username}/payment-subscription`, {
            method: 'POST',
            body: JSON.stringify({
                'method': 'PIX',
                'plan': $('input[name="plan"]:checked').val()
            }),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.error){
                    $('#payment-error').fadeIn(100);
                    $('#payment-error').text(data.error);
                } else {
                    $('.qrcode').attr('src', 'data:image/png;base64,'+data.qrcode);
                    $('.codepix').val(data.payload);
                    $('.value').text(data.value);
                    $(this).fadeOut(100);
                    $('.return-pix').fadeIn(200);
                }

            });
    });
    $('#PaymentPixPhoto').click(function(){
        $('.error').fadeOut();
        $('#PaymentPixPhoto span').text('Gerando PIX de pagamento...');
        let username = $('input[name="username"]').val();
        let photo = $('input[name="photo"]').val();
        fetch(APP_URL+`/${username}/payment-photo/${photo}`, {
            method: 'POST',
            body: JSON.stringify({
                'method': 'PIX',
                'photo': photo
            }),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.error){
                    $('#payment-error').fadeIn(100);
                    $('#payment-error').text(data.error);
                } else {
                    $('.qrcode').attr('src', 'data:image/png;base64,'+data.qrcode);
                    $('.codepix').val(data.payload);
                    $(this).fadeOut(100);
                    $('.return-pix').fadeIn(200);
                }

            });
    });
    $('#PaymentPixGift').click(function(){
        $('.error').fadeOut();
        $('#PaymentPixGift span').text('Gerando PIX de pagamento...');
        let username = $('input[name="username"]').val();
        let photo = $('input[name="photo"]').val();
        let value = $('input[name="value"]').val();
        let message = $('#message').val();
        let private = 0;
        if($('#private').is(':checked')){
            private = 1;
        }
        fetch(APP_URL+`/${username}/payment-gift/${photo}`, {
            method: 'POST',
            body: JSON.stringify({
                'method': 'PIX',
                'photo': photo,
                'value': value,
                'private': private,
                'message': message
            }),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.error){
                    $('#payment-error').fadeIn(100);
                    $('#payment-error').text(data.error);
                } else {
                    $('input[name="value"]').attr('disabled', true);
                    $('#message').attr('disabled', true);
                    $('.qrcode').attr('src', 'data:image/png;base64,'+data.qrcode);
                    $('.codepix').val(data.payload);
                    $(this).fadeOut(100);
                    $('.return-pix').fadeIn(200);
                }

            });
    });
    $('#PaymentCard').click(function(){
        $('.error').fadeOut();
        $('input[name="plan"]').attr('disabled', true);
        $('#PaymentCard span').text('Finalizando pagamento...');
        let username = $('input[name="username"]').val();
        fetch(APP_URL+`/${username}/payment-subscription`, {
            method: 'POST',
            body: JSON.stringify({
                'method': 'CREDIT_CARD',
                'plan': $('input[name="plan"]:checked').val(),
                'card': $('#cards').val()
            }),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.error){
                    $('#payment-error').fadeIn(100);
                    $('#payment-error').text(data.error);
                    $('#PaymentCard span').text('Finalizar pagamento');
                } else {
                    if(data.status == 'CONFIRMED'){
                        $('#card-success').fadeIn(300);
                        $('.payment .btn').fadeOut(300);
                    }
                    $('.return-card').fadeOut(100);
                    $('.form-card label').fadeOut(100);
                    $('#cards').fadeOut(100);
                    $(this).fadeOut(100);
                }

            });
    });

    $('#PaymentCardPhoto').click(function(){
        $('.error').fadeOut();
        $('#PaymentCardPhoto span').text('Finalizando pagamento...');
        let username = $('input[name="username"]').val();
        let photo = $('input[name="photo"]').val();
        fetch(APP_URL+`/${username}/payment-photo/${photo}`, {
            method: 'POST',
            body: JSON.stringify({
                'method': 'CREDIT_CARD',
                'card': $('#cards').val(),
                'photo': photo
            }),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.error){
                    $('#payment-error').fadeIn(100);
                    $('#payment-error').text(data.error);
                    $('#PaymentCardPhoto span').text('Finalizar pagamento');
                } else {
                    if(data.status == 'CONFIRMED'){
                        $('#card-success').fadeIn(300);
                        $('.payment .btn').fadeOut(300);
                    }
                    $('.return-card').fadeOut(100);
                    $('.form-card label').fadeOut(100);
                    $('#cards').fadeOut(100);
                    $(this).fadeOut(100);
                }

            });
    });

    $('#PaymentCardGift').click(function(){
        $('.error').fadeOut();
        $('#PaymentCardGift span').text('Finalizando pagamento...');
        let username = $('input[name="username"]').val();
        let photo = $('input[name="photo"]').val();
        let value = $('input[name="value"]').val();
        let message = $('#message').val();
        let private = 0;
        if($('#private').is(':checked')){
            private = 1;
        }
        fetch(APP_URL+`/${username}/payment-gift/${photo}`, {
            method: 'POST',
            body: JSON.stringify({
                'method': 'CREDIT_CARD',
                'card': $('#cards').val(),
                'photo': photo,
                'value': value,
                'private': private,
                'message': message
            }),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.error){
                    $('#payment-error').fadeIn(100);
                    $('#payment-error').text(data.error);
                    $('#PaymentCardGift span').text('Finalizar pagamento');
                } else {
                    if(data.status == 'CONFIRMED'){
                        $('#card-success').fadeIn(300);
                        $('.payment .btn').fadeOut(300);
                    }
                    $('input[name="value"]').attr('disabled', true);
                    $('#message').attr('disabled', true);
                    $('.return-card').fadeOut(100);
                    $('.form-card label').fadeOut(100);
                    $('#cards').fadeOut(100);
                    $(this).fadeOut(100);
                }

            });
    });

    $('#upload-photo').change(function(event){
        const file = event.target.files[0]; 
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imageSpan = document.getElementById('photo-profile');
                    imageSpan.style.backgroundImage = `url(${e.target.result})`; // Define a imagem como background
                }

                reader.readAsDataURL(file); 
            }
    });

    $('#photos').change(function(event){
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = ''; // Limpa a pré-visualização anterior

        const files = event.target.files;

        if (files) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.style.maxWidth = '100px'; // Ajuste o tamanho da imagem conforme necessário
                    imgElement.style.margin = '10px';
                    imagePreview.appendChild(imgElement);
                };

                reader.readAsDataURL(file);
            });
        }

    });
    document.getElementById('zipcode').addEventListener('blur', function() {
        let cep = this.value.replace(/\D/g, '');
        if (cep.length === 8) {
            let url = `https://viacep.com.br/ws/${cep}/json/`;
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('CEP não encontrado');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.erro) {
                        alert('CEP inválido ou não encontrado');
                        return;
                    }
                    document.getElementById('address').value = data.logradouro;
                    document.getElementById('neighborhood').value = data.bairro;
                    document.getElementById('city').value = data.localidade;
                    document.getElementById('state').value = data.uf;
                });
        } else {
            alert('CEP inválido. Digite um CEP válido.');
        }
    });
});