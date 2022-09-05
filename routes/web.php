<?php

use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\http\Middleware\CheckAdmin;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\Incident;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\RapportController;

Auth::routes();
Route::redirect('/', 'login');

Route::get('logout', [UserController::class, 'doLogout']);
Route::get('/home', function () {
    return redirect()->route('home');
});
Route::prefix('dashboard')->group(function () {

    Route::get('/', [HomeController::class, 'index']);

    Route::group(['middleware' => 'auth'], function () {
        Route::post('gestion/calendar', [UserController::class, 'UpdateImage'])->name('gestion.calendrier');
                //Route for rapport
                Route::get('rapport/charge', [RapportController::class, 'showChargeForm'])->name('rapport.charge');
                Route::get('rapport/charge/print', [RapportController::class, 'printCharge'])->name('rapport.charge.print');


        // Route pour la gestion des profil
        Route::get('user/profile', [UserController::class, 'showProfile'])->name('user.profile');
        Route::post('user/updateInfos', [UserController::class, 'updateInfos'])->name('user.edit.infos');
        Route::post('user/updatepassword', [UserController::class, 'updatePassword'])->name('user.edit.password');
        Route::post('user/profile/image', [UserController::class, 'UpdateImage'])->name('user.profil.image');
        //Route for user only for active user with valid licence
        Route::get('home', [HomeController::class, 'index'])->name('home');

        Route::get('client/index',[ClientController::class,'index'])->name('client.all');
        Route::get('client/add', function () {
            return view('client/add');
        })->name('client.add');
        Route::post('client/store',[ClientController::class,'store'])->name('client.store');
        Route::get('client/edit/{id}',[ClientController::class,'showEditForm'])->name('client.edit');
        Route::post('client/update',[ClientController::class,'update'])->name('client.update');
        Route::post('client/delete',[ClientController::class,'delete'])->name('client.delete');
         //Route for incident
       Route::get('incidents/add',[IncidentController::class,'add'])->name('incident.add')   ;
       Route::get('incident/index',[IncidentController::class,'index'])->name('incident.all');
       Route::post('incident/store',[IncidentController::class,'store'])->name('incident.store');
       Route::get('incident/setDone/{id}',[IncidentController::class,'done'])->name('incident.done');
       Route::get('incident/encours/{id}',[IncidentController::class,'Encours'])->name('incident.encours');
       Route::get('incident/detail/{id}',[IncidentController::class,'detail'])->name('incident.detail');
       Route::get('incident/edit/{id}',[IncidentController::class,'showEditForm'])->name('incident.edit');
       Route::get('incident/print',[IncidentController::class,'print'])->name('incident.print');
       Route::post('incident/update',[IncidentController::class,'update'])->name('incident.update');
       Route::post('incident/delete',[IncidentController::class,'delete'])->name('incident.delete');

        Route::post('factures/addcomment', [CommentsController::class, 'addCommentFacture'])->name('factures.add.comment');
        Route::post('comment/update', [CommentsController::class, 'updateComment'])->name('comment.update');
        Route::post('comment/delete', [CommentsController::class, 'deleteComment'])->name('comment.delete');
         // Route for taches

      Route::get('gestion/tasks', [GestionController::class, 'taches'])->name('gestion.tache');
      Route::get('gestion/tasks/load', [GestionController::class, 'loadTaches'])->name('gestion.load.tache');
      Route::post('gestion/tasks/add', [GestionController::class, 'storeTask'])->name('gestion.taches.add');
      Route::post('gestion/tasks/markasdone', [GestionController::class, 'markTaskAsDone'])->name('gestion.taches.markasdone');
      Route::post('gestion/tasks/delete', [GestionController::class, 'deleteTache'])->name('gestion.taches.delete');
    });

    //Route for admin prefix with admin depend on  middleware to allow only admin
    Route::prefix('admin')->group(function () {
        Route::middleware([CheckAdmin::class])->group(function () {

           // routes pour les compte utilisateurs
        Route::get('user/all', [UserController::class, 'index'])->name('user.all');
        Route::view('user/new', 'user.add')->name('user.add');
        Route::post('user/new/store', [UserController::class, 'storeUser'])->name('user.add.store');
        Route::get('user/edit/{id}', [UserController::class, 'editUser'])->name('user.edit');
        Route::post('user/edit/store', [UserController::class, 'updateUser'])->name('user.edit.store');
        Route::post('user/delete', [UserController::class, 'deleteUser'])->name('user.delete');
        Route::get('user/activate/{id}', [UserController::class, 'activate'])->name('activate_compte');
        Route::get('user/block/{id}', [UserController::class, 'block'])->name('block_compte');
        });

        Route::get('/', function () {
            return view('welcome');
        });
});
});
