<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SchemeActivation extends Model {

    //
    protected $guarded = ['id'];
    protected $primaryKey = 'idSchemeActivation';
    protected $table = 'schemeactivation';
    protected $fillable = ['idScheme', 'idFinancialYear', 'startDate', 'endDate', 'extendDays', 'totalFundsAllocated',
        'totalAreaAllocated','assistance', 'idUnit', 'vendorDeliveryDayLimit', 'guidelines','notiFile'];

    public function scheme() {
        return $this->hasOne(Scheme::class,'idScheme','idScheme');
    }

    public function workflow() {
        return $this->hasOne(SchemeWorkflowMapping::class,'idScheme','idScheme');
    }
    
     public function documents() {
        return $this->hasMany(Schemecert::class,'idScheme','idScheme');
    }
    
     public function fy() {
        return $this->belongsTo(FinancialYear::class,'idFinancialYear','idFinancialYear');
    }
    public function unit() {
        return $this->belongsTo(Unit::class,'idUnit','idUnit');
    }
    public function setStartDateAttribute($date) {
        if (strlen($date) > 0)
            $this->attributes['startDate'] = Carbon::createFromFormat('d-m-Y', $date);
        else
            $this->attributes['startDate'] = null;
    }

    public function getStartDateAttribute($date) {
        // dd($date);
        if ($date && $date != '0000-00-00' && $date != 'null')
            return Carbon::parse($date)->format('d-m-Y');
        return '';
    }

    public function setEndDateAttribute($date) {
        if (strlen($date) > 0)
            $this->attributes['endDate'] = Carbon::createFromFormat('d-m-Y', $date);
        else
            $this->attributes['endDate'] = null;
    }

    public function getEndDateAttribute($date) {
        // dd($date);
        if ($date && $date != '0000-00-00' && $date != 'null')
            return Carbon::parse($date)->format('d-m-Y');
        return '';
    }

}
