<?php

namespace App\Observers;

use App\Mail\SendMessage;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TransactionObserver
{
    public $body;
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        $this->body = 'Добавлен платеж';
        Log::critical('Добавлена транзакция #' . $transaction->id . ' на сумму ' . $transaction->sum);
      //  Mail::to('admin@test.ru')->send(new SendMessage($this->body, 'admin@test.ru'));
    }
}
