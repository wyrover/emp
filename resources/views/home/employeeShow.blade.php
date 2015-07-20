@extends('master')
@section('content')

    @include('partials._employeeShow')

@section('scripts')
    @parent
    <script src="/js/employee.show.js"></script>
@stop

@stop