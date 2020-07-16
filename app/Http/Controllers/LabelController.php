<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{

    public function index()
    {
        $labels = Label::all();
        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        Label::create(['name' => request('label_name')]);
        return back();
    }

    public function delete($id)
    {
        Label::find($id)->delete();
        return back();
    }

    public function edit($id)
    {
        $label = Label::find($id);
        return view('labels.edit', compact('label'));
    }

    public function update($id)
    {
        Label::find($id)->update(['name' => request('label_name')]);
        return redirect('/labels');
    }
}
