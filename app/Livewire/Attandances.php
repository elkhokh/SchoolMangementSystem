<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Classes;
use Livewire\Component;
use App\Models\Students;

class Attandances extends Component
{
    //component page
    public $search = ''; // take var from input search >> wire:model.live="search"
 public function render()
    {

 $classes = Classes::with(['students.user'])
            ->when($this->search, function ($query) {
                $query->whereHas('students.user', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%");
                });
            })
              ->paginate(7); ;

        return view('livewire.attandances', compact('classes'));
    }
}
