@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="error">
        {{ $error }}
    </div>
    @endforeach
@endif
@if (session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif