<?php

namespace App\Http\Livewire;
use App\Models\Myparent;

use Livewire\Component;

class ShowParents extends Component
{

     public function render()
    {
        $parents = Myparent::all();
        return view('livewire.show-parents',['parents' => $parents]);
    }
}
