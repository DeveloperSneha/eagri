@extends('authority.authority_layout')
@section('content')
<div class="col-md-12">
    <!-- /.info-box -->
    <div class="info-box bg-green">
        <span class="info-box-icon"><img src="{{ asset('dist/img/user.jpg') }}"  alt="User Image"></span>

        <div class="info-box-content">
            <h4>Welcome !!</h4>
            <span class="info-box-number">@auth <h3>{{ Auth::user()->userName }}</p> @endauth</h3>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.box -->
</div>
<div class="col-md-12">
    <div class="block black bg-white">
        <div class="head">Department DashBoard</div>
        <div class="content">
            This is Department DashBoard

        </div>

    </div>
</div>
@stop