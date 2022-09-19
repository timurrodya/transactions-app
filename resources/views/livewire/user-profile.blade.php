<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    @if (Session::has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Пользователь {{ $user->name }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="edit">Редактировать</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="sendMessage">Отправить
                    сообщение</button>
                <a type="button" href="/transactions?filterUser={{ $user->id }}"
                    class="btn btn-sm btn-outline-secondary">Фильтр платежей</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 bg-body">
            <h4>Основная информация</h4>
            <table class="table table-striped table-sm">
                <tbody>
                    <tr>
                        <td>Имя</td>
                        <td>{{ $user->name }}</td>
                        </td>
                    <tr>
                        <td>email</td>
                        <td>{{ $user->email }}</td>
                        </td>
                    <tr>
                        <td>phone</td>
                        <td>{{ $user->phone }}</td>
                        </td>
                    <tr>
                        <td>created_at</td>
                        <td>{{ $user->created_at }}</td>
                        </td>

                </tbody>
            </table>
        </div>

        <div class="table-responsive col-md-9">
            <div wire:loading>
                Загрузка...
            </div>
            <h4>Платежи</h4>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">sum</th>
                        <th scope="col">currency</th>
                        <th scope="col">process_date</th>
                        <th scope="col">provider</th>


                    </tr>
                </thead>
                <tbody>

                    @foreach ($transactions as $transaction)
                        <tr>

                            <td>{{ $transaction->sum }}</td>
                            <td>{{ $transaction->currency }}</td>
                            <td> {{ $transaction->process_date }}</td>
                            <td> {{ $transaction->provider?->name }}</td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $transactions->links() }}
        </div>
    </div>
    @if ($sendMessage)
        <div class="modal fade show" id="sendMessage" tabindex="-1" aria-labelledby="sendMessageLabel"
            aria-hidden="true" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sendMessageLabel">Отправить сообщение</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="close"></button>
                    </div>
                    <form wire:submit.prevent="sendMessagestore">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="message-text" name="message" class="col-form-label">Сообщение:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                wire:click="close">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if ($updateUser)
        <div class="modal fade show" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true"
            style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserLabel">Редактировать пользователя</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="close"></button>
                    </div>
                    <form wire:submit.prevent="store">
                        <div class="modal-body">
                            <div class="col-12">
                                <label for="name" class="form-label">Имя</label>
                                <input wire:model.defer="user.name" type="text" class="form-control">
                                @error('user.name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">email</label>
                                <input wire:model.defer="user.email" type="text" class="form-control">
                                @error('user.email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="phone" class="form-label">phone</label>
                                <input wire:model.defer="user.phone" type="text" class="form-control">
                                @error('user.phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="close">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Обновить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</main>
