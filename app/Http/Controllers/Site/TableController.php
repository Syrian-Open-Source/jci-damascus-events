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
     * @author karam mustafa
     */
    public function show(Event $event)
    {
        $data = $event->load('foodTables', 'foodTables.chairTable', 'foodTables.chairTable.user')->foodTables;

        $canNotRegister = $this->checkIfRegisteredBefore($event->id);

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
     * @return void
     * @author karam mustafa
     */
    public function registerInTable(Request $request, FoodTable $foodTable)
    {
        $canNotRegister = $this->checkIfRegisteredBefore($foodTable->event_id);

        if ($canNotRegister) {
            session()->flash('error', 'you have registered in this event before');
            return redirect()->back();
        }
        dd(ChairTable::where('food_table_id', $foodTable->id)->count());
        ChairTable::where('food_table_id', $foodTable->id)
            ->whereNull('user_id')
            ->first()
            ->update([
            'user_id' => Auth::user()->id,
        ]);

        session()->flash('success', 'your registration has been added successfully');
        return redirect()->back();
    }

    /**
     * check if the user was registered in an event before.
     *
     * @param  int  $eventId
     *
     * @return mixed
     * @author karam mustafa
     */
    private function checkIfRegisteredBefore($eventId)
    {
        return ChairTable::where('user_id', Auth::user()->id)
            ->whereHas('foodTable', function ($q) use ($eventId) {
                $q->where('event_id', $eventId);
            })->exists();
    }
}
