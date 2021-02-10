<?php

Route::prefix('v1')
    ->middleware('auth.basic.once:api,key')
    ->namespace('v1')
    ->group(base_path('routes/api/v1.php'));
