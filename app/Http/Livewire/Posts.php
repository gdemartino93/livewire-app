<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $title;
    public $body;

    public function createPost(){
        Post::create([
            'title' => $this->title,
            'body' => $this->body,
        ]);
    }
    
    public function render()
    {
        return view('livewire.posts');
    }
}
