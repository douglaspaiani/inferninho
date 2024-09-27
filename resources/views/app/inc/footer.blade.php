    <script src="https://kit.fontawesome.com/73683cdf67.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ URL::asset('app/js/scripts.js') }}" crossorigin="anonymous"></script>
    @if (Route::currentRouteName() == 'chat')
    <script src="{{ URL::asset('app/js/chat.js') }}" crossorigin="anonymous"></script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>
</html>