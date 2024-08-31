<?php
namespace App\BaseRepo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\interface\BaseInterface;
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
    $created=$this->model->create($data);
    Cache::forget('all_' . class_basename($this->model));
    return $created;
}

public function update($id, array $data)
{
    $updated=$this->model->where('id', $id)->update($data);
    Cache::forget('all_' . class_basename($this->model));
    return $updated;
}

public function delete($id)
{
   $deleted= $this->model->destroy($id);
    Cache::forget('all_' . class_basename($this->model));
    return $deleted;
}  }