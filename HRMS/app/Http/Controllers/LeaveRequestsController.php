<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\ResponseTrait;    
use App\ControllerRepo\LeaveRequestReprository;
use App\Http\Requests\Leave_Requests_Request;
class LeaveRequestsController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    protected $reporsitory;
    public function __construct(LeaveRequestReprository $repository){
        $this->reporsitory=$repository;
    }
    public function index()
    {
        //
        $index=$this->reporsitory->getAll();
        return $this->success(
            data:$index,
            message:"All Leave Requests"
        );  
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
    
     public function store(Leave_Requests_Request $request)
{
    

    try {
        // Create a new leave request record
        $leaveRequest = $this->reporsitory->create($request->validated());

        return $this->success(data:$leaveRequest, message:"success to store data");
    } catch (\Exception $e) {
        // Log the exception message for debugging
        \Log::error('Failed to store leave request: ' . $e->getMessage());

        return $this->failure(message:"failed to store data",error:$e->getMessage());
    }
}


    /**
     * Display the specified resource.
     */
    public function show(LeaveRequests $leaveRequests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveRequests $leaveRequests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Leave_Requests_Request $request, LeaveRequests $leaveRequests)
    {
        //

     
        try{
            $this->reporsitory->update($leaveRequests->id,$request->validated());
            return $this->success(data:$leaveRequests, message:'success to update data');
        }catch(\Exception $e){
            return $this->failure(message:"failed to update",error:$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveRequests $leaveRequests)
    {
        //
        try{
            $this->reporsitory->delete($leaveRequests->id);
           return $this->success(message:"success to delete data");
        }catch(\Exception $e){
            return$this->failure(message:"failed to delete data",error:$e->getMessage());
        }
    }
}
