<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        $domainId = $request->get('domain_id');

        return response()->json(['message' => 'Welcome to Home', 'domain_id' => $domainId]);
    }
}