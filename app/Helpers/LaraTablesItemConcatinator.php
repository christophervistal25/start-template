<?php 
namespace App\Helpers;

use Illuminate\Support\Str;

trait LaraTablesItemConcatinator 
{
    public static function joinItems($modelRelation)
    {
        // initialize container for items
        $items = null;

        // iteratate and concat each item
        foreach ($modelRelation->items as $model) {
            $items .= Str::ucfirst($model->item_name) . ' , ';
        }

        // remove the last comma
        return rtrim($items,', ');
    }
}

