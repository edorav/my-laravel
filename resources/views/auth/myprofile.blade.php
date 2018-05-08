@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                  
                    <div class="form-group row">
                        <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input type="text" readonly class="form-control-plaintext" value="{{ Auth::user()->email }}">

                            @if ($errors->has('firstname'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    

                    
                    

                    <form method="POST" action="{{ route('edit-profile') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ Auth::user()->firstname }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ Auth::user()->lastname }}" required >

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                            <div class="col-md-6">
                                @if (Auth::user()->picture != '')
                                <img src="/storage/{{ Auth::user()->picture }}"  >
                                @else
                                <img src="/storage/default.png"  >
                                @endif
                                <input type="file" name="picture" />
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-default">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Agencies</div>

                <div class="card-body">
                    <ol>
                    @foreach($loggedUserAgencies as $agency)
                        <li>{{ $agency->name }}</li>
                    @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection