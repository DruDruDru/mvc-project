<?php

namespace Middlewares;

use Src\Right\Right;
use Src\Request;

class RightMiddleware
{
    public function handle(Request $request)
    {
        if (!Right::suitableRight('admin')) {
            app()->route->redirect('/hello');
        }
    }
}
