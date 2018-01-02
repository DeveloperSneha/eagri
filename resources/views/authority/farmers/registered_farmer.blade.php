@extends('authority.authority_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Registered Farmer</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Farmer Name</th>
                    <th>District Name</th>
                    <th>Block Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($farmers as $var)
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{$var->name }}</td>
                    <td>{{$var->district->districtName}}</td>
                    <td>{{$var->block->blockName}}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">Cancel Registration</button>
                    </td>
                </tr>
                <?php $i++; ?>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content panel-default">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cancel Registration</h4>
            </div>
            <div class="modal-body" style="padding-top: 50px;">
                <p>Are You Sure You Want to do this..</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
   
</script>
@stop

