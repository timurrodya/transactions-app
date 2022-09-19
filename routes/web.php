<?php

use App\Http\Livewire\Transaction;
use App\Http\Livewire\Transactions;
use App\Http\Livewire\Users;
use App\Http\Livewire\UserProfile;
use App\Models\User;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Users::class)->name('home');
Route::get('/user/{user}', [UserProfile::class,'__invoke'])->name('user.profile');
Route::get('/transactions', Transactions::class)->name('transactions');
