<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Comment extends Component
{

    public Model $commentable;
    public bool $showForm=false;
    public string $content=""; //save content of textfield
    public function render()
    {
        return view('livewire.comment',[
            'comments'=>$this->commentable->comments
        ]);
    }

    public function toggle()
    {
        $this->showForm=!$this->showForm;
    }

    public function store()
    {
        //validate data
        $this->validate([
            'content'=>'required|string|max:255'
        ]);
        //insert in database
        $this->commentable->comments()->create([
            'content'=>$this->content,
            'user_id'=>20
        ]);
        //reset values
        $this->reset('content', 'showForm');
    }
}
