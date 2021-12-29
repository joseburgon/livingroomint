<?php

namespace App\Http\Controllers;

use App\Http\Requests\GivingTypeRequest;
use App\Models\GivingType;
use Illuminate\Http\Request;

class GivingTypeController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.givingTypes.index', [
            'message' => $request->has('message') ? $request->message : ''
        ]);
    }
}
