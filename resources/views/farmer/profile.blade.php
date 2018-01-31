@extends('farmer.farmer_layout')
@section('content')
 <div class="panel panel-default">
            <div class="panel-heading">Farmer Details</div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $farmer->name }}</td>
                    </tr>
                    <tr>
                        <th>Father Name</th>
                        <td>{{ $farmer->father_name }}</td>
                    </tr>
                   <tr>
                        <th>Aadhaar</th>
                        <td>{{ $farmer->aadhaar }}</td>
                    </tr>
                    <tr>
                        <th>Ration Card No</th>
                        <td>{{ $farmer->rcno }}</td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td>{{ $farmer->mobile }}</td>
                    </tr>
                    <tr>
                        <th>Farmer Category</th>
                        <td>{{ $farmer->farmer_category }}</td>
                    </tr>
                    <tr>
                        <th>District</th>
                        <td>{{ $farmer->district->districtName }}</td>
                    </tr>
                    <tr>
                        <th>Subdivision</th>
                        <td>{{ $farmer->subdivision->subDivisionName }}</td>
                    </tr>
                    <tr>
                        <th>Block</th>
                        <td>{{ $farmer->block->blockName }}</td>
                    </tr>
                    <tr>
                        <th>Village</th>
                        <td>{{ $farmer->village->villageName }}</td>
                    </tr>
                </table>
            </div>
        </div>
@stop