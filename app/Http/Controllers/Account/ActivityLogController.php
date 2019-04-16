<?php

namespace App\Http\Controllers\Account;

use App\Helpers\ArchieveDateExtractor;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    use ArchieveDateExtractor;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // My custom method for getting logs
        $dates = Activity::getDateArchives();

        return view('accounts.activities' , compact('dates'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        // From trait AchieveDateExtractor
        $this->setDate($date);

        // Set values for month and year
        $valuesForClaues = [
            'month' => $this->getDate('month'), 
            'year'  => $this->getDate('year')
        ];

       $activity_logs = Activity::collectByMonthAndYear($valuesForClaues);

       return response()->json(['activity_logs' => $activity_logs]);

    }

}
