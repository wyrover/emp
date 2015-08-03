@extends('auth',['title' =>'重新设置密码'])

@section('form')
                        {!! Form::open(['url' => 'password/reset', 'method' => 'post']) !!}
                        <input type="hidden" name="token" value="{{ $token }}">
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

                            <button type="submit" class="btn btn-danger btn-block">重置密码</button>
                        {!! Form::close() !!}


@stop
