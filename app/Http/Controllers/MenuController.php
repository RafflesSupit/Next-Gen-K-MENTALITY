<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all()->groupBy('category');
        return view('menu',compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Menu::select('category')->distinc()->pluck('category');
        return view('admin.menu.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validated([
            'name' => 'required|string|max =>255',
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|between:0.99999999.99',
            'image'=> 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);
    
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('menus','public');
            $validated['image'] = $imagePath;
        }
    
        Menu::create($validated);
    
        return redirect()->route('admin.dashboard')->with('success', 'Menu item added succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Menu::select('category')->distinc()->pluck('category');
        
        return view('admin.menu.edit', compact('menu','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validated([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|between:0.99999999.99',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);
    
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('menus','public');
            $validated['image'] = $imagePath;
        }
    
        $menu = Menu::findOrFail($id);
        $menu->update($validated);
    
        return redirect()->route('admin.dashboard')->with('success', 'Menu item updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Menu item deleted succesfully');
    }
}
