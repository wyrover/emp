@extends('master')
@section('content')

    @include('partials._form_employee')

@section('scripts')
    @parent
    <script src="/js/employee.update.js"></script>
@stop

@stop