<?php

namespace App\Livewire;

use Livewire\Component;

class UpdateCategory extends Component
{
    public $categoryId;
    public $check=2;
    public function render()
    {
        return view('livewire.update-category');
    }
}
