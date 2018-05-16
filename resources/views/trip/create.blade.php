@extends('layouts.app')

@section('content')

<new-trip-component
    csrf-token="{{ csrf_token() }}"
    submit-route="{{ route('store-trip') }}"
    friendship-route="{{ route('get-friendships-list-by-search') }}"
    api-token="{{ Auth::user()->api_token }}"
></new-trip-component>

<passport-clients></passport-clients>
<passport-authorized-clients></passport-authorized-clients>
<passport-personal-access-tokens></passport-personal-access-tokens>

@endsection
