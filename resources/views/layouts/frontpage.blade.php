
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Agriculture Department, Haryana</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">
 <br/>

  <center><img style="height:90px;width:90px;" class="img-responisve" src="{{ asset('dist/img/DOAH.png') }}"></center>
<center><h3>Agriculture Department Haryana</h3></center>
<br/>
  <table class="table">
    <thead>
      <tr style="border: 1px solid #dbdbdb;">
            <th style="border-right: 1px solid #dbdbdb !important;">Sr.No</th>
			<th style="border-right: 1px solid #dbdbdb !important;">Scheme Name <br/>स्कीम  नाम</th>
            <th style="border-right: 1px solid #dbdbdb !important;">Program Name<br/>योजना नाम</th>
            <th style="border-right: 1px solid #dbdbdb !important;">Start Date <br> आरंभ करने की तिथि</th>
            <th style="border-right: 1px solid #dbdbdb !important;">End Date <br> अंतिम तिथि</th>
            <th style="border-right: 1px solid #dbdbdb !important;">Scheme Eligible Districts <br> योजना के योग्य जिले</th>
            <th style="border-right: 1px solid #dbdbdb !important;">Notification's <br> अधिसूचना</th>
            <th style="border-right: 1px solid #dbdbdb !important;">User Manual <br> उपयोगकर्ता पुस्तिका</th>
            <th>Apply <br> लागू करें</th>
      </tr>
    </thead>
    <tbody style="border: 1px solid #dbdbdb;">
	<?php  $sch = DB::table('schemeactivation')
                ->leftJoin('scheme', 'schemeactivation.idScheme', '=', 'scheme.idScheme')
                ->leftJoin('program', 'program.idProgram', '=', 'schemeactivation.idProgram')
                ->select('schemeactivation.idSchemeActivation', 'scheme.schemeName', 'program.programName', 'schemeactivation.startDate', 'schemeactivation.endDate','schemeactivation.guidelines','schemeactivation.notiFile')
                ->groupBy('idSchemeActivation')
                ->get();
				?>
	  @foreach($sch as $var)
	  
	  
      <tr class="success">
        <td style="border-right: 1px solid #dbdbdb !important;">{{ $var->idSchemeActivation }}</td>
		<td style="border-right: 1px solid #dbdbdb !important;">{{ $var->schemeName }}</td>
        <td style="border-right: 1px solid #dbdbdb !important;">{{ $var->programName }}</td>
        <td style="border-right: 1px solid #dbdbdb !important;">{{ $var->startDate }}</td>
        <td style="border-right: 1px solid #dbdbdb !important;">{{ $var->endDate }}</td>
		<?php  $schr = DB::table('schemedistributiondistrict')
                ->leftJoin('district', 'schemedistributiondistrict.idDistrict', '=', 'district.idDistrict')
                ->select('schemedistributiondistrict.amountDistrict', 'schemedistributiondistrict.areaDistrict', 'district.districtName')
				->where('schemedistributiondistrict.idSchemeActivation', '=',  $var->idSchemeActivation)
                ->orderBy('districtName')
                ->get();
				?>

        <td style="border-right: 1px solid #dbdbdb !important;">
		 <table class="table">
        <thead>
      <tr style="border: 1px solid #dbdbdb;">
            <th style="border-right: 1px solid #dbdbdb !important;">District जिला</th>
            <th style="border-right: 1px solid #dbdbdb !important;">Amount रकम</th>
            <th style="border-right: 1px solid #dbdbdb !important;">Area क्षेत्र</th>
			</tr>
			</thead>
    <tbody style="border: 1px solid #dbdbdb;">
	@foreach($schr as $varr)
	    <tr class="success">
        <td style="border-right: 1px solid #dbdbdb !important;">{{ $varr->districtName }}</td>
        <td style="border-right: 1px solid #dbdbdb !important;">{{ $varr->amountDistrict }}</td>
        <td style="border-right: 1px solid #dbdbdb !important;">{{ $varr->areaDistrict }}</td>
		</tr>
			 @endforeach
		</tbody>
		</table>
		</td>
	
        <td style="border-right: 1px solid #dbdbdb !important;"><a href="{{ url('/').Storage::url($var->guidelines)}}" class="btn btn-info" target="_blank">View <br> देखना</a></td>
        <td style="border-right: 1px solid #dbdbdb !important;"><a href="{{ url('/').Storage::url($var->notiFile)}}" target="_blank"  class="btn btn-info">View <br> देखना</a></td>
        <td style="border-right: 1px solid #dbdbdb !important;"><a class="btn btn-success" style="background-color:maroon;color:#fff;border-color:maroon" href="{{ url('/login') }} " target="_blank" >Apply <br> लागू करें<a/></td>
      </tr>   
 @endforeach	  
    </tbody>
  </table>
</div>
<p><center><b>Helpline / Farmers Assistance Number : 0172-2571553</b></center></p>
            <p><center><b>हेल्पलाइन / किसान सहायता नं: 0172-2571553</b></center></p>
<p><center>Powered by <a  style="color:maroon;" href="http://hkcl.in" target="_blank">HKCL</a></center></p>
</body>
</html>