<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{
    protected $table = 'rbac_operation_log';

    protected $fillable = [
        'user_id', 'path', 'method', 'ip', 'input', 
    ];

    //protected $appends = [ 'input_format' ];

    public function user()
    {
        // todo 目前写死的 User model，需要改成可配置的
        return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

    public function scopeFilter(\Illuminate\Database\Eloquent\Builder $query, bool $bool, ...$parameters)
    {
        $bool && $query->where(...$parameters);
    }

    public function getInputFormatAttribute()
    {
        return \json_encode(\json_decode($this->input, true) , JSON_PRETTY_PRINT);
    }
}
