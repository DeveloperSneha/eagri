<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <body class="login">
        <div class="l-panel" style="z-index: 10 !important;">
            <div class="sp-container">
                <div class="sp-content">
                    <h2 class="frame-1">Welcome To   </h2>
                    <h2 class="frame-2">Agriculture  Department</h2>
                    <h2 class="frame-3">Haryana </h2>
                    <h2 class="frame-4">Now!</h2>   
                </div>
            </div>
        </div>
        <div class="r-panel" style="z-index: 1000 !important;">
            <div class="log-block">
                <a href="{{url('/')}}"><img src="{{asset('dist/img/DOAH.png')}}" height="90"></a>
                <div style="font-family: Verdana; font-size: 20px; color: #fff; margin: 10px 0px; text-transform: uppercase;">Agriculture Department</div>
                <div class="log-panel">
                    <div class="hd">Government of Haryana</div>
                    <div class="login-box-body">
                        <form class="form-horizontal" method="POST" action="{{ route('authority.login.submit') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('userName') ? ' has-error' : '' }}">
                                <label>USERNAME</label>
                                <span class="clearfix"></span>
                                <!--<input type="text" name="aadhaar" value="{{ old('aadhaar') }}"  autocomplete="off" class="form-control input-b-b" value="" maxlength="12" pattern="[0-9]+" required="">-->
                                <input type="text" name="userName" value="{{ old('userName') }}" onfocus="this.removeAttribute('readonly');" autocomplete="off" class="form-control input-b-b" value="" maxlength="12"  required="">
                                @if ($errors->has('userName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('userName') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>PASSWORD</label>
                                <span class="clearfix"></span>
                                <input type="password" name="password" onfocus="this.removeAttribute('readonly');" id="password" autocomplete="off" class="form-control input-b-b" value="" maxlength="12" required="">

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                        <div class="col-md-4 col-md-offset-1">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-link" href="#">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                            <!--                    <div class="form-group">
                                                    <center><a href="{{url('register')}}"><h4 style="color:maroon;"><b>New Registration / नया पंजीकरण</b></h4></a></center>
                                                </div>-->
                            <!--                    <div class="form-group">
                                                    <div class="col-md-4 col-md-offset-1">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            Forgot Your Password?
                                                        </a>
                                                    </div>
                                                </div>-->
                            <div class="form-group">
                                <div class="">
                                    <button type="submit" style="background-color:yellowgreen;color:#fff;border-color:#fff;" onclick="encrypt();" class="btn btn-block btn-primary" name="btn-login">Login / लॉगिन</button>
                                </div>
                            </div>
<!--                            <p style="border-bottom:1px solid #dbdbdb;"></p>
                            <p></p>
                            <center><b>Helpline / Farmers Assistance Number : 0172-2571553</b></center>
                            <center><b>हेल्पलाइन / किसान सहायता नं: 0172-2571553</b></center>
                            <p></p>-->
<!--                            <p style="border-bottom:1px solid #dbdbdb;"></p>
                            <center>Powered by <a style="color:maroon;" href="http://hkcl.in" target="_blank">HKCL</a></center>-->
                            <div class="form-group ">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.login-box-body -->
            </div>
        </div>
         <!-- /.login-box -->
         
        @include('layouts.partials.script')
    </body>
</html>
