<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
class Posts extends Component
{
    use WithFileUploads;

    public $title;
    public $body;
    public $color;
    public $photo;

    public function createPost(){
        $this->validate([
            'title' => 'required|min:1|max:10',
            'body' => 'required',
            'photo' => 'image|max:1024'
        ],[
            'body.required' => 'Il testo è obbligatorio',
            'title.required' => 'Il titolo è obbligatorio',
        ]);
        $this->photo -> store('images');
        Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'color' => $this->color,
            'photo' => $this->photo
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
        $this->photo = "";
    
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
