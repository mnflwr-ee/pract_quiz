<?php

namespace App\Http\Controllers;
use Illuminate\Support\Fascades\DB;
use Response;
use Illuminate\Http\Request;
use App\Models\employee;

class employeecontroller extends Controller
{
    public function index()
    {   

        return view ('employee.index');
    }

    public function create()
    {
        return view ('employee.create');
    }


    public function store(Request $request)
    {
    $request->validate([
        'fname' => 'required|max:255|',
        'lname' => 'required|max:255|',
        'midname' => 'required|max:255|',
        'age' => 'required|',
        'address' => 'required|max:255|',
        'zip' => 'required|',
        
    ]);

    employee::create($request->all());
    return view ('employee.create');
    }

    public function edit( int $id)
    {
        $employees = ::find($id);
        return view ('employee.edit');
    }

    // public function update(Request $request, int $id) {
    //     {
    //         $request->validate([
    //             'fname' => 'required|max:255|mama ko',
    //             'lname' => 'required|max:255|papa ko',
    //             'midname' => 'required|max:255|ate ko',
    //             'age' => 'required| tita ko',
    //             'address' => 'required|max:255|tito ko',
    //             'zip' => 'required| pamilya ko',
                
    //         ]);
    //         employee::findOrFail($id)->($request->all());
    //         return redirect()->back()->with('status','Employee Updated Successfully!');
    //         }
    // }

    public function update (Request $request, int $id)
    {
    $request -> validate ([
                'fname' => 'required|max:255|string',
                'lname' => 'required|max:255|string',
                'midname' => 'required|max:255|string',
                'age' => 'required|max:255|integer',
                'address' => 'required|max:255|string',
                'zip' => 'required|max:25|integer',
    ]);
         employee::findOrfail($id)->update($request->all());
        return redirect()-> route('employee.index');
    }

    public function destroy (int $id){
        $employees = employee::findOrFail($id);
        $employees->delete();
        return redirect ()->back()->with('status','Employee Deleted');
    }
}
