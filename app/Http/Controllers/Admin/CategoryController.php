<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('admin.category.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.category.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCategoryRequest $request)
  {
    try {
      // Start a database transaction
      DB::beginTransaction();

      Category::create([
        'name' => $request->input('name'),
      ]);

      // Commit the transaction
      DB::commit();

      // Redirect back with success message or any other action
      return redirect()->route('category.index')->with('success', 'Category saved successfully.');
    } catch (\Exception $e) {
      // Rollback the transaction if an exception occurs
      DB::rollBack();

      // Redirect back with error message or any other action
      return redirect()->back()->with('error', 'An error occurred while saving the category.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $category = Category::findOrFail(Crypt::decrypt($id));
    $encryptedId = Crypt::encrypt($category->id);
    return view('admin.category.show', compact('category', 'encryptedId'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $category = Category::findOrFail(Crypt::decrypt($id));
    $encryptedId = Crypt::encrypt($category->id);
    return view('admin.category.edit', compact('category', 'encryptedId'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StoreCategoryRequest $request, string $id)
  {
    try {
      // Start a database transaction
      DB::beginTransaction();
      $category = Category::findOrFail(Crypt::decrypt($id));

      $category->update([
        'name' => $request->input('name'),
      ]);

      // Commit the transaction
      DB::commit();

      // Redirect back with success message or any other action
      return redirect()->route('category.index')->with('success', 'Category saved successfully.');
    } catch (\Exception $e) {
      // Rollback the transaction if an exception occurs
      DB::rollBack();

      // Redirect back with error message or any other action
      return redirect()->back()->with('error', 'An error occurred while saving the category.');
    }
  
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($category)
  {
    try {
      // Use a database transaction
      DB::beginTransaction();

      // Find the category by ID
      $category = Category::findOrFail(Crypt::decrypt($category));

      // Delete the category record
      $category->delete();

      // Commit the transaction
      DB::commit();

      return redirect()->route('category.index')->with('success', 'Category record deleted successfully!');
    } catch (\Exception $e) {
      // An error occurred, rollback the transaction
      DB::rollback();

      return redirect()->route('category.index')->withErrors(['error' => 'An error occurred while deleting the student record. Please try again.']);
    }
  }

  public function getCategories(Request $request)
  {
    if ($request->ajax()) {
      $model = Category::query();

      return DataTables::eloquent($model)
        ->addIndexColumn()
        ->addColumn('action', function ($category) {
          $encryptedId = Crypt::encrypt($category->id);
          return view('admin.category.action', compact('encryptedId'))->render();
        })
        ->escapeColumns([])
        ->toJson();
    } else {
      return view('handler.404');
    }
  }
}
