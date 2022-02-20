@extends('layouts.app')
@section('content')
    <style>
        body,
        p {
            color: #1311a0;
            font: 400 1rem/0.625rem "Open Sans", sans-serif;
        }

        h4 {
            color: #f8f8f8;
            font-weight: 700;
            font-size: 1.5rem;
            line-height: 2rem;
            letter-spacing: -0.2px;
        }

    </style>
    <div class="container">
        @include('alert')

        <div class="d-flex justify-content-between">
            <div>
                <h4>User Manager</h4>
                <br>
            </div>
            <form action="{{ route('users.search') }}" method="GET" class="form-inline my-2 my-lg-0">
                <input name="query" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search</button>
            </form>

        </div>

        <div class="row">
            @foreach ($users as $user)
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

                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->email }}</h5>
                            <br>
                            <hr>
                            <p>{{ $user->name }}</p>
                            <p>{{ $package . ' => ' . ($expired ? date('d M Y', strtotime($expired)) : 'n/a') }}</p>
                            <p>User Status : {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}</p>
                            <p>Bot Status : {{ $user->botstatus ? 'Running' : 'Stop' }}</p>
                            <p>Today : {{ $user->messtoday }}</p>
                            {{-- <p class="card-text">{{ Str::limit($post->body, 100, ' ..dst') }}</p> --}}
                            {{-- <a href="/posts/{{ $post->slug }}" class="card-link">more</a> --}}
                            {{-- <div class="text-secondary">
                                <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
                                &middot; {{ $post->created_at->format('d F, Y') }}
                                &middot;
                                @foreach ($post->tags as $tag)
                                    <a href="/tags/{{ $tag->slug }}">{{ $tag->name }}</a>
                                @endforeach
                            </div> --}}
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('telegrams.edit', $telegramId) }}" class="btn btn-sm btn-success">Edit</a>
                            <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                                action="{{ route('users.destroy', [$user->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            </form>
                            <form onsubmit="return confirm('Plus 1 Month expire date ?')" class="d-inline"
                                action="{{ route('users.upgrade', [$user->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="+1Month" class="btn btn-primary btn-sm">
                            </form>
                            <form onsubmit="return confirm('Plus 7 days ?')" class="d-inline"
                                action="{{ route('users.plus7', [$user->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="+7 days" class="btn btn-secondary btn-sm">
                            </form>
                            <form onsubmit="return confirm('Downgrade to Free ?')" class="d-inline"
                                action="{{ route('users.downgrade', [$user->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="Free" class="btn btn-warning btn-sm">
                            </form>

                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <div>
                {{ $users->links() }}

            </div>
        </div>
    </div>



@endsection
