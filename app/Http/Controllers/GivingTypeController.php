<?php

namespace App\Http\Controllers;

use App\Models\GivingType;
use Illuminate\Http\Request;

class GivingTypeController extends Controller
{
    public function index()
    {
        return view('dashboard.givingTypes.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
