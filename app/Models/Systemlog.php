<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class systemLog extends Model
{
    protected $table = 'systemLog';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'entityName',
        'entityOperation',
        'OperationDescription',
        'Datetime'
    ];
}
