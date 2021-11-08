<?php

namespace GepengPHP\LaravelRBAC\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GepengPHP\LaravelRBAC\Models\RBAC\OperationLog;

class OperationLogController extends Controller
{
    public function index(Request $request)
    {
        $pager = OperationLog::with('user')
            ->filter($request->filled('filter.path'),    'path',    'LIKE', "%{$request->input('filter.path')}%")
            ->filter($request->filled('filter.method'),  'method',  $request->input('filter.method'))
            ->filter($request->filled('filter.user_id'), 'user_id', $request->input('filter.user_id'))
            ->filter($request->filled('filter.ip'),      'ip',      $request->input('filter.ip'))
            ->filter($request->filled('filter.created_at.start'), 'created_at', '>=', $request->input('filter.created_at.start'))
            ->filter($request->filled('filter.created_at.end'),   'created_at', '<',  $request->input('filter.created_at.end'))
            ->orderBy('id', 'DESC')
            ->paginate($request->post('per_page', 10));
        return response()->RBACSuccess($pager->toArray());
    }
}
