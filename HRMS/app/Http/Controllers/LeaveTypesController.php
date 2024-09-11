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
use App\Http\Requests\Leave_types_Request;
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
    public function store(Leave_types_Request $request)
    {
        //

 
         try {
               $types=LeaveTypes::create($request->validated());
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
    public function update(Leave_types_Request $request, LeaveTypes $leaveTypes)
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
    
        try {
            $update=$this->repository->update($leaveTypes->id,$request->validated());
    
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
