<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    @if (Session::has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Платежи</h1>

        <div class="row">
            <div class="col-md-5">
                <label for="filterUser" class="form-label">Пользователь</label>
                <select wire:model="filterUser" name="filterUser">
                    <option value="">---</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label for="filterProvider" class="form-label">Провайдер</label>
                <select wire:model="filterProvider" name="filterProvider">
                    <option value="">---</option>
                    @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="createTransaction">Добавить
                    платеж</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="uploadCsv">Импорт платежей из csv</button>
            </div>
        </div>

    </div>
    <div class="table-responsive">
        <div wire:loading>
            Загрузка...
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">user.name</th>
                    <th scope="col">sum</th>
                    <th scope="col">currency</th>
                    <th scope="col">provider.name</th>
                    <th scope="col">process_date</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($transactions as $transaction)
                    <tr>
                        <td> {{ $transaction->id }}</td>
                        <td> {{ $transaction->user->name }}</td>
                        <td> {{ $transaction->sum }}</td>
                        <td> {{ $transaction->currency }}</td>
                        <td> {{ $transaction->provider->name }}</td>
                        <td> {{ $transaction->process_date }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $transactions->links() }}
    </div>
    @if ($createTransaction)
        <div class="modal fade show" id="createTransaction" tabindex="-1" aria-labelledby="createTransactionLabel"
            aria-hidden="true" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTransactionLabel">Добавить платеж</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="close"></button>
                    </div>
                    <form wire:submit.prevent="store">
                        <div class="modal-body">
                            <div class="col-12">
                                <label for="user_id" class="form-label">Пользователь</label>
                                <select wire:model.defer="user_id" class="form-control">
                                    <option value="">---</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="provider_id" class="form-label">Провайдер</label>
                                <select wire:model.defer="provider_id" name="provider_id" class="form-control">
                                    <option value="">---</option>
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                                @error('provider_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">

                                <label for="name" class="form-label">Сумма</label>
                                <input wire:model.defer="sum" type="text" class="form-control">
                                @error('sum')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">

                                <label for="name" class="form-label">currency</label>
                                <input wire:model.defer="currency" type="text" class="form-control">
                                @error('currency')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="name" class="form-label">process_date</label>
                                <input wire:model.defer="process_date" type="date" class="form-control">
                                @error('process_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="close">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if ($uploadCsv)
        <div class="modal fade show" id="uploadCsv" tabindex="-1" aria-labelledby="uploadCsvLabel"
            aria-hidden="true" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadCsvLabel">Загрузить CSV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="close"></button>
                    </div>
                    <form wire:submit.prevent="upload">
                        <div class="modal-body">
                            <div class="col-12">
                                <input type="file" wire:model.defer="csv">

                                @error('photo')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="close">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Загрузить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</main>
