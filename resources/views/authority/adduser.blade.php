@extends('authority.authority_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong> @if(isset($user)) Edit @else Add @endif User</strong></div>
    <div class="panel-body">
        @if(isset($user))
        {!! Form::model($user, ['route' => ['adduser.update', $user->idUser], 'method' => 'patch','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => '/authority/adduser','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">

                {!! Form::select('sch_blocks[]',$sch_blocks, null, ['class' => 'form-control select2','multiple'=>'multiple','id'=>'idBlock']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Village', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "villages[]"  id="idVillage" class="form-control select2" multiple="multiple" >
                </select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('designations[]',$designations, isset($user) ? $userdesig : null, ['class' => 'form-control select2','multiple'=>'multiple']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Username', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::text('userName', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <!--        <div class="form-group">
                    {!! Form::label('Password', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('userName', null, ['class' => 'form-control']) !!}
                    </div>
                </div>-->
    </div>
    <div class="panel-footer">
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
        @if(isset($user))
        <button type="submit" class="btn btn-danger">Update</button>
        @else
        <button type="submit" class="btn btn-danger">Save</button>
        @endif
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Users</strong></div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>UserName</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($users as $var)
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{$var->userName }}</td>
                    <td>@foreach($var->userdesig as $desig)
                        {{$desig->designation->designationName or ''}} ,<br>
                        @endforeach
                    </td>
                    <td>
                        {{ Form::open(['route' => ['adduser.destroy', $var->idUser], 'method' => 'delete']) }}
                        <a href='{{url('/authority/adduser/'.$var->idUser.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
<!--                        <button class="btn btn-xs btn-danger" type="submit">Delete</button>-->
                        {{ Form::close() }}
                    </td>
                </tr>
                <?php $i++; ?>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
@section('script')
<script>
$(document).ready(function () {
    $('select[name="sch_blocks"]').on('change', function() {
        var blockid = $(this).val();
            if(blockid) {
                $.ajax({
                    url: "{{url('authority/block') }}"+'/' +blockid + "/villages",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="idVillage"]').empty();
                        $.each(data, function(key, value) {
                            $('select[id="idVillage"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[id="idVillage"]').empty();
            }
    });
});
</script>
@stop
