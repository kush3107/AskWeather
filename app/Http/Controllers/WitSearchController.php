<?php

namespace App\Http\Controllers;

use App\Services\WitService;
use Illuminate\Http\Request;

class WitSearchController extends Controller
{
    private $witService;

    public function __construct()
    {
        $this->witService = new WitService();
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $res = $this->witService->getEntities($query);
        dd($res);
    }
}
