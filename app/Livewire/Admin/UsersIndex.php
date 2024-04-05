<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    
    public $search; //filtrado de busqueda
    public function updatingSearch(){
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $users = User::where('name', 'LIKE','%' . $this->search . '%')
        ->OrWhere('email', 'LIKE','%' . $this->search . '%')
        ->latest('id')
        ->paginate(10);


        return view('livewire.admin.users-index', compact('users'));
    }
}
