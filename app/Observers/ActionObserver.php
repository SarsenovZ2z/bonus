<?php

namespace App\Observers;

use App\Models\Action;

class ActionObserver
{

    public function creating(Action $action)
    {
        if ($responsibe = \Auth::user()) {
            $action->responsible()->associate($responsibe);
        }
    }

}
