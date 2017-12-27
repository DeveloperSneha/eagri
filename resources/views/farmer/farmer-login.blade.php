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
                    <div class="hd">Login / लॉगिन</div>
            <div class="login-box-body">
                <!--<p class="login-box-msg">Login / लॉगिन</p>-->

                <form class="form-horizontal" method="POST" action="{{ route('farmer.login.submit') }}">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('aadhaar') ? ' has-error' : '' }}">
                        <label>Login Id is your Aadhaar Number / लॉगिन आईडी आपका आधार नंबर है</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="text" name="aadhaar" value="{{ old('aadhaar') }}" readonly="" onfocus="this.removeAttribute('readonly');" autocomplete="off" class="form-control" value="" maxlength="12" pattern="[0-9]+" required="">
<!--                            <input type="text" class="form-control" name="aadhaar" value="{{ old('aadhaar') }}" required autofocus>-->

                        </div>
                        @if ($errors->has('aadhaar'))
                        <span class="help-block">
                            <strong>{{ $errors->first('aadhaar') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label>Password is your Mobile Number  / पासवर्ड आपका मोबाइल नंबर है</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="password" readonly="" onfocus="this.removeAttribute('readonly');" id="password" autocomplete="off" class="form-control" required="">
<!--                            <input id="password" type="password" class="form-control" name="password" required>-->
                        </div>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <center><a href="{{url('farmer/register')}}"><h4 style="color:maroon;"><b>New Registration / नया पंजीकरण</b></h4></a></center>
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
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" style="background-color:maroon;color:#fff;border-color:maroon;" onclick="encrypt();" class="btn btn-block btn-primary" name="btn-login">Login / लॉगिन</button>
                        </div>
                    </div>
                    <p style="border-bottom:1px solid #dbdbdb;"></p>
                    <p></p>
                    <center><b>Helpline / Farmers Assistance Number : 0172-2571553</b></center>
                    <center><b>हेल्पलाइन / किसान सहायता नं: 0172-2571553</b></center>
                     <p></p>
                    <p style="border-bottom:1px solid #dbdbdb;"></p>
                    <center>Powered by <a style="color:maroon;" href="http://hkcl.in" target="_blank">HKCL</a></center>
                   
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        @include('layouts.partials.script')
    </body>
</html>
