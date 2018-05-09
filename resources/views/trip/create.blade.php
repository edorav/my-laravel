@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <new-trip-component
                :csrf="{{ csrf_token() }}"
                submitroute="{{ route('store-friendship') }}"
            ></new-trip-component>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/new-trip.js') }}" defer></script>
@stop