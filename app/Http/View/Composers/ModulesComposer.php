<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ModulesComposer
{
    /**
     * Get Allowed User Abas
     *
     * @return array
     */
    public function getAllowedModules()
    {
        $modules = config('modules');

        return array_obj($modules);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('modules', $this->getAllowedModules());
    }
}
