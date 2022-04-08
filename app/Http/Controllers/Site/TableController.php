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

        $isRegisteredBefore = ChairTable::where('user_id', Auth::user()->id)
            ->whereHas('foodTable', function ($q) use ($event) {
                $q->where('event_id', $event->id);
            })->exists();

        $canNotRegister = $isRegisteredBefore;

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
        ChairTable::where('food_table_id', $foodTable->id)->update([
            'user_id' => Auth::user()->id,
        ]);

        session()->flash('success', 'your registration has been added successfully');
        return redirect()->back();
    }
}
