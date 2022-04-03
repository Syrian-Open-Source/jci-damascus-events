<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Menu;
use App\Models\MenuItemMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
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
        return view('pages.menus.show', ['data' => $event->load('menus', 'menus.menuItems')->menus]);
    }

    /**
     * show all menus inside specific event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $event
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @author karam mustafa
     */
    public function save(Request $request, Menu $event)
    {
        $itemIds = $request->get('selected') ?? [];

        if (!sizeof($itemIds)) {
            session()->flash('error', 'please specify at least one element to store it.');
            return redirect()->back();
        }

        $data = collect($itemIds)->map(function ($id){
            return [
                'user_id' => Auth::user()->id,
                'menu_item_id' => $id,
            ];
        })->toArray();

        MenuItemMember::insert($data);

        session()->flash('success', 'your chooses were add successfully');

        return redirect()->back();

    }
}
