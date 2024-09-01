<div class="Post" id="app">
    <div class="UserLine">
        <div class="img">
            <a href="#"><img src="{{ $photo }}" alt="{{ $name }}"/></a>
        </div>
        <div class="user">
            <a href="#"><span>{{ $name }}
                @if($verify == 1)
                <i class="verify fa-solid fa-circle-check"></i>
                @endif
                @if($top == 1)
                <i class="king fa-solid fa-crown"></i>
                @endif
            </span></a>
            
            <a href="#"><i>{{ $user }}</i></a>
        </div>
    </div>
    <div class="posting">
        <div class="description">
            {{ $description }}
        </div>
        <div class="imgPost">
            @if(!empty($image))
                @foreach ($images as $photo)
                    <span class="image" style="background-image: url('{{ $photo_url }}{{ $photo }}')"></span>
                @endforeach
            @endif
        </div>
        <div class="infos">
            <post-like :initial-likes="{{ $likes }}" post-id="{{ $id }}"></post-like>
            <a href="#" class="button-like"><i class="fa-solid fa-dollar-sign"></i> <span>Enviar um mimo</span></a>
        </div>
    </div>
</div>

<script>
    const { createApp } = Vue;

createApp({
    components: {
        'post-like': {
            props: ['initialLikes', 'postId'],
            data() {
                return {
                    likes: this.initialLikes,
                };
            },
            methods: {
                likePost() {
                    fetch(`/app/posts/${this.postId}/like`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        var att = this.likes+1;
                        $('.like span').text(att);
                        $('.like').attr('disabled', 'disabled');
                        $('.like i').removeClass('fa-regular');
                        $('.like i').addClass('fa-solid');
                        $('.like').addClass('liked');
                    });
                },
            },
            template: `
                    <button type="button" class="like button-like" @click="likePost">
                        <i class="fa-regular fa-heart"></i> <span>{{ $likes }}</span>
                    </button>
            `
        }
    }
}).mount('#app');
</script>
