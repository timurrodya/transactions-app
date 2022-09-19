<?php

namespace App\Http\Livewire;

use App\Jobs\SendMessage;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Livewire\Component;
use Livewire\WithPagination;


class UserProfile extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public User $user;

    public $updateUser;
    public $sendMessage;

    protected $rules = [
        'user.name' => 'required|string',
        'user.email' => 'required|email',
        'user.phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }
    public function close()
    {
        $this->updateUser = '';
        $this->sendMessage = '';
    }

    public function edit()
    {
        $this->updateUser = true;
    }

    public function sendMessage()
    {
        $this->sendMessage = true;
    }
    public function sendMessagestore(Request $request)
    {


        SendMessage::dispatch($this->user, $request->message);
        $this->sendMessage = '';
    }
    public function store()
    {
        $this->validate();

        $this->user->save();
        $this->updateUser = '';

        session()->flash('message', 'Пользователь обновлен.');
    }
    public function render()
    {

        $transactions = Transaction::where('user_id', $this->user->id)->orderbydesc('process_date')->paginate(15);
        return view('livewire.user-profile', compact('transactions'));
    }
}
