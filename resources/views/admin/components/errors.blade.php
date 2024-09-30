@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        <p class="mb-0">{{ $error }}</p>
      </div>
    @endforeach
@endif
@if (session('success'))
<div class="alert alert-success" role="alert">
    <p class="mb-0">{{ session('success') }}</p>
  </div>
@endif