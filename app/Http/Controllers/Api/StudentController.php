<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Student::query();

        $students = $query->paginate();

        return StudentResource::collection($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rule = [
            'id_number' => 'required|max:50|unique:students,id_number', 
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'middlename' => 'nullable|max:100',
        ];

        $data = $request->validate($rule);


        try{

            DB::beginTransaction();

            $student = $request->user()->created_students()->create($data);

            DB::commit();
            
            return new StudentResource($student);

        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {

        $rule = [
            'id_number' => [
                'required',
                'max:50',
                Rule::unique('students','id_number')->ignore($student->id)
            ], 
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'middlename' => 'nullable|max:100',
        ];

        $data = $request->validate($rule);

        $student->update($data);

        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
