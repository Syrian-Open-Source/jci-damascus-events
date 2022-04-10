<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Route;

trait CommentOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupCommentRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/comment', [
            'as'        => $routeName.'.comment',
            'uses'      => $controller.'@comment',
            'operation' => 'comment',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupCommentDefaults()
    {
        $this->crud->allowAccess('comment');

        $this->crud->operation('comment', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            // $this->crud->addButton('top', 'comment', 'view', 'crud::buttons.comment');
            // $this->crud->addButton('line', 'comment', 'view', 'crud::buttons.comment');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function comment()
    {
        $this->crud->hasAccessOrFail('comment');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'comment '.$this->crud->entity_name;

        // load the view
        return view("crud::operations.comment", $this->data);
    }
}
