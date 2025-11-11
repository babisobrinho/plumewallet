<?php

namespace App\Livewire\Guest;

use App\Models\Post;
use App\Models\PostComment;
use App\Enums\PostCategory;
use App\Enums\PostTag;
use Livewire\Component;

class BlogPost extends Component
{
    public Post $post;
    public $newComment = '';

    protected $rules = [
        'newComment' => 'required|string|max:1000',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function submitComment()
    {
        $this->validate();

        PostComment::create([
            'post_id' => $this->post->id,
            'content' => $this->newComment,
            'is_approved' => false, // Comments need approval
        ]);

        $this->reset(['newComment']);
        
        session()->flash('comment-success', __('Your comment has been submitted and is awaiting approval.'));
    }

    public function getRelatedPostsProperty()
    {
        return Post::published()
            ->where('id', '!=', $this->post->id)
            ->where(function ($query) {
                $query->byCategory($this->post->category)
                      ->orWhere(function ($q) {
                          if ($this->post->tags) {
                              foreach ($this->post->tags as $tag) {
                                  $q->orWhereJsonContains('tags', $tag);
                              }
                          }
                      });
            })
            ->with(['author'])
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
    }

    public function getCommentsProperty()
    {
        return $this->post->comments()
            ->where('is_approved', true)
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.guest.blog-post', [
            'relatedPosts' => $this->relatedPosts,
            'comments' => $this->comments,
        ])->layout('layouts.guest');
    }
}
