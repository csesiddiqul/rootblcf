<?php

namespace App\Http\Controllers;

use App\Content;
use App\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['contents'] = Content::bySchool(Auth::user()->school->id)->get();
        return view('content.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu'] = Menu::where('school_id', Auth::user()->school->id)->where('type', 2)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))->from('contents')->whereRaw('menus.id = contents.menu_id');
            })
            ->selectRaw('CONCAT(UCASE(LEFT(name, 1)),SUBSTRING(name, 2)) as menuName,id')->pluck('menuName', 'id');
        return view('content.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'menu_id' => 'required|numeric',
        ], [
            'menu_id.required' => transMsg('Menu name is required')
        ]);
        if (Content::whereMenu_id($request->menu_id)->exists()) {
            return redirect()->route('contact.index');
        }
        $tb = new Content();
        $tb->school_id = auth()->user()->school_id;
        $tb->menu_id = $request['menu_id'];
        $tb->title = $request['title'];
        $tb->description = $request['description'];
        $tb->image = (!empty($request->url)) ? fileUpload($request->url, 'CI') : '';
        $tb->save();
        toast(transMsg('Content Created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.content.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Content $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Content $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        if ($content->school_id != Auth::user()->school_id) {
            return redirect()->back();
        }
        $menu = Menu::bySchool(Auth::user()->school->id)->where('type', 2)
            ->whereNotExists(function ($query) use ($content) {
                $query->select(DB::raw(1))->from('contents')
                    ->whereRaw('menus.id = contents.menu_id AND contents.id != ' . $content->id);
            })->selectRaw('CONCAT(UCASE(LEFT(name, 1)),SUBSTRING(name, 2)) as name,id')->pluck('name', 'id');
        if ($content->menu->slug == 'chairman-message' || $content->menu->slug == 'headteacher-message') {
            $menu = $menu->prepend($content->menu->name, $content->menu->id);
        }
        $data['menu'] = $menu;
        $data['content'] = $content;
        return view('content.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Content $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        request()->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'menu_id' => 'required|numeric',
        ], [
            'menu_id.required' => transMsg('Menu name is required')
        ]);
        if ($content->menu_id != $request->menu_id) {
            if (Content::whereMenu_id($request->menu_id)->exists() || $content->school_id != Auth::user()->school_id) {
                return redirect()->back();
            }
        }

        $content->school_id = auth()->user()->school_id;
        $content->title = $request->title;
        $content->description = $request->description;
        $content->menu_id = $request->menu_id;
        if (!empty($request->url)) {
            unlinkS3File($content->image);
            $content->image = fileUpload($request->url, 'CI');
        }
        $content->save();
        toast(transMsg('Content Update successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.content.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Content $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        unlinkS3File($content->image);
        if ($content->school_id == Auth::user()->school_id) {
            $content->delete();
        }
        toast(transMsg('Content Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.content.index');
    }
}
