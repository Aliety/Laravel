<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Thesis;

class ThesisController extends Controller
{
    public function edit($id)
    {
        $thesis = Thesis::find($id);

        return view('thesis.edit', $thesis);
    }

    public function update(Request $request, $id)
    {
        $thesis = Thesis::find($id);
        if ($request->input('check')) {
            $thesis->active = (bool)$request->input('check');
        }
        $thesis->defense_time = $request->input('defense_time');
        $thesis->save();

        return redirect()->back()->withSuccess("Action success");
    }
}
