<?php

namespace App\Http\Controllers;

use App\Models\TrainingSessions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use     Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\ResponseTrait;
use App\ControllerRepo\TrainingSesionsReprository;
use App\Http\Requests\TranningSessionRequest;
class TrainingSessionsController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */

     protected $reprository;

     public function __construct(TrainingSesionsReprository $reprository){
         $this->reprository=$reprository;
     }
    public function index()
    {
        //
        $index=$this->reprository->getAll();
        return $this->success($index, 'success to get data');
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
    public function store(TranningSessionRequest $request)
    {
        //
      
        try{
            $trainingSessions=$this->reprository->create($request->validated());
            return $this->success($trainingSessions, 'success to store data');
        }catch(\Exception $e){
            return $this->failure("faild to store",$e->getMessage());
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingSessions $trainingSessions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingSessions $trainingSessions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TranningSessionRequest $request, TrainingSessions $trainingSessions)
    {
        //
        try {
            $update = TrainingSessions::findOrFail($trainingSessions->id);
        } catch (\Exception $e) {
            // Log error and return failure response
            \Log::error('Failed to find salary record:', ['error' => $e->getMessage()]);
            return $this->failure(
                $message = "Record not found",
                error: $e->getMessage(),
            );
        }

        try{
           // $update=TrainingSessions::findorfail($trainingSessions->id);

            $update=$this->reprository->update($trainingSessions->id,$request->validated());
            return $this->success($update, 'success to update data');
        }catch(\Exception $e){
            return $this->failure("faild to uopdate",$e->getMessage());
            
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingSessions $trainingSessions)
    {
        //
        $this->reprository->delete($trainingSessions->id);
        return $this->success($trainingSessions, 'success to delete data');
    }
}
