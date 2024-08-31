<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\ResponseTrait;
use App\ControllerRepo\AttendenceReprository;
class AttendanceController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    protected $repository;

    public function __construct(AttendenceReprository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        //
        $data=$this->repository->getAll();
        try{
            return $this->success(
                data:$data,
                message:"success to get data",

            );
        }catch(\Exception $e){
            return $this->failure(
                message:"error",
                error:$e->getMessage()
            );
        }
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $attendances = Attendance::with('user')->get();
        try{
            return $this->success(
                data:$attendances,
                message:"success to create data",

            );
        }catch(\Exception $e){
            return $this->failure(
                message:"error",
                error:$e->getMessage()
            );
        }    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d',
            'check_in_time' => 'required|date_format:Y-m-d H:i:s',
            'check_out_time' => 'required|date_format:Y-m-d H:i:s|after:check_in_time',
            'status' => 'required|string',]);
            if ($validator->fails()) {
                return $this->failure(
                    message:"error to validate",
                    error:$validator->errors()->first()
                );
                }
           
            try{
              
                $attendances=  $this->repository->create($validator->validated());

                return $this->success(
                    data:$attendances,
                    message:"success to store data",
                    
    
                );
            }catch(\Exception $e){
                return $this->failure(
                    message:"error",
                    error:$e->getMessage()
                
                );
            }    
    
            
           
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
        $update=Attendance::findorfail($attendance->id);
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d',
            'check_in_time' => 'required|date_format:Y-m-d H:i:s',
            'check_out_time' => 'required|date_format:Y-m-d H:i:s|after:check_in_time',
            'status' => 'required|string',]);
            if ($validator->fails()) {
                return $this->failure(
                    message:"error to validate",
                    error:$validator->errors()->first()
                );
                }
               

               try{
              
                $update=  $this->repository->update($attendance->id,$validator->validated());

                return $this->success(
                    data:$update,
                    message:"success to update data",
    
                );
            }catch(\Exception $e){
                return $this->failure(
                    message:"error",
                    error:$e->getMessage()
                );
            }    
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
        try{
            $this->repository->delete($attendance->id);
            return $this->success(
                message:"success to delete data",
    
            );

        }catch(\Exception $e){
            return $this->failure(
                message:"error",
                error: $e->getMessage(),
            );
        }
    }
}
