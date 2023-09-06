<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\DB;


class StaffAttendance extends Model
{
    use HasFactory;

    protected $table = 'staff_attendances';
    protected $guarded = [];


    

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new StoreScope);
    }

    
   
  
    public function user()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }
    public function monthAttendance($st_month, $no_of_months, $emp)
    {


        $record = [];
        for ($i = 1; $i <= $no_of_months; $i++) {
            $r = [];

            $month = date('m', strtotime($st_month . " -$i month"));
            // return $st_month;
            $year = date('Y', strtotime($st_month . " -$i month"));
            
            foreach (config('staffattendance') as $att_key => $att_value) {
                $s = $this->countAttendanceObj($year, $month, $emp, $att_value);
                
                $r[$att_key] = $s;
            }
            

            $record['01-' . $month . '-' . $year] = $r;
        }
        return $record;
    }

    public function countAttendanceObj($year, $month, $staff_id, $attendance_type)
    {
        // Enable query log
    // DB::enableQueryLog();

    // Your query
    $result = StaffAttendance::where('staff_id', $staff_id)
        ->whereRaw('YEAR(date) = ?', [$year])
        ->whereRaw('MONTH(date) = ?', [$month])
        ->where('staff_attendance_type_id', $attendance_type)
        ->count();

    // Get and display the queries
    // dd(DB::getQueryLog());
    

    return $result;
    }
    
}
