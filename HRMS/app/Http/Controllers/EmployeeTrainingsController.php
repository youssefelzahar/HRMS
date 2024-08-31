<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTrainings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\ControllerRepo\EmployeeTraningReprository;
use App\ResponseTrait;
class EmployeeTrainingsController extends Controller
{
     use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    protected $reprository;
    public function __construct(EmployeeTraningReprository $reprository){
        $this->reprository=$reprository;
    }
    public function index()
    {
        //
        $employeeTrainings=$this->reprository->getAll();
        return $this->success($employeeTrainings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'training_sessions_id'=>'required',
            'status'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->failure("not validate",$validator->errors());
        }
        try{
            $employeeTrainings=$this->reprository->create($validator->validated());
            return $this->success($employeeTrainings, 'success to store data');
        }catch(Exception $ex){
            return $this->failure("failed to store data",$ex->getMessage());
        }
      

    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeTrainings $employeeTrainings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeTrainings $employeeTrainings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeTrainings $employeeTrainings)
    {
        //
        try {
            $update = EmployeeTrainings::findOrFail($employeeTrainings->id);
        } catch (\Exception $e) {
            // Log error and return failure response
            \Log::error('Failed to find salary record:', ['error' => $e->getMessage()]);
            return $this->failure(
                $message = "Record not found",
                error: $e->getMessage(),
            );
        }
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'training_sessions_id'=>'required',
            'status'=>'required'
        ]);
        if ($validator->fails()) {
            return $this->failure("not validate",$validator->errors());
        }
        try{
           // $update=TrainingSessions::findorfail($trainingSessions->id);

            $update=$this->reprository->update($employeeTrainings->id,$validator->validated());
            return $this->success($update, 'success to update data');
        }catch(\Exception $e){
            return $this->failure("faild to uopdate",$e->getMessage());
            
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeTrainings $employeeTrainings)
    {
        //
        try{
            $this->reprository->delete($employeeTrainings->id);
            return $this->success(
                $message="success to delete data",
    
            );
        }catch(\Exception $e){
            return$this->failure(
                $message="failed to delete data"
                ,error:$e->getMessage()
            );
        }
    }
}
