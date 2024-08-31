<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\ResponseTrait;
use App\interface\BaseInterface;
use App\ControllerRepo\DepartementRepository;
class DepartmentsController extends Controller
{
    use ResponseTrait;
    protected $repository;

    public function __construct(DepartementRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){

       $index = $this->repository->getAll();
       return $this->success(
           data:$index,
           message:"success to get data",
       );
        
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $departments = Departments::with('user')->get();
        return $this->success(
            data:$departments,
            message:"success to create data",

        );    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator=Validator::make($request->all(),[
              'name'=>'required',
              'description'=>'required'
        ]);

        if ($validator->fails()) {
            return $this->failure(
                message:"error to validate",error:$validator->errors()->first()
            );
            }
       
        try{
          
            $departments=  $this->repository->create($validator->validated());

            return $this->success(
                data:$departments,
                message:"success to store data",

            );
        }catch(\Exception $e){
            return $this->failure(
                message:"error",error:$e->getMessage()
            );
        }    
    }

    /**
     * Display the specified resource.
     */
    public function show(Departments $departments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departments $departments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departments $departments)
    {
        //
        $updatedepartments=Departments::findorfail($departments->id);
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'description'=>'required'
      ]);

      if ($validator->fails()) {
          return $this->failure(
              message:"error to validate",error:$validator->errors()->first()
          );
          }
        try{  
            $updatedepartments=$this->repository->update($departments->id,$validator->validated());
            return $this->success(
                data:$updatedepartments,
                message:"success to update data",
            );

        }catch(\Exception $e){
            return $this->failure(
               message:"faild to update",error:$e->getMessage()
            );    
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departments $departments)
    {
        //
        try{
            $this->repository->delete($departments->id);
           return $this->success(message:"success to delete data");
        }catch(\Exception $e){
            return$this->failure(message:"failed to delete data",error:$e->getMessage());
        }
    }
}
