@extends('farmer.farmer_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Authority Information</div>
    <div class="panel-body">
        <div class="box collapsed-box">
            <div class="box-header with-border">
                <h2 class="box-title"><strong>District:</strong>{{$farmer->district->districtName}}</h2>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Section Name</th>
                            <th>Designation</th>
                            <th>Name</th>
                            <th>Contact Info</th>
                            <th>Office Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $section)
                        <tr>
                            <td>{{ $section->sectionName}}</td>
                            <?php
                            $det = DB::table('users')
                                    ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                                    ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                                    ->join('section', 'designation.idSection', '=', 'section.idSection')
                                    ->join('district', 'user_designation_district_mapping.idDistrict', '=', 'district.idDistrict')
                                    ->where('designation.idSection', '=', $section->idSection)
                                    ->where('user_designation_district_mapping.idDistrict', '=', $farmer->idDistrict)
                                    ->whereNull('user_designation_district_mapping.idSubdivision')
                                    ->whereNull('user_designation_district_mapping.idBlock')
                                    ->whereNull('user_designation_district_mapping.idVillage')
                                    ->get();
                            ?>
                            @foreach($det as $var)
                            <td>{{ $var->designationName}}</td>
                            <td>{{ $var->name}}</td>
                            <td>{{ $var->mobile}}</td>
                            <td>{{ $var->ofc_address}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box collapsed-box">
            <div class="box-header with-border">
                <h2 class="box-title"><strong>Subdivision:</strong>{{$farmer->subdivision->subDivisionName}}</h2>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Section Name</th>
                            <th>Designation</th>
                            <th>Name</th>
                            <th>Contact Info</th>
                            <th>Office Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $section)
                        <tr>
                            <td>{{ $section->sectionName}}</td>
                            <?php
                            $detail = DB::table('users')
                                    ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                                    ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                                    ->join('section', 'designation.idSection', '=', 'section.idSection')
                                    ->join('subdivision', 'user_designation_district_mapping.idSubdivision', '=', 'subdivision.idSubdivision')
                                    ->where('designation.idSection', '=', $section->idSection)
                                    ->where('user_designation_district_mapping.idSubdivision', '=', $farmer->idSubdivision)
                                    ->whereNull('user_designation_district_mapping.idBlock')
                                    ->whereNull('user_designation_district_mapping.idVillage')
                                    ->get();
                            ?>
                            @foreach($detail as $value)
                            <td>{{ $value->designationName}}</td>
                            <td>{{ $value->name}}</td>
                            <td>{{ $value->mobile}}</td>
                            <td>{{ $value->ofc_address}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box collapsed-box">
            <div class="box-header with-border">
                <h2 class="box-title"><strong>Block:</strong>{{$farmer->block->blockName}}</h2>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Section Name</th>
                            <th>Designation</th>
                            <th>Name</th>
                            <th>Contact Info</th>
                            <th>Office Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $section)
                        <tr>
                            <td>{{ $section->sectionName}}</td>
                            <?php
                            $a_detail = DB::table('users')
                                    ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                                    ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                                    ->join('section', 'designation.idSection', '=', 'section.idSection')
                                    ->join('block', 'user_designation_district_mapping.idBlock', '=', 'block.idBlock')
                                    ->where('designation.idSection', '=', $section->idSection)
                                    ->where('user_designation_district_mapping.idBlock', '=', $farmer->idBlock)
                                    ->whereNull('user_designation_district_mapping.idVillage')
                                    ->get();
                            ?>
                            @foreach($a_detail as $val)
                            <td>{{ $val->designationName}}</td>
                            <td>{{ $val->name}}</td>
                            <td>{{ $val->mobile}}</td>
                            <td>{{ $val->ofc_address}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box collapsed-box">
            <div class="box-header with-border">
                <h2 class="box-title"><strong>Village:</strong>{{$farmer->village->villageName}}</h2>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" type="button" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Section Name</th>
                            <th>Designation</th>
                            <th>Name</th>
                            <th>Contact Info</th>
                            <th>Office Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $section)
                        <tr>
                            <td>{{ $section->sectionName}}</td>
                            <?php
                            $auth_detail = DB::table('users')
                                    ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                                    ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                                    ->join('section', 'designation.idSection', '=', 'section.idSection')
                                    ->join('village', 'user_designation_district_mapping.idVillage', '=', 'village.idVillage')
                                    ->where('designation.idSection', '=', $section->idSection)
                                    ->where('user_designation_district_mapping.idVillage', '=', $farmer->idVillage)
                                    ->get();
                            ?>
                            @foreach($auth_detail as $d)
                            <td>{{ $d->designationName}}</td>
                            <td>{{ $d->name}}</td>
                            <td>{{ $d->mobile}}</td>
                            <td>{{ $d->ofc_address}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
