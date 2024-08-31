<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\interface\BaseInterface;
use App\Models\Employees;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\ResponseTrait;
use App\Models\Departments;
use App\ControllerRepo\EmployeeRepository;
class EmployeeController extends Controller
{
    use ResponseTrait;
    //
    protected $repository;

    public function __construct(EmployeeRepository  $repository)
    {
        $this->repository = $repository;
    }

    public function index(){

        return $this->repository->getAll();
    }
    public function getEmployeeById($id)
    {
        return Employee::with('departments')->find($id);
    }
    
  
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'departments' => 'required|exists:departments,id',
            'position' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
            'status' => 'required|in:active,terminated',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employee = $this->repository->create($validator->validated());
        return $this->success(
            $employee,
            'success to store data',
        );
    }

    public function update(Request $request, Employees $employee){
        $updated=Employees::findorfail($employee->id);
        
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'departments' => 'required|exists:departments,id',
            'position' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
            'status' => 'required|in:active,terminated',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
 
        try{
            $update= $this->repository->update($employee->id, $validator->validated());
            return $this->success(
                $update,
                'success to update data',
            );
        }catch(\Exception $e)
        {
            return $this->failure(
                $message = "Failed to update data",
                error: $e->getMessage(),      
            );
        }
       
    }

    public function destroy($id){
        try{
            $delete=$this->repository->delete($id);
            return $this->success(
                $delete,
                'success to delete data',
            );
        }catch(\Exception $e){
            return $this->failure(
                $message = "Failed to delete data",
                error: $e->getMessage(),);
        }
     
    }
}
