<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Http\Controllers\Controller;
use App\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\ControllerRepo\RoleReprositroy;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ResponseTrait
    ;
    protected $reprository;
    public function __construct(RoleReprositroy $reprository){
        $this->reprository=$reprository;}
    public function index()
    {
        //
        $data=$this->reprository->getAll();
        return $this->success($data,'success to get data');
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
        $validator=Validator::make($request->all(),[
            
            'name'=>'required',
            'description'=>'required',
        ]);

        if($validator->fails()){
            return $this->failure("not validate",$validator->errors());}

        try{
            $roles=$this->reprository->create($validator->validated());
            return $this->success($roles,'success to store data');
        }catch(\Exception $e){
            return $this->failure("faild to store",$e->getMessage());
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roles $roles)
    {
        //
        $update=Roles::findorfail($roles->id);
        $validator=Validator::make($request->all(),[
            'name'=>'nullable|required',
            'description'=>'nullable|required',
        ]);
        if($validator->fails()){
            return $this->failure("not validate",$validator->errors());
        }    

        try{
            $update=$this->reprository->update($roles->id,$validator->validated());
            return $this->success($update,'success to update data');

        }catch(\Exception $e){
            return $this->failure("faild to update",$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roles $roles)
    {
        //
        try{
            $roles=$this->reprository->delete($roles->id);
            return $this->success($roles,'success to delete data');
        }catch(\Exception $e){
            return $this->failure("faild to delete",$e->getMessage());
        }
    }
}
