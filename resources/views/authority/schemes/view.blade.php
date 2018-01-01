@extends('authority.authority_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Schemes for Approval</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'authority/schemes','class'=>'form-horizontal']) !!}
        <input type="hidden" name="idAppliedScheme" value="{{$farmer_scheme->idAppliedScheme}}">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <p class="form-control-static"><strong>Financial Year :</strong></p>
                <p class="form-control-static"><strong>Farmer Name : </strong>{{ $farmer_scheme->farmer->name }}</p>
                <p class="form-control-static"><strong>Father Name : </strong>{{ $farmer_scheme->farmer->father_name }}</p>
                <p class="form-control-static"><strong>Village : </strong>{{ $farmer_scheme->farmer->village->villageName }}</p>
                <p class="form-control-static"><strong>Block : </strong>{{ $farmer_scheme->farmer->block->blockName }}</p>
                <p class="form-control-static"><strong>District : </strong>{{ $farmer_scheme->farmer->district->districtName }}</p>
                <p class="form-control-static"><strong>Maximum Benefit of The Scheme : </strong></p>
                <p class="form-control-static"><strong>Remarks Of ADO : </strong></p>
            </div>
            <div class="col-sm-6">
                <p class="form-control-static"><strong>Scheme Applied : </strong>{{ $farmer_scheme->scheme->schemeName }}</p>
                <p class="form-control-static"><strong>Component Applied : </strong></p>
                <p class="form-control-static"><strong>Land Information : </strong>{{ $farmer_scheme->farmer->total_land }}</p>
                <p class="form-control-static"><strong>Contact No.: </strong>{{ $farmer_scheme->farmer->mobile }}</p>
                <p class="form-control-static"><strong>Area/Number Applied: </strong>{{ $farmer_scheme->areaApplied }}</p>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Remarks', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-6">
                {!! Form::textarea('remarks', null, ['size'=>'30x3','class' => 'form-control','placeholder'=>'Enter Remarks']) !!}
            </div>
        </div><br>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
                <input type="checkbox" name="haveChecked" class="minimal" value="Y">
            <label> I Have Checked And Verified The Details Of The Farmer</label>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <!--{!!  Form::submit('Approve',['class'=>'btn btn-danger'])!!}
        {!!  Form::submit('Reject',['class'=>'btn btn-danger'])!!}-->
		<button type="submit" name="Approve" class="btn btn-danger">Approve</button>
		<button type="submit" name="Reject" class="btn btn-danger">Reject</button>
        {!! Form::close() !!}
    </div>
</div>
@stop