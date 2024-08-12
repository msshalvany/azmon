<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});
Route::get('/register', function () {
    return view('register');
});

Route::get('/complete-info', function () {
    if (session()->has('email')) {
        return view('complete-info');
    } else {
        return redirect()->back();
    }
    return view('register');
});

Route::post('/get_email', [\App\Http\Controllers\UserController::class, 'get_email'])->name('get_email');
Route::post('/verify_email', [\App\Http\Controllers\UserController::class, 'verify_email'])->name('verify_email');
Route::post('/create_user', [\App\Http\Controllers\UserController::class, 'create_user'])->name('create_user');
Route::post('/login_user', [\App\Http\Controllers\UserController::class, 'login_user'])->name('login_user');


Route::get('/enter_exam/{id}', [\App\Http\Controllers\ExameController::class, 'enter_exam'])->name('enter_exam');
Route::get('/login_exam', [\App\Http\Controllers\ExameController::class, 'login_exam'])->name('login_exam');
Route::get('/exam/{id}', [\App\Http\Controllers\ExameController::class, 'exam'])->name('exam');
Route::post('/exam/send_answer', [\App\Http\Controllers\ExameController::class, 'send_answer'])->name('send_answer');


Route::middleware(\App\Http\Middleware\User::class)->prefix('/user')->group(function () {
    Route::get('/exame-ist', function () {
        $exame = \App\Models\exame::where('user_id',session()->get('user'))->get();
        return view('exame-list',['exame'=>$exame]);
    })->name('exame-list');

    Route::get('/make-exame', function () {
        return view('make-exame');
    })->name('make-exame');

    Route::post('/create_exame', [\App\Http\Controllers\ExameController::class, 'create_exame'])->name('create_exame');
    Route::delete('/del_exame/{id}', [\App\Http\Controllers\ExameController::class, 'del_exame'])->name('del_exame');
    Route::post('/edit_exame/{id}', [\App\Http\Controllers\ExameController::class, 'edit_exame'])->name('edit_exame');
    Route::get('/exame_edit_v/{id}', [\App\Http\Controllers\ExameController::class, 'exame_edit_v'])->name('exame_edit_v');
    Route::get('/result_exame/{id}', [\App\Http\Controllers\ExameController::class, 'result_exame'])->name('result_exame');

    Route::get('/que_list/{id}', function ($id) {
        $que = \App\Models\question::where('exame_id',$id)->get();
        return view('que_list',['que'=>$que,'exame_id'=>$id]);
    })->name('que_list');

//    Route::post('/create_que', [\App\Http\Controllers\ExameController::class, 'create_que'])->name('create_que');

    Route::get('/make_que/{id}', function ($id) {
        return view('make_que',['id'=>$id]);
    })->name('make_que');

    Route::post('/create_que/{id}', [\App\Http\Controllers\QuestionController::class, 'create_que'])->name('create_que');
    Route::get('/que_edit_v/{id}', [\App\Http\Controllers\QuestionController::class, 'que_edit_v'])->name('que_edit_v');
    Route::delete('/del_que/{id}', [\App\Http\Controllers\QuestionController::class, 'del_que'])->name('del_que');
    Route::post('/edit_que/{id}', [\App\Http\Controllers\QuestionController::class, 'edit_que'])->name('edit_que');
    Route::post('/importExel', [\App\Http\Controllers\QuestionController::class, 'importExel'])->name('importExel');
});
