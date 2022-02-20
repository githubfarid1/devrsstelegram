@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>User Manager</h3>
        @include('alert')
        <table class="table table-striped table-inverse" style="color:black; background-color: yellow;">
            <thead class="thead-inverse">
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Package</th>
                    <th>Expired</th>
                    <th><b>Action</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        @php
                            $package = $user
                                ->histories()
                                ->latest()
                                ->limit(1)
                                ->get()
                                ->toArray()[0]['package'];
                            $expired = $user
                                ->histories()
                                ->latest()
                                ->limit(1)
                                ->get()
                                ->toArray()[0]['expired_at'];

                            $telegramId = $user->telegram->id;
                        @endphp
                        <td scope="row">{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $package }}</td>
                        <td>{{ $expired ? date('d M Y', strtotime($expired)) : 'n/a' }}</td>
                        <td>
                            <a href="{{ route('telegrams.edit', $telegramId) }}" class="btn btn-success btn-sm">Edit</a>

                            <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                                action="{{ route('users.destroy', [$user->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            </form>

                            <form
                                onsubmit="return confirm('{{ $package == 'free' ? 'Upgrade to Premium?' : 'Downgrade to Free' }}')"
                                class="d-inline" action="{{ route('users.process', [$user->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="{{ $package == 'free' ? 'Upgrade' : 'Downgrade' }}"
                                    class="btn btn-{{ $package == 'free' ? 'primary' : 'warning' }} btn-sm">
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-4 offset-5">
                {{ $users->links() }}
            </div>
        </div>

    </div>
@endsection
