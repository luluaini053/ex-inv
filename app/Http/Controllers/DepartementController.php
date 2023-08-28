<?php

namespace App\Http\Controllers;

use App\Models\Depart;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function depart(){
        $depart = Depart::all();
        return view('departement', ['depart' => $depart]);
    }

    public function add(){
        return view('depart-add');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'depart' => 'required|unique:departs|max:100',
        ]);

        $departStore = Depart::create($request->all());
        return redirect('departement')->with('status', 'Add Departement Success');

    }

    public function edit($slug){
        $departo = Depart::where('slug', $slug)->first();
        return view('depart-edit', ['departo' => $departo]);
    }

    public function update(Request $request, $slug){
        $validated = $request->validate([
            'depart' => 'required|unique:departs|max:100',
        ]);

        $departo = Depart::where('slug', $slug)->first();
        $departo->slug = null;
        $departo->update($request->all());
        return redirect('departement')->with('status', 'Update Departement Success');

    }

    public function delete($slug){
        $depart = Depart::where('slug', $slug)->first();
        return view('depart-delete', ['depart' => $depart]);

    }

    public function eliminate($slug){
        $depart = Depart::where('slug', $slug)->first();
        $depart->delete();
        return redirect('departement')->with('status', 'Delete Departement Success');
    }

    public function deletedDepart(){
        $deletedDepart = Depart::onlyTrashed()->get();
        return view('depart-deleted-list', ['deletedDepart' => $deletedDepart]);
    }

    public function restore($slug){
        $depart = Depart::withTrashed()->where('slug', $slug)->first();
        $depart->restore();
        return redirect('departement')->with('status', 'Restore Departement Success');
    }
}
