window.addEventListener('load', function () {
    document.querySelector('.pre-loader').className += ' hidden';
});
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

$(document).ready(function(){
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.date').mask('00/00/0000');
    $('.card').mask('0000 0000 0000 0000');
    $('.valid').mask('00/00');
    $('.code').mask('000');

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
});