<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EventCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Event::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/event');
        CRUD::setEntityNameStrings('event', 'events');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('title');
        CRUD::column('description');
        CRUD::column('cover');
        CRUD::column('start_date');
        CRUD::column('end_date');
        CRUD::column('is_active');


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EventRequest::class);

        // CRUD::field('title');
        // CRUD::field('description');
        // CRUD::field('cover');
        // CRUD::field('start_date');
        // CRUD::field('end_date');
        // CRUD::field('is_active');

        $this->crud->addField([
            'name' => 'title',
            'type' => 'text',
            'label' => "Title"
        ]);
        $this->crud->addField([
            'name' => 'description',
            'type' => 'text',
            'label' => "Description"
        ]);
        $this->crud->addField([
            'name' => 'cover',
            'type' => 'upload',
            'label' => "Cover",
            'upload' => true,
            'disk' => 'public',
        ]);
        $this->crud->addField([
            'name' => 'start_date',
            'label' => "Start Date",
            'type'  => 'date_picker',
        ]);
        $this->crud->addField([
            'name' => 'end_date',
            'label' => "End Date",
            'type'  => 'date_picker',
        ]);
        $this->crud->addField([
            'name' => 'is_active',
            'type' => 'checkbox',
            'label' => "Is Active ?"
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if ($event->chairs->count() == 0){
            $event->menus()->delete();
            $event->foodTables()->delete();
            return $this->crud->delete($id);
        }
    }
}
