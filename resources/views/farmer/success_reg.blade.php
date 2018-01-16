<html>
    @include('layouts.partials.head')
    <body style="background-color: #323232;">
        <div class="panel panel-default">
        <div class="alert alert alert-success">You Are Successfully Registered !!</div>
        
            <div class="panel-heading">
                
                    <label> Farmer Name :</label> <span> {{ $farmer }}</span><br><br> 
                    <label> UserName : </label><span>{{ $farmer }}</span><br><br>
                    <label> Passsword : </label><span>{{ $password }}</span>
                
            </div>
<center> <a href="{{'FarmerRegisterController@printFarmerDetails'}}" class="btn btn-sm btn-danger">Print</a></center>
        </div>
        

