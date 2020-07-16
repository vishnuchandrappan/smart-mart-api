<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Http\Responses\SuccessResponse;

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

    public function webEdit($id)
    {
        $district = District::find($id);
        return view('districts.edit', compact('district'));
    }

    public function webUpdate($id)
    {
        District::find($id)->update([
            'name' => request('name')
        ]);

        return redirect('/districts/' . $id);
    }

    public function webDelete($id)
    {
        District::find($id)->delete();
        return back();
    }


    // API
    /**

    public function apiShow($id)
    {
        return new SuccessResponse('');
    }

    */
}
