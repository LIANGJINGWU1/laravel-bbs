<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', [TopicController::class, 'index'])->name('root');


//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// 用户身份验证相关的路由



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// 用户注册相关路由
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
// 密码重置相关路由
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
// 再次确认密码（重要操作前提示）
Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);
// Email 认证相关路由
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
//用户资源路由
Route::resource('users', UserController::class)->only(['update', 'edit', 'show']);
//top
Route::resource('topics', TopicController::class)->only(['index', 'create', 'store', 'update', 'edit', 'destroy']);
// 请求单个话题的时候加上 slug
Route::get('topics/{topic}/{slug?}', [TopicController::class, 'show'])->name('topics.show');

Route::resource('categories', CategoryController::class)->only(['show']);

Route::post('upload_image', [TopicController::class, 'uploadImage'])->name('topics.upload_image');
//回复
Route::resource('replies', ReplyController::class)->only(['store', 'destroy']);

Route::resource('notifications', NotificationsController::class)->only(['index'])->middleware('auth');;

Route::get('/mail-test', function () {
    Mail::raw('这是一封测试邮件', function ($message) {
        $message->to('1174713142ljw@gmail.com')
            ->subject('测试邮件');
    });

    return '邮件已发送';
});
// 模拟登录相关路由
Route::get('/impersonate/{id}', [UserController::class, 'impersonateUser'])->name('impersonate');
Route::get('/stop-impersonating', [UserController::class, 'stopImpersonating'])->name('stopImpersonating');
//后台管理路由
Route::prefix('admin')->as('admin.')->middleware(['web', 'auth', RoleMiddleware::class . ':Founder|Maintainer'])->group(function () {
    //后台首页
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //用户管理
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)
        ->middleware(RoleMiddleware::class . ':Founder|Maintainer');
    //话题管理
    Route::resource('topics', \App\Http\Controllers\Admin\TopicController::class);
    // 回复管理
        Route::resource('replies', \App\Http\Controllers\Admin\ReplyController::class);
        // 分类管理
        Route::resource('categories',\App\Http\Controllers\Admin\CategoryController::class);
        // 设置
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index')->middleware([RoleMiddleware::class . ':Founder']);
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update')->middleware([RoleMiddleware::class . ':Founder']);

});
