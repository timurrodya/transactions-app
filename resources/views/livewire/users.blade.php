<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список пользователей</h1>


    </div>
    <div class="table-responsive">
        <div wire:loading>
            Загрузка...
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">created_at</th>
                    <th scope="col">Сумма платежей за последние 7 дней</th>
                    <th scope="col">Последний платеж (сумма, провайдер)</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr>
                        <td> <a href="{{ route('user.profile', ['user' => $user->id]) }}">{{ $user->id }}</a></td>
                        <td> {{ $user->name }}</td>
                        <td> {{ $user->email }}</td>
                        <td> {{ $user->created_at }}</td>
                        <td> {{ $user->transactions7days_sum_sum }}</td>
                        <td> {{ $user->LastTransaction?->sum }} ({{ $user->LastTransaction?->provider->name }})</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>

</main>
