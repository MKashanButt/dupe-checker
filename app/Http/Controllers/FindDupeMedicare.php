<?php

namespace App\Http\Controllers;

use App\Models\MedicareId;
use Illuminate\Http\Request;

class FindDupeMedicare extends Controller
{
    public function find(Request $request)
    {
        $present = MedicareId::where('medicare_id', $request->input('medicare_id'))->first();
        return view('index', [
            'present' => $present ? $present : false,
        ]);
    }
}
