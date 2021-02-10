<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function whoami(Request $request)
    {
        return response()->json($request->user());
    }

}
