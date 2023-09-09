<?php

namespace App\Http\Controllers;

use App\Division;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use DateTime;

class DivisionController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->isMethod('POST')) {
          $path =  fileUpload($request->url,'arun');
          return $path;
        }
        $data['division'] = Division::find(2);
        return view('division.uploadwithcrop', $data);
    }

    public function index()
    {
        $data['division'] = Division::all();
        $data['pageTitle'] = 'Division';
        return view('division.index', $data);
    }

    public function create()
    {
        return view('division.create')->with('pageTitle', 'Division Create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string',
            'status' => 'required|int',
        ]);
        Division::create($request->all());
        toast(transMsg('Division created successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.division.index');
    }

    public function show(Division $division)
    {
        return view('division.show', compact('division'))->with('pageTitle', $division->name);
    }

    public function edit(Division $division)
    {
        return view('division.edit', compact('division'))->with('pageTitle', $division->name);
    }


    public function update(Request $request, Division $division)
    {
        request()->validate([
            'name' => 'required|string',
            'status' => 'required|int',
        ]);
        $division->update($request->all());
        toast(transMsg('Division updated successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.division.index');
    }


    public function destroy(Division $division)
    {
        $division->delete();
        toast(transMsg('Division Deleted successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.division.index');
    }
}
