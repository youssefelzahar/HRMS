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
    
     public function store(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'employee_id' => 'required|exists:employees,id', // Check if employee_id exists in employees table
        'start_date' => 'required|date', // Ensure the date format is correct
        'end_date' => 'required|date|after_or_equal:start_date', // Ensure end_date is after or equal to start_date
        'reason' => 'required|string',
        'status' => 'required|in:pending,approved,rejected',
        'leave_typess_id'=>'required' // Define valid status values
    ]);

    // Check if validation failed
    if ($validator->fails()) {
        return $this->failure(message:"failed to validate",error:$validator->errors()->first());
    }

    try {
        // Create a new leave request record
        $leaveRequest = $this->reporsitory->create($validator->validated());

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
    public function update(Request $request, LeaveRequests $leaveRequests)
    {
        //

        $validate=Validator::make($request->all(),[
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'leave_typess_id'=>'required'
        ]);
        if($validate->fails()){       
            return $this->failure(message:'failed to validate',error:$validate->errors());  
        }
        try{
            $this->reporsitory->update($leaveRequests->id,$validate->validated());
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
