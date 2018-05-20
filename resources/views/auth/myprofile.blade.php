@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <my-profile
                        submit-route="{{ route('edit-profile') }}"
                        api-token="{{ Auth::user()->api_token }}"
                        :user="{{ Auth::user() }}"
                        default-image="{{ Auth::user()->getProfilePicture()}}"
                    ></my-profile>             

                </div>
            </div>
        </div>
    </div>
</div>
@endsection