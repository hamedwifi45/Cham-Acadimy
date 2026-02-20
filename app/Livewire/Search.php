<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Post;
use Livewire\Component;

class Search extends Component
{
    public $query;

    public $courses = [];

    public $posts = [];

    public function updatedquery()
    {
        if (strlen($this->query) > 2) {
            $this->courses = Course::where('name_ar', 'like', '%'.$this->query.'%')
                ->orWhere('name_en', 'like', '%'.$this->query.'%')
                ->orWhere('description_ar', 'like', '%'.$this->query.'%')
                ->orWhere('description_en', 'like', '%'.$this->query.'%')
                ->limit(5)
                ->get();
            $this->posts = Post::where('title', 'like', '%'.$this->query.'%')
                ->orWhere('body', 'like', '%'.$this->query.'%')
                ->limit(3)
                ->get();

        } else {
            $this->posts = [];
            $this->courses = [];
        }

    }

    public function render()
    {
        return view('livewire.search');
    }
}
