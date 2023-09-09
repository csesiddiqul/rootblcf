<?php

namespace App\Http\Controllers;

use App\Content;
use App\Http\Requests\CreateMenuRequest;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menus'] = Menu::bySchool(Auth::user()->school->id)->get();
        return view('menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent = Menu::where('status', 1)->byschool(\auth()->user()->school_id)->orderBy('name', 'asc')->pluck('name', 'id');
        return view('menu.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMenuRequest $request)
    {
        $tb = new Menu();
        $tb->school_id = auth()->user()->school_id;
        $tb->name = $request['name'];
        $tb->parent = $request['parent'] ?? 0;
        $tb->url = ($request['url'] == 1 ? 1 : 2);
        $tb->slug = (empty($request['slug']) ? Str::slug($request['name']) : Str::slug($request['slug']));
        if (strtolower($request['name']) == 'notice' || strtolower($request['name']) == 'notices')
            $tb->type = 1;
        $tb->priority = $request['priority'] ?? '';
        $tb->status = $request['status'];
        $tb->save();
        toast(transMsg('Created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        if ($menu->school_id != Auth::user()->school_id) {
            return redirect()->back();
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $school_id = Auth::user()->school_id;
        if ($menu->school_id != $school_id) {
            return redirect()->back();
        }
        $data['parent'] = Menu::bySchool($school_id)->where('status', 1)->orderBy('name', 'asc')->pluck('name', 'id');
        $data['menu'] = $menu;
        return view('menu.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMenuRequest $request, Menu $menu)
    {
        $school_id = Auth::user()->school_id;
        if ($menu->school_id != $school_id) {
            return redirect()->back();
        }
        $menu->name = $request->name;
        $menu->parent = $request->parent ?? 0;
        if ($menu->type == 2) {
            $menu->slug = (empty($request['slug']) ? Str::slug($request['name']) : Str::slug($request['slug']));
        }
        $menu->url = ($request['url'] == 1 ? 1 : 2);
        $menu->priority = $request->priority;
        $menu->status = $request->status;
        $menu->save();
        toast(transMsg('Update successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->type == 2) {
            $content = Content::whereMenu_id($menu->id)->first();
            if (\Request::ajax() && \request()->isMethod('DELETE')) {
                if (request()->reConfirm == 1) {
                    $content->delete();
                    $menu->delete();
                }
                session()->forget('menusContent');
                return response()->json(['status' => '200']);
            } else {
                if ($content) {
                    session()->put('menusContent', $menu);
                } else {
                    $menu->delete();
                    session()->forget('menusContent');
                    toast(transMsg('Delete successfully'), 'success')->timerProgressBar();
                }
            }
        }
        return redirect()->route('academic.menu.index');
    }
}
