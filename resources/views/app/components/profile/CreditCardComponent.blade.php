<div class="Cards">
    <div id="card-{{ $id }}" class="Card">
        <span class="brand" style="background-image: url('{{ URL::asset('app/images/brands/'.$brand.'.jpg') }}')"></span>
        <p class="number">**** **** **** {{ $final }}</p>
        <p class="validate"><span>Validade</span>{{ $valid }}</p>
        <a href="#" data-id="{{ $id }}" data-notify="RemoveCard" class="RemoveCard openNotify"><i class="fa-regular fa-trash-can"></i> Remover</a>
    </div>
</div>