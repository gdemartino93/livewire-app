<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $title;
    public $body;
    public $color;

    public function createPost(){
        $this->validate([
            'title' => 'required|min:1|max:10',
            'body' => 'required',
        ],[
            'body.required' => 'Il testo è obbligatorio',
            'title.required' => 'Il titolo è obbligatorio'
        ]);
        
        Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'color' => $this->color,
        ]);
        $this->clearForm();
    }

    public function deletePost($id){
        Post::find($id) -> delete();
    }

    public function clearForm(){
        $this->title = '';
        $this->body = '';
        $this->color = null;
    
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
