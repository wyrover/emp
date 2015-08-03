@extends('auth',['title' =>'请登录'])

@section('form')
                        {!! Form::open(['url' => 'auth/login', 'method' => 'post']) !!}
                            <div class="form-group input-group ">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" required  placeholder="输入电子邮箱地址">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" name="password" id="password" class="form-control" required  placeholder="输入您的密码">
                            </div>
                        @include('errors.list')
                            <div class="form-group">
                                <label class="cr-styled">
                                    <input type="checkbox" name="remember">
                                    <i class="fa"></i>
                                </label>
                               记住帐号
                                <a class="btn btn-link pull-right" style="padding: 0" href="{{url('password/email')}}">无法登录?</a>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">登录</button>
                        {!! Form::close() !!}
                        <hr>

                        <p class="text-center text-gray">还没有账号？</p>
                        <a class="btn btn-purple btn-block" href="{{url('auth/register')}}">注册</a>

@stop
