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
                <a href="{{url('/')}}"><img src="{{asset('dist/img/DOAH.png')}}" height="90" width="90"></a>
                <div style="font-family: Verdana; font-size: 20px; color: #fff; margin: 10px 0px; text-transform: uppercase;">Agriculture Department</div>
                @if ($errors->has('msg'))
                <span class="help-block">
                    <strong>{{ $errors->first('msg') }}</strong>
                </span>
                @endif
                <div class="log-panel">
                    <div class="hd">Government of Haryana</div>
                    <div class="login-box-body">
                        <form class="form-horizontal" method="POST" action="{{ route('authority.login.submit') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('userName') ? ' has-error' : '' }}">
                                <label>USERNAME</label>
                                <span class="clearfix"></span>
                                <!--<input type="text" name="aadhaar" value="{{ old('aadhaar') }}"  autocomplete="off" class="form-control input-b-b" value="" maxlength="12" pattern="[0-9]+" required="">-->
                                <input type="text" name="userName" value="{{ old('userName') }}" onfocus="this.removeAttribute('readonly');" autocomplete="off" class="validate fl w-100 input-b-b m-b-20" value="" maxlength="12"  >
                                @if ($errors->has('userName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('userName') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>PASSWORD</label>
                                <span class="clearfix"></span>
                                <input type="password" name="password" onfocus="this.removeAttribute('readonly');" id="password" autocomplete="off" class="validate fl w-100 input-b-b m-b-20" value="" maxlength="12" >

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <center>
                                <div class="g-recaptcha" data-sitekey="6LebkD4UAAAAAExBzYddN9Lh3HIfQUiIz-LRyFCS">
                                </div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                    @endif
                            </center><br>
                            
                            <div class="form-group">
                                <div class="">
                                    <button type="submit" style="background-color:rgba(252,139,28,0.9);color:#fff;border-color:#fff;" onclick="encrypt();" class="btn btn-block btn-primary" name="btn-login">Login / लॉगिन</button>
                                </div>
                            </div>
<!--                            <p style="border-bottom:1px solid #dbdbdb;"></p>
                            <p></p>
                            <center><b>Helpline / Farmers Assistance Number : 0172-2571553</b></center>
                            <center><b>हेल्पलाइन / किसान सहायता नं: 0172-2571553</b></center>
                            <p></p>-->
<!--                            <p style="border-bottom:1px solid #dbdbdb;"></p>
                            <center>Powered by <a style="color:maroon;" href="http://hkcl.in" target="_blank">HKCL</a></center>-->
                            
                        </form>
                    </div>
                </div><br><br>
                <br><br>
                <div class="pull-right hidden-xs">
                    <label style="color:#ffffff;font-size:10px; letter-spacing: 1px;"><b>Version</b> 1.02.01.01</label>
                </div>
                
                <!-- /.login-box-body -->
            </div>
        </div>
        <!-- /.login-box -->

        @include('layouts.partials.script')
       
    </body>
</html>