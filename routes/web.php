<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/categories', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:20',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $category = new Category;
    $category->name = $request->name;
    $category->save();

    return redirect('/category');
});


Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    $categories = Category::all();

    return view('tasks', [
        'tasks' => $tasks, 'categories' => $categories
    ]);
});
/**
 * Add New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:20',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->cat_id = $request->task_cat;
    $task->save();

    return redirect('/');
});

/**
 * Delete Task
 */
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();

    return redirect('/');
});


Route::get('/category', function () {
    $categories = Category::orderBy('created_at', 'asc')->get();

    return view('category', [
        'categories' => $categories
    ]);
});


Route::delete('/category/{category}', function (Category $category) {
    $category->delete();

    return redirect('/category');
});

Route::get('/catlist', function() {
    $cats = Category::all();

    return view('catList', [
        'cats' => $cats,
    ]);
});