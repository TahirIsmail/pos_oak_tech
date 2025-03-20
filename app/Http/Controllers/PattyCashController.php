<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PattyCash;

class PattyCashController extends Controller
{


    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'month'  => 'required|integer|between:1,12',
            'year'   => 'required|integer|digits:4'
        ]);

        // Check if this month and year combination already exists
        $existingEntry = PattyCash::where('month', $request->month)
            ->where('year', $request->year)
            ->first();

        if ($existingEntry) {
            return response()->json(['error' => 'This month’s Patty Cash has already been recorded.'], 400);
        }

        // Save the new Patty Cash entry
        $pattyCash = new PattyCash();
        $pattyCash->amount = $request->amount;
        $pattyCash->month = $request->month;
        $pattyCash->year = $request->year;
        $pattyCash->save();

        return response()->json(['success' => 'Patty Cash saved successfully!']);
    }
}
