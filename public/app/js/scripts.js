
window.addEventListener('load', function () {
    document.querySelector('.pre-loader').className += ' hidden';
});
const USER_IMG = "http://localhost:8000/app/users/profile/";
const SEARCH = "http://localhost:8000/app/search/";
const IMAGES = "http://localhost:8000/app/images/";

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
    fetch(`/app/posts/${id}/like`, {
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
    $('.notification .cancel').text('OK');
}

function ConfirmDeleteCard(id){
    fetch(`/app/remove-credit-card/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            $('#card-'+id).fadeOut(600).hide(600);
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
        $('#'+notify).slideToggle(500);
        $('.overlay-notify').fadeToggle(500);
        $('.notification .confirm').attr('data-id', id);
    })
    $('.notification .confirm').click(function(){
        let id = $(this).data('id');
        $(this).text('Processando...');
        ConfirmDeleteCard(id);
    });
    $('.notification .cancel').click(function(){
        $('.notification').slideToggle(500);
        $('.overlay-notify').fadeToggle(500);
    });
    $('.overlay-notify').click(function(){
        $('.notification').slideToggle(500);
        $('.overlay-notify').fadeToggle(500);
    });

    // open search
    $('#Search').click(function(e){
        e.preventDefault();
        $('#SearchBar').fadeToggle(600);
        $('.overlay-search').fadeToggle(600);
        $('#SearchBar input').select();
    });
    $('.overlay-search').click(function(){
        $('#SearchBar').fadeToggle(600);
        $('.overlay-search').fadeToggle(600);
        $('#ResultsSearch').fadeOut(600);
    });
    $('#SearchBar input').on('keyup', function() {
        let search = $(this).val();
        if (search !== '') {
            fetch(SEARCH+`${search}`)
                .then(response => response.json())
                .then(data => {

                    $('#ResultsSearch').html('');
                    $('#ResultsSearch').fadeIn(600);

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
            $('#ResultsSearch').fadeOut(600);
            $('#ResultsSearch').html('');
        }
    });

    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.date').mask('00/00/0000');
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

    $('.imgPost .image').on('dblclick', function() {
        alert('Você clicou duas vezes na imagem!');
    });

    $('#options').click(function(){
        $(".overlay").fadeIn().show();
        $("#options-menu").fadeIn(300).show();
        $('#options-menu').css('z-index', 99999);
    })

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