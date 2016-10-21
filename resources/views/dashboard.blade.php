@extends('layouts/master')

@section('content')
    <current-time grid="a1" dateformat="MM月DD日 ddd"></current-time>
    <google-calendar grid="a2"></google-calendar>
    <battery-state grid="a3"></battery-state>
@endsection