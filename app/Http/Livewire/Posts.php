<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $title;
    public $body;

    protected $rules=[
        'title' => 'required|min:1|max:10',
        'body' => 'required',
    ];

    public function createPost(){
        $this->validate();
        Post::create([
            'title' => $this->title,
            'body' => $this->body,
        ]);
        $this->clearForm();
    }
    public function clearForm(){
        $this->title = '';
        $this->body = '';
    }

    public function render()
    {
        return view('livewire.posts',[
            'posts' => Post::all()
        ]);
    }
    public function getTitleLengthProperty(){
        return strlen($this->title);
    }
}
