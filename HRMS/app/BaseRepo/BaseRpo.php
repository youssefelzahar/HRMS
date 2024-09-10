<?php
namespace App\BaseRepo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\interface\BaseInterface;
use Illuminate\Support\Facades\DB; 

class BaseRpo implements BaseInterface{

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function getAll(){
        $cacheKey = 'all_' . class_basename($this->model);

        // Use Cache::remember to cache the results
        return Cache::remember($cacheKey, 3600, function () {
            return $this->model->all();
        });
    }   

    public function find($id){ 
        return $this->model->find($id);
    }

  public function create(array $data)
{
  return DB::transaction(function () use ($data) {
        
    $created=$this->model->create($data);
    Cache::forget('all_' . class_basename($this->model));
    return $created;
  },5);
}

public function update($id, array $data)
{
    return DB::transaction(function () use ($id, $data) {
        // Find the current version
        $current = $this->model->find($id);

        // Copy the current record into a new version
        $newVersion = $current->replicate();
        $newVersion->version += 1;
        $newVersion->save();

        // Update the new version
        $newVersion->update($data);

        Cache::forget('all_' . class_basename($this->model));
        return $newVersion;
    });
}



public function delete($id)
{
   $deleted= $this->model->destroy($id);
    Cache::forget('all_' . class_basename($this->model));
    return $deleted;
}  }