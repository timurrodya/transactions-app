<?php

namespace App\Http\Livewire;

use App\Models\Provider;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\CssSelector\Parser\Reader;

class Transactions extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $filterUser = '';
    public $filterProvider = '';
    public $user_id, $provider_id, $sum, $currency, $process_date, $csv;
    public $createTransaction;
    public $uploadCsv;

    protected $rules = [
        'sum' => 'required|numeric',
        'user_id' => 'numeric',
        'provider_id' => 'required|numeric',
        'currency' => 'required',
        'process_date' => 'required|date',
    ];

    public function mount(Request $request)
    {
        if ($request->query('filterUser')) {
            $this->filterUser = $request->query('filterUser');
        }
        if ($request->query('filterProvider')) {
            $this->filterProvider = $request->query('filterProvider');
        }
    }
    private function resetInputFields()
    {
        $this->sum = '';
        $this->user_id = '';
        $this->provider_id = '';
        $this->process_date = '';
    }
    public function uploadCsv()
    {
        $this->uploadCsv = true;
    }
    public function createTransaction()
    {
        $this->createTransaction = true;
    }
    public function close()
    {
        $this->createTransaction = '';
        $this->uploadCsv = '';
    }
    public function store()
    {
        $this->validate();
        Transaction::create([
            'user_id' => $this->user_id,
            'sum' => $this->sum,
            'provider_id' => $this->provider_id,
            'currency' => $this->currency,
            'process_date' => $this->process_date,
        ]);
        $this->createTransaction = '';
        $this->resetInputFields();
        session()->flash('message', 'Платеж добавлен.');
    }

    public function upload()
    {
        $this->validate([
            'csv'  => 'required',
        ]);
        $path = $this->csv->store('csv');

        $countTransactions = 0;
        if (($handle = fopen(storage_path('app/' . $path), 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ';')) !== false) {
                if ($row[0]) {
                    Transaction::create([
                        'user_id' => $row[0],
                        'provider_id' => $row[1],
                        'sum' => $row[2],
                        'currency' => $row[3],
                        'process_date' => $row[4],
                    ]);
                    $countTransactions++;
                }
            }
            fclose($handle);
        }
        session()->flash('message', 'Загружено ' . $countTransactions . ' строчек');
        $this->uploadCsv = '';
    }

    public function render()
    {

        $transactions = Transaction::query()
            ->when($this->filterUser, function ($query) {
                return $query->where('user_id', $this->filterUser);
            })
            ->when($this->filterProvider, function ($query) {
                return $query->where('provider_id', $this->filterProvider);
            })
            ->with('provider', 'user')->paginate(30);
        $users = User::all();
        $providers = Provider::all();
        return view('livewire.transactions', compact('transactions', 'users', 'providers'));
    }
}
