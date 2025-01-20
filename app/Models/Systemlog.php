<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $table = 'SystemLog';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'entityName',
        'entityOperation',
        'OperationDescription',
        'Datetime'
    ];
}
