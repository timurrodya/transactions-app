<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


class Users extends Component
{
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public function render()
  {


    $users = User::with('LastTransaction')->withSum('transactions7days', 'sum')->paginate(10);
    return view('livewire.users', compact('users'));
  }
}
