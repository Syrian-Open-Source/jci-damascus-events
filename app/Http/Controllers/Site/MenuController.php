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
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @author karam mustafa
     */
    public function save(Request $request, Menu $menu)
    {
        $itemIds = $request->get('selected') ?? [];

        $this->checkIfEmpty($itemIds, trans('global.at_least_one'));

        $this->checkIfRegisteredBeforeInMenu($menu);

        Auth::user()->menuItems()->attach($itemIds);

        session()->flash('success', 'your chooses have been added successfully');

        return redirect()->back();

    }

    /**
     * description
     *
     * @param $menu
     *
     * @throws \Exception
     * @author karam mustafa
     */
    private function checkIfRegisteredBeforeInMenu($menu)
    {
        $registeredBefore = MenuItemMember::where('user_id', Auth::user()->id)
                ->whereHas('menuItem', function ($q) use ($menu) {
                    $q->where('menu_id', $menu->id);
                })
                ->count() != 0;

        if ($registeredBefore) {
            throw new \Exception('you have already registered in this menu before, we are working to add a new feature that makes you able to edit your chooses.');
        }
    }

    /**
     * description
     *
     * @param  array  $items
     * @param  string  $message
     *
     * @throws \Exception
     * @author karam mustafa
     */
    private function checkIfEmpty(array $items, string $message)
    {
        if (!sizeof($items)) {
            throw new \Exception($message);
        }
    }
}
