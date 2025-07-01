<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class DocsController extends Controller
{
    public function index()
    {
        $apiRoutes = config('api-docs');
        return view('api-docs.index', compact('apiRoutes'));
    }
    
    public function json()
    {
        return response()->json(config('api-docs'));
    }
}