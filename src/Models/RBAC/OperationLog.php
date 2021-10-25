<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{
    protected $table = 'rbac_operation_log';

    protected $fillable = [
        'user_id', 'path', 'method', 'ip', 'input', 
    ];
}
