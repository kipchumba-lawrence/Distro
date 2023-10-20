<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CreateCategory extends Component
{
    public function render()
    {
        return view('livewire.create-category');
    }
    public function create_category(){
        $category = new Category();
    }
}
