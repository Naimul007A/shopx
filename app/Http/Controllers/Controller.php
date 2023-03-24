<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function SetsuccessMessage( $message ) {
        session()->flash( 'message', $message );
        session()->flash( 'type', 'success' );
    }
    protected function SeterrorMessage( $message ) {
        session()->flash( 'message', $message );
        session()->flash( 'type', 'danger' );
    }
}