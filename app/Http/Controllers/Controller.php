<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $defaultPageSize = 30;

    protected $page_size;

    public function __construct(Request $request)
    {
        $this->page_size = $request->has('page_size')
                                ? $request->page_size
                                : $this->defaultPageSize;
    }

}
