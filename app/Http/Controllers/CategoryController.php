<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        Category::create([
            'nom' => $validated['nom'],
            'slug' => Str::slug($validated['nom']),
            'description' => $validated['description'] ?? null,
            'active' => $validated['active'] ?? true,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée avec succès!');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom,' . $category->id,
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        $category->update([
            'nom' => $validated['nom'],
            'slug' => Str::slug($validated['nom']),
            'description' => $validated['description'] ?? null,
            'active' => $validated['active'] ?? true,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour avec succès!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée avec succès!');
    }
}
