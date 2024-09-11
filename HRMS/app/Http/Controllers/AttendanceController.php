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
use App\Http\Requests\AttendanceRequest;
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
    public function store(AttendanceRequest $request)
    {
        //
           
            try{
              
                $attendances=  $this->repository->create($request->validated());

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
    public function update(AttendanceRequest $request, Attendance $attendance)
    {
        //
        $update=Attendance::findorfail($attendance->id);
     
               
               try{
              
                $update=  $this->repository->update($attendance->id,$request->validated());

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
