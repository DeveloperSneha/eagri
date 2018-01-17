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
                    <div class="hd">Forgot Password / पासवर्ड भूल गए</div>
                    <div class="login-box-body">
                        <form class="form-horizontal" method="POST" action="{{ route('farmer.submitforgotpassword.submit') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('aadhaar') ? ' has-error' : '' }}">
                                <label style="text-align:center;">Your Aadhaar Number</label>
                                
                                <span class="clearfix"></span>
                                <input type="text" name="aadhaar"   autocomplete="off" class="validate fl w-100 input-b-b m-b-20" value="" maxlength="12" minlength="12" pattern="[0-9]+" placeholder="अपना आधार नंबर डाले">
                               
                            </div>
                            <div class="form-group {{ $errors->has('rcno') ? ' has-error' : '' }}">
                                <label>Your Ration Card Number</label>
                                  
                                <span class="clearfix"></span>
                                <input type="text" name="rcno"   value=""  autocomplete="off" class="validate fl w-100 input-b-b m-b-20" maxlength="12" minlength="5" placeholder="अपना  राशन कार्ड नंबर डाले">

                                
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <button type="submit" style="background-color:rgba(252,139,28,0.9);color:#fff;border-color:#fff;" class="btn btn-block btn-primary" name="btn-login">Submit | निवेदन करना</button>
                                </div>
								
                            </div>
<!--                            <p style="border-bottom:1px solid #dbdbdb;"></p>
                            <p></p>
                            <center><b>Helpline / Farmers Assistance Number : 0172-2571553</b></center>
                            <center><b>हेल्पलाइन / किसान सहायता नं: 0172-2571553</b></center>
                            <p></p>-->
<!--                            <p style="border-bottom:1px solid #dbdbdb;"></p>
                            <center>Powered by <a style="color:maroon;" href="http://hkcl.in" target="_blank">HKCL</a></center>-->
                            <div class="form-group">
                        <!--<aside><a href="{{url('farmer/register')}}">New Registration / नया पंजीकरण</a></aside>-->
						<aside>@if ($errors->has('msg'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('msg') }}</strong>
                                </span>
                                @endif</aside><br/>
						<aside><a  href="{{url('farmer/login')}}">Login | लॉग इन करें</a></aside>
                    </div>
                            <div class="form-group ">
<!--                                <a class="btn btn-link" href="#">
                                    Forgot Your Password?
                                </a>-->
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
