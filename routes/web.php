<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Models\Ticket;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ProfileController;

use App\Http\Controllers\GuestReservationController;
use App\Http\Controllers\UserReservationController;

use App\Http\Controllers\Auth\AdminUserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\UserTicketController;
use App\Http\Controllers\AdminStatisticController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;



Route::get('/', function () {
    $tickets = Ticket::all();

    return view('main.index', compact('tickets'));
}) ->name('home');

Route::get('/terms-and-condition', function () {
    return view('shared.terms_condition');
})->name('terms-and-condition');

Route::post('/reservation', [CalendarController::class, 'reserve'])->name('reservation.submit');

// Route for guest reservation
Route::post('/guest-reservation', [GuestReservationController::class, 'submit'])->name('guest.reservation.submit');

// Route for user reservation
Route::middleware(['auth'])->group(function () {
    Route::middleware([UserMiddleware::class])->group(function () {
        Route::get('/user-reservation', [UserReservationController::class, 'index'])->name('user-reservation');
        Route::get('/user-reservations', [UserReservationController::class, 'userReservations'])->name('user.reservations');
        Route::post('/user-reservation', [UserReservationController::class, 'reserve'])->name('user-reservation.reserve');

        //settings like update password, avatar etc
        Route::get('/settings', [ProfileController::class, 'show'])->name('settings');
        Route::post('/settings', [ProfileController::class, 'update'])->name('settings.update');
    });
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route for showing registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Route for handling user registration
Route::post('/register', [RegisterController::class, 'register']);


Route::middleware(['auth'])->group(function () {
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/admin/user/{id}/edit', [AdminUserController::class, 'edit'])->name('user.edit');
        Route::delete('/admin/user/delete/{user}', [AdminUserController::class, 'destroy'])->name('user.destroy');
        Route::put('/admin/user/{id}', [AdminUserController::class, 'update'])->name('user.update');
        Route::post('/admin/user', [AdminUserController::class, 'store'])->name('user.store');
        Route::get('/admin/user', [AdminUserController::class, 'showUserCrud'])->name('userCRUD');

        // Route::resource('/admin/tickets', TicketController::class);
        Route::get('/admin/tickets', [TicketController::class, 'index'])->name('admin.tickets');
        Route::get('/admin/tickets/create', [TicketController::class, 'create'])->name('admin.tickets.create');
        Route::post('/admin/tickets', [TicketController::class, 'store'])->name('admin.tickets.store');
        Route::get('/admin/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('admin.tickets.edit');
        Route::put('/admin/tickets/{ticket}', [TicketController::class, 'update'])->name('admin.tickets.update');
        Route::delete('/admin/tickets/{ticket}', [TicketController::class, 'destroy'])->name('admin.tickets.destroy');

        // Routes for reservation management
        Route::get('/admin/reservations', [AdminReservationController::class, 'index'])->name('admin.reservations');
        Route::get('/admin/reservations/create', [AdminReservationController::class, 'create'])->name('admin.reservations.create');
        Route::post('/admin/reservations', [AdminReservationController::class, 'store'])->name('admin.reservations.store');
        Route::get('/admin/reservations/{reservation}/edit', [AdminReservationController::class, 'edit'])->name('admin.reservations.edit');
        Route::put('/admin/reservations/{reservation}', [AdminReservationController::class, 'update'])->name('admin.reservations.update');
        Route::delete('/admin/reservations/{reservation}', [AdminReservationController::class, 'destroy'])->name('admin.reservations.destroy');

        // Routes for tickets in reservation management
        Route::get('/admin/user_tickets', [UserTicketController::class, 'index'])->name('admin.user_tickets.index');
        Route::get('/admin/user_tickets/create', [UserTicketController::class, 'create'])->name('admin.user_tickets.create');
        Route::post('/admin/user_tickets', [UserTicketController::class, 'store'])->name('admin.user_tickets.store');
        Route::put('/admin/user_tickets/{id}', [UserTicketController::class, 'update'])->name('admin.user_tickets.update');
        Route::delete('/admin/user_tickets/{id}', [UserTicketController::class, 'destroy'])->name('admin.user_tickets.destroy');

        Route::get('admin/statistic', [AdminStatisticController::class, 'index'])->name('admin.statistic');
    });
});

// Route for Page not found
Route::fallback(function(){
    return view('error.not_found');
});
