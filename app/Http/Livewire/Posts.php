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
    public $photos = [];

    public function createPost(){
        $this->validate([
            'title' => 'required|min:1|max:10',
            'body' => 'required',
            'photos.*' => 'image|max:1024|nullable'
        ],[
            'body.required' => 'Il testo è obbligatorio',
            'title.required' => 'Il titolo è obbligatorio',
        ]);

        if($this->photos)
        {
            foreach($this->photos as $photo){
               return  $photo -> store('images');  
            };
        }


        Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'color' => $this->color,
            'photos' => $this->photos ?: null
        ]);
        $this->clearForm();
        session()->flash('created', 'Post aggiunto!');
    }

    public function deletePost($id){
        Post::find($id) -> delete();
        session()->flash('deleted', 'Post cancellato!');
    }
    public function removeTempImg($index){

        array_splice($this->photos, $index,1);
        session()->flash('tempDeleted', 'Foto cancellata!');
    }
    public function clearForm(){
        $this->title = '';
        $this->body = '';
        $this->color = null;
        $this->photos = null;
    
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
