<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FinancialYear extends Model {

    //
   // protected $dateFormat = 'Y-m-d';
    protected $primaryKey = 'idFinancialYear';
    protected $table = 'financialyear';
    protected $fillable = ['financialYearName', 'finanYearStartDate', 'finanYearEndDate'];

    public function setFinanYearStartDateAttribute($date) {
        if (strlen($date) > 0)
            $this->attributes['finanYearStartDate'] = Carbon::createFromFormat('d-m-Y', $date);
        else
            $this->attributes['finanYearStartDate'] = null;
    }

    public function getFinanYearStartDateAttribute($date) {
        // dd($date);
        if ($date && $date != '0000-00-00' && $date != 'null')
            return Carbon::parse($date)->format('d-m-Y');
        return '';
    }

    public function setFinanYearEndDateAttribute($date) {
        if (strlen($date) > 0)
            $this->attributes['finanYearEndDate'] = Carbon::createFromFormat('d-m-Y', $date);
        else
            $this->attributes['finanYearEndDate'] = null;
    }

    public function getFinanYearEndDateAttribute($date) {
        if ($date && $date != '0000-00-00' && $date != 'null')
            return Carbon::parse($date)->format('d-m-Y');
        return '';
    }

}
