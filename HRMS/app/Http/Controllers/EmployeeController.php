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
use App\Http\Requests\EmployeeRequest;
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
    
  
    public function store(EmployeeRequest $request)
    {
       

        $employee = $this->repository->create($request->validated());
        return $this->success(
            $employee,
            'success to store data',
        );
    }

    public function update(EmployeeRequest $request, Employees $employee){
        $updated=Employees::findorfail($employee->id);
        
       

        if ($request->fails()) {
            return response()->json(['errors' => $request->errors()], 422);
        }
 
        try{

            $updated= $this->repository->update($employee->id, $request->validated());
            return $this->success(
                $updated,
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
