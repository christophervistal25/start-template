<?php 
namespace App\Helpers;

use Carbon\Carbon;

trait ArchieveDateExtractor
{
    private $date;

    public function setDate(string $date)
    {
        $this->date = $date;
    }

    public function getDate(string $type) : string
    {
        return Carbon::parse($this->date)
                     ->toArray()[$type];
    }
    
}

