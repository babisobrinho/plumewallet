<?php

namespace App\Livewire\Guest;

use App\Models\Post;
use App\Enums\PostCategory;
use App\Enums\PostTag;
use Livewire\Component;

class BlogPost extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function getRelatedPostsProperty()
    {
        return Post::published()
            ->where('id', '!=', $this->post->id)
            ->where(function ($query) {
                $query->byCategory($this->post->category)
                      ->orWhere(function ($q) {
                          // tags were removed from posts; if tags exist in attributes, ignore
                      });
            })
            ->with(['author'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.guest.blog-post', [
            'relatedPosts' => $this->relatedPosts,
        ])->layout('layouts.guest');
    }
}
