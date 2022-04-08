<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuItemMember;
use App\Models\User;
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
     * @param  \App\Models\Menu  $menu
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @author karam mustafa
     */
    public function save(Request $request, Menu $menu)
    {
        $itemIds = $request->get('selected') ?? [];
        if (!sizeof($itemIds)) {
            session()->flash('error', 'please specify at least one element to store it.');
            return redirect()->back();
        }

        $registeredBefore = MenuItemMember::where('user_id', Auth::user()->id)
                ->whereHas('menuItem', function ($q) use($menu) {
                    $q->where('menu_id', $menu->id);
                })
                ->count() != 0;
        if ($registeredBefore) {
            session()->flash('error', 'you have already registered in this menu before, we are working to add a new feature that makes you able to edit your chooses.');
            return redirect()->back();
        }

        Auth::user()->menuItems()->attach($itemIds);

        session()->flash('success', 'your chooses have been added successfully');
        return redirect()->back();

    }
}
