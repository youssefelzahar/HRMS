<?php
namespace App\ControllerRepo;
use App\BaseRepo\BaseRpo;

use App\Models\Documents;
class DocumentsRepository extends BaseRpo{
    public function __construct(Documents $documents){
       parent::__construct($documents);
    }
}