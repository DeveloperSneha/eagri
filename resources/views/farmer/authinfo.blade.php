@extends('farmer.farmer_layout')
@section('content')
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <strong>District:</strong>{{$farmer->district->districtName}}
                    <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none"></i>
                </h4>
            </div>
        </a>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable no-footer" id="table1">
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
        </div>
    </div>
    <div class="panel">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <strong>Subdivision: </strong>{{ $farmer->subdivision->subDivisionName}}
                    <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none"></i>
                </h4>
            </div>
        </a>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable no-footer" id="table1">
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
        </div>
    </div>
    <div class="panel">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <strong>Block: </strong>{{ $farmer->block->blockName }}
                    <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none"></i>
                </h4>
            </div>
        </a>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable no-footer" id="table1">
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
        </div>
    </div>
    <div class="panel">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                    <strong>Village: </strong> {{ $farmer->village->villageName }}
                    <i class="fa fa-plus"></i><i class="fa fa-minus" style="display: none"></i>
                </h4>
            </div>
        </a>
        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable no-footer" id="table1">
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
</div>
@stop
@section('script')
<script>
$('.panel-collapse').on('show.bs.collapse', function () {
  $(this).parent('.panel').find('.fa-minus').show();
  $(this).parent('.panel').find('.fa-plus').hide();
})
$('.panel-collapse').on('hide.bs.collapse', function () {
  $(this).parent('.panel').find('.fa-minus').hide();
  $(this).parent('.panel').find('.fa-plus').show();
})
</script>
@stop