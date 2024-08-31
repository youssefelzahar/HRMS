<?php

namespace App\Http\Controllers;

use App\Models\LeaveTypes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\ResponseTrait;
use App\ControllerRepo\LeaveTypeRepo;
class LeaveTypesController extends Controller
{
    use ResponseTrait;
   
    public function __construct(LeaveTypeRepo $repository)
    {
        $this->repository = $repository;
    }

    public function index(){

        $index= $this->repository->getAll();
        return $this->success($index,'All Leave Types');
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
            "name"=>"required",
            "description"=>"required", 
         ]);
 
         if ($validator->fails()) {
             return $this->failure(message:"failed to validate data",error:$validator->errors()->first());
         }
 
         try {
               $types=LeaveTypes::create($validator->validated());
               return $this->success($types, 'success to store data');
 
         }catch(\Exception $e) {
            \Log::error('Failed to store leave request: ' . $e->getMessage());
            return $this->failure(message:"failed to store data",error:$e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveTypes $leaveTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveTypes $leaveTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveTypes $leaveTypes)
    {
        //
         //
         try {
           // $updated = LeaveTypes::findOrFail($leaveTypes->id);
        } catch (\Exception $e) {
            // Log error and return failure response
            \Log::error('Failed to find salary record:', ['error' => $e->getMessage()]);
            return $this->failure(
                $message = "Record not found",
                error: $e->getMessage(),
            );
        }
    
        $validator = Validator::make($request->all(), [
            "name"=>"required",
            "description"=>"required", 
        ]);
    
        if ($validator->fails()) {
            return $this->failure(
                $message = "Failed to validate data",
                error:$validator->errors(),
            );
        }
    
        try {
            $update=$this->repository->update($leaveTypes->id,$validator->validated());
    
           return $this->success(
               $message = "success to update data",
               data: $update,
           );
       
        } catch (\Exception $e) {
            return $this->failure(
                $message = "Failed to update data"
                ,error:$e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveTypes $leaveTypes)
    {
        //
        try{
            $this->repository->delete($leaveTypes->id);
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
