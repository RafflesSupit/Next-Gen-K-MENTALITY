<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all()->groupBy('category');
        return view('menu', compact('menus'));
    }

    public function admin_index()
    {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $menu = Menu::create($validated);

        return redirect()->route('menu.index')->with('success', 'Menu item added successfully.');
    }

    public function create()
    {
        $categories = Menu::select('category')->distinct()->pluck('category');
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|between:0,99999999.99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'category' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
            $validated['image'] = $imagePath;
        }

        Menu::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Menu item added successfully.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Menu::select('category')->distinct()->pluck('category');
        return view('admin.menu.edit', compact('menu','categories'));
    }

    public function update(Request $request, $id)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|between:0,99999999.99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'category' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
            $validated['image'] = $imagePath;
        }

        $menu = Menu::findOrFail($id);
        $menu->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Menu item updated successfully.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Menu item deleted successfully.');
    }
}