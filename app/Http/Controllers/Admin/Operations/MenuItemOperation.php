<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait MenuItemOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupMenuItemRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/menuitem', [
            'as'        => $routeName.'.menuitem',
            'uses'      => $controller.'@menuitem',
            'operation' => 'menuitem',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupMenuItemDefaults()
    {
        $this->crud->allowAccess('menuitem');

        $this->crud->operation('menuitem', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButton('top', 'menuitem', 'view', 'crud::buttons.menuitem');
            // $this->crud->addButton('line', 'menuitem', 'view', 'crud::buttons.menuitem');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function menuitem()
    {
        $this->crud->hasAccessOrFail('menuitem');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'menuitem '.$this->crud->entity_name;

        // load the view
        return view("crud::operations.menuitem", $this->data);
    }
}
