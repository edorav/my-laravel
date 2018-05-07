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

                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                    <img src="{{ Auth::user()->picture }}"  >
                    
                     {{ Auth::user()->email }}

                    <form method="POST" action="{{ route('edit-profile') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="picture" />

                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection