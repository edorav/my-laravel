@extends('layouts.app')

@section('content')
    @if (Auth::check())
        @include('trip.index')
    @endif
@endsection


@section('sidebar-right')



@endsection
