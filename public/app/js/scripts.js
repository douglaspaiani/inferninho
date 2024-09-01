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
$(document).ready(function(){
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.date').mask('00/00/0000');
    $('.card').mask('0000 0000 0000 0000');
    $('.valid').mask('00/00');
    $('.code').mask('000');

    $('#btn-add-photo').click(function(){
        $('#photos').click();
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