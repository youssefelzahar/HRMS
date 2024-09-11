<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\ResponseTrait;
use App\ControllerRepo\DocumentsRepository;
use App\Http\Requests\DocumentsRequest;
class DocumentsController extends Controller
{ 
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
     protected $repository;
    public function __construct(DocumentsRepository $repository){
        $this->repository=$repository;
    }
    public function index()
    {
        //
        $index=$this->repository->getAll();
        return $this->success(
        data:$index,
        message:"success to get data");
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
    public function store(DocumentsRequest $request)
    {
        //

        try{
            $filePath = $request->file('file')->store('public/documents');
            $documents=$this->repository->create([
                'employee_id' => $request->employee_id,
                'document_type' => $request->document_type,
                'file_path' => $filePath,
                'uploaded_at' => $request->uploaded_at,

            ]);
            return $this->success(
                data:$documents,
                message:"success to store data",);
        }catch(\Exception $e){
            return $this->failure(
                message:"failed to store data",error:$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Documents $documents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documents $documents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DocumentsRequest $request, Documents $documents)
    {
        // Validate the request data

         
       

        try {
            // Find the document by ID using the repository
            $document = $this->repository->find($documents->id);

            if (!$document) {
                return response()->json(['message' => 'Document not found'], 404);
            }

            // Prepare the data for updating
            $updateData = $request->validated();

            // If a file is provided, store it and add the path to update data
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('uploads/documents', 'public');
                $updateData['file_path'] = $filePath;
            }
            $document->save();

            // Update the document using the repository
            $updatedDocument = $this->repository->update($documents->id, $updateData);

            return response()->json(['message' => 'Document updated successfully', 'data' => $updatedDocument], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update document'], 500);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documents $documents)
    {
        //
        try{
        $delete=$this->repository->delete($documents->id);
        return $this->success(
            data:$delete,
            message:"success to delete data");
        }
        catch(\Exception $e){
            return $this->failure(
                message:"failed to delete data",error:$e->getMessage());
        }   

    }
}
