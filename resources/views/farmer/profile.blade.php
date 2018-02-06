@extends('farmer.farmer_layout')
@section('content')
<style>
    .blink{
        color:red;
        font-size:15px;
        animation:blink_animation .5s infinite;
        text-decoration:blink;
    }
    @keyframes blink_animation {
        50%   {color:red;}      
        100% {color:blue}
    }
</style>
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
<div class="panel panel-default">
    <div class="panel-heading"><strong>Info</strong></div>
    <div class="panel-body">
        <blink class="blink">
            If you want to update any information like mobile,address please 
            contact your corresponding authority at your village, block or district level.
            (Check Information Under Authority Information Tab.) 
            आप  किसी भी सूचना मोबाइल,पता  की अद्यतन करने के लिए  कृपया अपने गांव, ब्लॉक या जिला स्तर पर आपका संबंधित प्राधिकरण से संपर्क करें। 
            (चेक जानकारी के अंतर्गत प्राधिकारी जानकारी टैब।)
        </blink>
    </div></div>
@stop