<?php

namespace App\Models\Tatuco;

use Illuminate\Database\Eloquent\Model;

class TatucoModel extends Model
{
    public $_table;
    public $_model;
    public $_primaryKey;
    public $_timestamps;
    public $_create;

    public function __construct($_model, $_primaryKey, $_table, $_timestamps,$_create)
    {
        $this->_model = $_model;
        $this->_primaryKey = $_primaryKey;
        $this->_table = $_table;
        $this->_timestamps = $_timestamps;
        $this->_create = $_create;
    }

   /* protected $table = $this->_table;

    protected $timestamps = $this->_timestamps?:true;

    protected $primaryKey = $this->_primaryKey;*/

   


    public function getModelTatuco()
    {
        return $this->_model;
    }

    public function createJson(){
        
        return response()->json(array_merge($create = [
        /*'id' => 'integer',
        'created_at' => 'date',
        'updated_at' => 'date'*/
        ], $this->_create));
    }
   
}
