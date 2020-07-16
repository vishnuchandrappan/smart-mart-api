<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::all();
        return view('districts.index', compact('districts'));
    }

    public function create()
    {
        return view('districts.new');
    }

    public function store(Request $request)
    {
        $district = District::create($request->all());
        return redirect('/');
    }

    public function show($id)
    {
        $district = District::find($id);
        return view('districts.show', compact('district'));
    }
}
