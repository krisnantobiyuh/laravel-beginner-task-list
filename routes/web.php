<?php
use Illuminate\Http\Request;
use App\Task;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/task', function() {

    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('pages/task', [
        'tasks' => $tasks
    ]);

});

Route::post('/task', function(Request $request) {

    $validator = Validator::make( $request->all(), [
        'name' => 'required|max:225'
    ]);

    if ($validator->fails()) {
        return redirect('/task')
               ->withInput()
               ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/task');
});

Route::delete('/task/{id}', function($id) {

    Task::findOrFail($id)->delete();

    return redirect('/task');

});
