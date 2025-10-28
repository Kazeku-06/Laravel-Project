<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAuthMiddleware;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ShelfController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Auth\RegisterController;




Route::get('/', [HomeController::class, 'index'])->name('user.home');




Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('auth.register');
    Route::post('/register', 'action')->name('auth.registerAction');
});


use App\Http\Controllers\UserBorrowingController;
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('auth.login')->middleware('guest');
    Route::post('/login', 'action')->name('auth.loginAction');
    Route::post('/logout', 'logout')->name('auth.logout');
});

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Middleware\CheckIsAdminRoleMiddleware;
use App\Http\Controllers\Student\StudentBookController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
Route::middleware(CheckAuthMiddleware::class)->group(function () {

     Route::middleware(CheckIsAdminRoleMiddleware::class)->group(function () {

    Route::get('/student/book', [StudentBookController::class, 'index'])->name('books');

    Route::post('/student/book/{book}', [BorrowingController::class, 'borrowBook'])->name('borrow.book');

    Route::get('/student/borrowing', [UserBorrowingController::class, 'index'])->name('user.borrowings');
    Route::post('/student/{borrowing}/cancel', [UserBorrowingController::class, 'cancelBorrowing'])->name('user.borrowings.cancel');
    Route::post('/student/{borrowing}/return', [UserBorrowingController::class, 'markReturned'])->name('user.borrowings.return');

    Route::get('/profile/{id}/student', [UserProfileController::class, 'edit'])->name('profile.student');
Route::patch('/profile/{id}/studentupdate', [UserProfileController::class, 'update'])->name('student.profile.update');
Route::patch('/profile/student-profile-image', [UserProfileController::class, 'updateProfileImage'])->name('student.setting.updateProfileImage');
});
});

Route::middleware(CheckAuthMiddleware::class)->group(function () {

    Route::middleware(CheckIsAdminRoleMiddleware::class)->group(function () {
    Route::prefix('/admin')->group(function () {

        // Admin Dashboard
        Route::controller(AdminDashboardController::class)->group(function () {
            Route::get('/', 'index')->name('admin.dashboard');
        });

        // Author routes
        Route::controller(AuthorController::class)->group(function () {
            Route::get('/author', 'index')->name('admin.author');
            // Route::get('/author', 'search')->name('admin.searchAuthor'); // kalau ingin search bisa pakai route lain
            Route::post('/author', 'store')->name('admin.author.store');
            Route::patch('/author/{author_id}', 'update')->name('admin.author.update');
            Route::delete('/author/{author_id}', 'delete')->name('admin.author.delete');
        });

        Route::controller(PublisherController::class)->group(function () {
    Route::get('/publisher', 'index')->name('admin.publisher');
    Route::post('/publisher/store', 'store')->name('admin.publisher.store');
    Route::patch('/publisher/update/{publisher_id}', 'update')->name('admin.publisher.update');
    Route::delete('/publisher/delete/{publisher_id}', 'delete')->name('admin.publisher.delete');
});


  Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index')->name('admin.category');
    Route::post('/category', 'store')->name('admin.category.store');
    Route::patch('/category/{category_id}', 'update')->name('admin.category.update');
    Route::delete('/category/{category_id}', 'delete')->name('admin.category.delete');
});


 Route::controller(ShelfController::class)->group(function () {
    Route::get('/shelf', 'index')->name('admin.shelf');
    Route::post('/shelf', 'store')->name('admin.shelf.store');
    Route::patch('/shelf/{shelf_id}', 'update')->name('admin.shelf.update');
    Route::delete('/shelf/{shelf_id}', 'delete')->name('admin.shelf.delete');
});


Route::controller(\App\Http\Controllers\Admin\BorrowingController::class)->group(function () {
    Route::get('/borrowing', 'index')->name('admin.borrowings.index');
    Route::post('/borrowing/{id}/update', 'update')->name('admin.borrowings.update');
});

Route::controller(BookController::class)->group(function () {
    Route::get('/book', 'index')->name('admin.books.index');          // Menampilkan semua buku
    Route::get('/book/create', 'create')->name('admin.books.create'); // Form tambah buku
    Route::post('/book', 'store')->name('book.store');         // Simpan buku baru
    Route::get('/book/{book}/edit', 'edit')->name('book.edit'); // Form edit buku
    Route::patch('/book/{book}', 'update')->name('book.update'); // Update buku
    Route::delete('/book/{book}', 'destroy')->name('book.destroy'); // Hapus buku
    Route::get('/book/{book}', 'show')->name('admin.books.show');     // Tampilkan detail buku
});

  Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/update-profile-image', [ProfileController::class ,'updateProfileImage'])->name('admin.settings.updateProfileImage');

    });


    
});

});

//   Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');
//     Route::patch('/profile/update-profile-image', [ProfileController::class ,'updateProfileImage'])->name('admin.settings.updateProfileImage');









    








