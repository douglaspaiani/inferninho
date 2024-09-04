<?php

namespace App\Jobs;

use App\Models\Posts;
use App\Repositories\PostRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ProcessPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $PostRepository;
    public $media;

    /**
     * Create a new job instance.
     */
    public function __construct(array $media)
    {
        $this->PostRepository = new PostRepository;
        $this->media = $media;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [
            'user' => $this->media['user'],
            'description' => $this->media['description'] ?? null,
            'photos' => $this->media['photos'] ?? null,
            'video' => $this->media['video'] ?? null
        ];
        $this->PostRepository->setPost($data);
    }
}
