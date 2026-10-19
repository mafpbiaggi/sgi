<?php

namespace App\Http\Controllers;

use App\Concerns\HandlesToastFeedback;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use HandlesToastFeedback;
    use AuthorizesRequests;
}
