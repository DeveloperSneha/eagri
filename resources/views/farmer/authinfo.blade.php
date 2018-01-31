@extends('farmer.farmer_layout')
@section('content')
 <div class="panel panel-default">
            <div class="panel-heading">Authority Information</div>
            <div class="panel-body">
                <table class="table table-bordered">
				<tr>
				 <th>Section Name</th>
				 <th>Designation</th>
				 <th>Name</th>
				 <th>Office Address</th>
				 <th>Contact Details</th>
				</tr>
			@foreach ($info as $var)
                    <tr>
                        <td>{{  $var->sectionName }}</td>
						<td>{{  $var->designationname }}</td>
                        <td>{{  $var->name }}</td>
                        <td>{{  $var->ofc_address }}</td>
                        <td>{{  $var->mobile }}</td>
                    </tr>
					@endforeach
                </table>
            </div>
        </div>
@stop