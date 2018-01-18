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
                </div>
            </div>
        </div>
        <div class="r-panel" style="z-index: 1000 !important;">
            <div class="log-block">
                <a href="{{url('/')}}"><img src="{{asset('dist/img/DOAH.png')}}" height="90" width="90"></a>
                <div style="font-family: Verdana; font-size: 20px; color: #fff; margin: 10px 0px; text-transform: uppercase;">Agriculture Department</div>
                <div class="log-panel">
                    <div class="hd">Change Password</div>
                    <div class="login-box-body">
                        <form class="form-horizontal" method="POST" action="{{ route('farmer.submitchangepassword.submit') }}">
                            {{ csrf_field() }}
								<input  type="hidden"   name="aadhaar" value="{{$user->aadhaar}}" >
								<input  type="hidden"   name="rcno" value="{{$user->rcno}}" >
							<!--updated-->
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                 <label style="text-align:center;">Enter New Password</label>
                                
                                <span class="clearfix"></span>
                                    <input id="password" type="password"  autocomplete="off" class="validate fl w-100 input-b-b m-b-20"  name="password" placeholder="नया पासवर्ड दर्ज करें" required>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <!--<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                 <label style="text-align:center;">Confirm New Password</label>
                                
                                <span class="clearfix"></span>
                                    <input id="password-confirm" type="password"  placeholder="नए पासवर्ड की पुष्टि करें" autocomplete="off" class="validate fl w-100 input-b-b m-b-20"  name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                               
                            </div>-->
                            <div class="form-group">
                                <div class="">
                                    <button type="submit" style="background-color:rgba(252,139,28,0.9);color:#fff;border-color:#fff;" class="btn btn-primary">
                                        Change Password | पासवर्ड बदलें
                                    </button>
                                </div>
                            </div>
                       
							<!--end updated-->
							<aside>@if ($errors->has('msg'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('msg') }}</strong>
                                </span>
                                @endif</aside><br/>
						<aside><a  href="{{url('farmer/login')}}">LOGIN</a></aside>
                    </div>
                        </form>
                    </div>
                </div><br>
                <!-- /.login-box-body -->
            </div>
        </div>
        
        
        <!-- /.login-box -->

        @include('layouts.partials.script')
    </body>
</html>
