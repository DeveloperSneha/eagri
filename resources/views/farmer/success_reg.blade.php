<html>
    @include('layouts.partials.head')
    <body style="background-color: #323232;">
        <div class="register-box-body" style="background-color: #323232;"><br><br>
            <p class="register-box-msg" style="color:#fff">Thank You for The Registration</p>

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">You Are Successfully Registered !!
                            <a style="color:#fff" href="{{url('farmer/login')}}"><span style="float:right;"><i class="fa fa-home fa-2x"></i></span></a>
                    </div><br>
                    
                    <div class="">
                        <label> Farmer Name :</label> <span> {{ $farmer->name }}</span><br><br>
                        <label> UserName : </label> <span> {{ $farmer->mobile }}</span><br><br>                
                        <label> Password : </label> <span>{{ substr($farmer->name,0,4) }}{{ substr($farmer->aadhaar,-4) }}{{ substr($farmer->rcno,-4) }}</span><br><br>
                    </div>
                    <center> 
                        <a href="{{ action('Auth\FarmerRegisterController@printFarmerDetails', $farmer->idFarmer)}}" class="btn btn btn-success">Print</a>
                        <a style="color:#fff" href="{{url('farmer/login')}}" class="btn  btn-success">Login</a>
                    </center>
                </div>
            </div>
        </div>




