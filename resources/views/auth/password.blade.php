@extends('auth',['title' =>'找回密码'])

@section('form')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    {!! Form::open(['url' => 'password/email', 'method' => 'post']) !!}
    <div class="form-group input-group ">
        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
        <input type="email" name="email" value="{{old('email')}}" class="form-control" required  placeholder="输入电子邮箱地址">
    </div>

    @include('errors.list')

    <button type="submit" class="btn btn-danger btn-block">发送密码重置邮件</button>
    {!! Form::close() !!}


@stop
