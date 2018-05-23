@extends('layouts.app')

@section('content')


<my-trip-on-map
    :trip-days="{{ $tripdays }}">
</my-trip-on-map>

@endsection