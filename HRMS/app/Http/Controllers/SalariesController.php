<?php

namespace App\Http\Controllers;

use App\Models\Salaries;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ResponseTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use App\ControllerRepo\SalariesRepository;
use App\Http\Requests\SalariesRequest;
class SalariesController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     */
    
     protected $repository;

     public function __construct(SalariesRepository $repository)
     {
         $this->repository = $repository;
     }
    public function index()
    {
        //
        $index=$this->repository->getAll();
        return$this->success(
           $data=$index,
           $message="success to get data",
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $create=Salaries::with('employee.user')->get();
        return$this->success(
            $data=$create,
            $message="success to create data",
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalariesRequest $request)
    {
        //
       
             try{
                $salarries=$this->repository->create($request->validated());
                return $this->success(
                    data:$salarries,
                    message:"success to store data",
                ) ;   
             }   catch(\Exception $e){
                return$this->failure(
                    $message="failed to store data",error:$e->getMessage());
             }
          

    }

    /**
     * Display the specified resource.
     */
    public function show(Salaries $salaries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salaries $salaries)
    {
        //
         $salaries->find($salaries->id);
        return$this->success(
            $data=$salaries,
            $message="success to edit data",
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalariesRequest $request, Salaries $salaries)
    {
    
        try {
            $updatedSalary = Salaries::findOrFail($salaries->id);
        } catch (\Exception $e) {
            // Log error and return failure response
            \Log::error('Failed to find salary record:', ['error' => $e->getMessage()]);
            return $this->failure(
                $message = "Record not found",
                error: $e->getMessage(),
            );
        }
    
   
    
        try {
            $updatedSalary= $this->repository->update($salaries->id,$request->validated());
    
           return $this->success(
               $message = "success to update data",
               $data = $updatedSalary,
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
    public function destroy(Salaries $salaries)
    {
        //
        try{
        
            $this->repository->delete($salaries->id);
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
