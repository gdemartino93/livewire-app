<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $title;
    public $body;
    public $color;
    public $uploadedPhotos = [];
    public $alerts = [
        'created' => ['success', ''],
        'deleted' => ['danger', ''],
        'tempDeleted' => ['danger', '']
    ];

    public function createPost(){
        $this->validate([
            'title' => 'required|min:1|max:10',
            'body' => 'required',
            'uploadedPhotos.*' => 'image|max:1024|nullable'
        ],[
            'body.required' => 'Il testo è obbligatorio',
            'title.required' => 'Il titolo è obbligatorio',
        ]);

        if($this->uploadedPhotos)
        {
            $photoPaths = [];
            foreach($this->uploadedPhotos as $photo){
                $path = $photo -> store('images');  
                $photoPaths[] = $path;
            };
        }

        Post::create([
            'title' => $this->title,
            'body' => $this->body,
            'color' => $this->color,
            'uploadedPhotos' => $photoPaths ?: null
        ]);

        $this->clearForm();
        session()->flash('created', 'Post aggiunto!');
    }

    public function deletePost($id){
        Post::find($id) -> delete();
        session()->flash('deleted', 'Post cancellato!');
    }

    public function removeTempImg($index){
        array_splice($this->uploadedPhotos, $index,1);
        session()->flash('tempDeleted', 'Foto cancellata!');
    }

    public function clearForm(){
        $this->title = '';
        $this->body = '';
        $this->color = null;
        $this->uploadedPhotos = null;   
    }

    public function render()
    {
        return view('livewire.posts',[
            'posts' => Post::paginate(5),
        ]);
    }

    public function getTitleLengthProperty(){
        return strlen($this->title);
    }
}