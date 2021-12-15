<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $report = DB::table("items") 
        ->select('locations.name as location','categories.name as category',DB::raw('count(category_id)'))
        ->Join('locations','locations.id','=', 'items.location_id')
        ->Join('categories','categories.id','=', 'items.category_id')
        ->groupBy('locations.name','categories.name')
        ->get();
        return $report;
    }
}