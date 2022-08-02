<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class TradeTrackerException extends Exception
{
    public function __construct($message = '', $code = 0)
    {
        parent::__construct($message, $code);
    }

    /**
     * Render the exception as an HTTP response.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function render($request)
    {
        return back()->with('error', $this->getMessage());
    }
}
