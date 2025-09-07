<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Teacher;
use Livewire\Component;

class Teachers extends Component
{
    //component page
    public $search = ''; // take var from input search >> wire:model.live="search"
 public function render()
    {
        // first idea
// $teachers = Teacher::with(['user', 'subject'])->when($this->search,
//     function ($QuerySearch) {
//     $QuerySearch->whereRelation('user', 'name', 'like', "%{$this->search}%"); })->latest('id')->paginate(7);

    //second idea
// $teachers = Teacher::with(['user', 'subject'])->search($this->search)->latest('id')->paginate(7);

//third idea
$user_id = User::search($this->search)->pluck('id');
$teachers = Teacher::with(['user', 'subject'])->whereIn('user_id', $user_id)->latest('id')->paginate(7);

        return view('admin.livewire.teachers', compact('teachers'));
    }
}
