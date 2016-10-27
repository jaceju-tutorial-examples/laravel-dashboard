@extends('layouts/master')

@section('content')
    <current-time grid="a1" dateformat="MM月DD日 ddd"></current-time>
    <google-calendar grid="a2"></google-calendar>
    <battery-state grid="a3"></battery-state>
    <code-coverage grid="b1:d1" title="Project 1"></code-coverage>
    <code-coverage grid="b2:d2" title="Project 2"></code-coverage>
    <code-coverage grid="b3:d3" title="Project 3"></code-coverage>
@endsection