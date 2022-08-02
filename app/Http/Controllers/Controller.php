<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $mode = 'light-layout';

    public function __construct()
    {
        if(isset($_COOKIE['ltt-mode'])) {
            $this->mode = $_COOKIE['ltt-mode'];
        }

        if($this->mode) {
            View::share('mode', $this->mode);
        }
    }
}
