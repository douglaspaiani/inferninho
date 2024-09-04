function openMenu(){
    // Open menu
        $(".overlay").fadeIn().show();
        $(".Header .Menu").fadeIn(300).show();
        $(this).css('z-index', 9999);

}
function closeMenu(){
    // Close menu
    $(".overlay").click(function(){
        $(".Header .Menu").fadeOut(300).hide(300);
        $(this).fadeOut(300).hide(300);
        $(".Header .mainMenu").css('z-index', 0);
    });
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