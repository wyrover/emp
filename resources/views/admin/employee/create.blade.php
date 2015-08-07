@extends('master')
@section('content')

	@include('partials._form_employee')

@section('scripts')
	@parent
	<script src="/js/employee.create.js"></script>
@stop

@stop