<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Validator;
use DataTables;
use DB;

class ajaxdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax()
    {
        return view('ajax/ajaxdata');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
     function getdata()
    {
     $students = Student::select('id','first_name', 'last_name');
     return Datatables::of($students)
             ->addColumn('action' ,function($student){
                return '<a href="#" class="btn btn-xs btn-primary edit" id = "'.$student->id.'">
                 <li class="glyphicon glyphicon-edit">Edit</li></a> |
                 <a href="#" class="btn btn-xs btn-danger delete" id = "'.$student->id.'">
                 <li class="glyphicon glyphicon-trash"> Delete</li></a>';
             })
             ->make(true);
    }

    function postdata(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {
            if($request->get('button_action') == "insert")
            {
                $student = new Student([
                    'first_name'    =>  $request->get('first_name'),
                    'last_name'     =>  $request->get('last_name')
                ]);
                $student->save();
                $success_output = '<div class="alert alert-success">Data Inserted</div>';
            }
            if($request->get('button_action') == "update")
            {
                $student = Student::find($request->get('id'));
                $student->first_name = $request->get('first_name');
                $student->last_name = $request->get('last_name');
                $student->save();
                $success_output = '<div class="alert alert-success">Data Updated</div>';

         $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    //function to fetch data
    function fetchdata(Request $request) {
       $id = $request->input('id');
       $student = Student::find($id);

       $output = array(
           'first_name' => $student->first_name,
           'last_name' => $student->last_name

       );

       echo json_encode($output);
    }

    //updating data
        function update_data(Request $request)
    {
        //Performing validations
        $this->validate($request, [
           'update_first_name'  => 'required',
           'update_last_name'   => 'required'
        ]);
                $student = Student::find($request->input('student_id'));
                $student->first_name = $request->input('update_first_name');
                $student->last_name = $request->input('update_last_name');
                $student->save();
                return redirect('/ajax')->with('success' ,'Student Updated');

    }

    function remove_student(Request $request) {
        $student = Student::find($request->input('id'));
        if($student->delete()){
            //echo "Student Deleted";
            return redirect('/ajax')->with('success' ,'Student Deleted');
        }
    }


}
