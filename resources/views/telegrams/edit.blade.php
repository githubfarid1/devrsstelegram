@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('alert')
                    <h4 class="card-header">Setting<small class="float-sm-right"> Edit</small></h4>
                     <div class="card-body">
                        <form action="{{ route('telegrams.update', $telegram->id) }}" method="post">
                            @method('patch')
                            @csrf
                            @if (auth()->user()->isAdmin())
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="{{ $telegram->user->email }}" class="form-control">
                                </div>

                            @endif
                            <div class="form-group">
                                <label for="rss">RSS</label>
                                <textarea name="rss" id="rss" cols="30" rows="3" class="form-control @error('rss') is-invalid @enderror">{{ old('rss') ?? $telegram->rss }}</textarea>
                                @error('rss')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="channel">Telegram Channel</label>
                                <input type="text" name="channel" id="channel" value="{{ old('channel') ?? $telegram->channel }}" class="form-control @error('channel') is-invalid @enderror">
                                @error('channel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="botstatus">Bot Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" {{ $botstatus ? 'checked' : '' }} disabled id="botstatus">
                                    <label class="custom-control-label" for="botstatus"><label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary">
                                      <input type="radio" name="options" id="option1" {{ $package == 'premium' ? 'checked' : '' }} disabled> Premium
                                    </label>
                                    <label class="btn btn-secondary">
                                      <input type="radio" name="options" id="option2"  {{ $package == 'free' ? 'checked' : '' }} disabled> Free
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary float-right">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
