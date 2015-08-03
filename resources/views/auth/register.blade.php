@extends('auth',['title' =>'新用户注册'])

@section('form')
                        {!! Form::open(['url' => 'auth/register', 'method' => 'post']) !!}
                        <div class="form-group input-group ">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" required  placeholder="输入您的昵称">
                        </div>
                            <div class="form-group input-group ">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" required  placeholder="输入电子邮箱地址">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" name="password" id="password" class="form-control" required  placeholder="输入您的密码">
                            </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" name="password_confirmation" class="form-control" required  placeholder="确认一遍您的密码">
                        </div>
                        @include('errors.list')

                            <button type="submit" class="btn btn-danger btn-block">注册</button>
                        {!! Form::close() !!}


@stop
