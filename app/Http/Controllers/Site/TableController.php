<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ChairTable;
use App\Models\Event;
use App\Models\FoodTable;
use App\Models\Menu;
use App\Models\MenuItemMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{

    /**
     * show all menus inside specific event.
     *
     * @param  \App\Models\Event  $event
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     * @author karam mustafa
     */
    public function show(Event $event)
    {
        $data = $event->load('foodTables', 'foodTables.chairTable', 'foodTables.chairTable.user')->foodTables;

        $canNotRegister = $this->checkIfRegisteredBefore($event->id, false);

        return view('pages.tables.show', [
            'data' => $data,
            'canNotRegister' => $canNotRegister,
        ]);
    }

    /**
     * show all menus inside specific event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FoodTable  $foodTable
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @author karam mustafa
     */
    public function registerInTable(Request $request, FoodTable $foodTable)
    {
        $this->checkIfRegisteredBefore($foodTable->event_id);

        $chair = $this->checkIfFoodTableHasAvailableChair($foodTable);

        $chair->update(['user_id' => Auth::user()->id]);

        session()->flash('success', trans('global.registration_success'));

        return redirect()->back();
    }

    /**
     * check if the user was registered in an event before.
     *
     * @param  int  $eventId
     *
     * @param  bool  $throwError
     *
     * @return mixed
     * @throws \Exception
     * @author karam mustafa
     */
    private function checkIfRegisteredBefore($eventId, $throwError = true)
    {
        $registered = ChairTable::where('user_id', Auth::user()->id)
            ->whereHas('foodTable', function ($q) use ($eventId) {
                $q->where('event_id', $eventId);
            })->exists();

        if ($registered && $throwError) throw new \Exception(trans('global.registered_before'));

        return $registered;
    }

    /**
     * check if the food table has an available chair or not, if not, we throw error
     *
     * @param  \App\Models\FoodTable  $foodTable
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @author karam mustafa
     */
    private function checkIfFoodTableHasAvailableChair(FoodTable $foodTable)
    {
        $chair = ChairTable::where('food_table_id', $foodTable->id)
            ->whereNull('user_id')
            ->first();

        if (!$chair) throw new \Exception(trans('global.chair_not_available'));

        return $chair;
    }
}
