<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $primaryKey = ['title', 'from_date'];
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();

        if(!is_array($keys))return parent::setKeysForSaveQuery($query);

        foreach($keys as $keyName)$query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null){
        if(is_null($keyName)) $keyName = $this->getKeyName();
        if (isset($this->original[$keyName]))return $this->original[$keyName];

        return $this->getAttribute($keyName);
    }


    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
