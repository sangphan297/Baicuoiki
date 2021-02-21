<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recruitment\IndexController;
use App\Http\Controllers\Recruitment\RecruitmentController;
use App\Http\Controllers\Recruitment\ContactController;
use App\Http\Controllers\Recruitment\RecruiterController;
use App\Http\Controllers\Recruitment\CandidateController;

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CatController;
use App\Http\Controllers\Admin\NewRecruitmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminCandidateController;
use App\Http\Controllers\Admin\AdminRecruiterController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\PaymentController;

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

Route::pattern('slug', '(.*)');
Route::pattern('id', '([0-9]*)');	

Route::prefix('/')->namespace('Recruitment')->group(function(){

	Route::get('/', [IndexController::class, 'index'])->name('recruitment.index.index');
	Route::get('/search', [IndexController::class, 'search'])->name('recruitment.index.search');

	Route::get('/danh-muc/{slug}-{id}', [RecruitmentController::class, 'cat'])->name('recruitment.recruitment.cat');

	Route::get('/{slug}-{id}.html', [RecruitmentController::class, 'detail'])->name('recruitment.recruitment.detail');

	Route::get('/search/{slug}-{id}', [RecruitmentController::class, 'search'])->name('recruitment.recruitment.search');

	Route::get('/my_acount', [RecruitmentController::class, 'my_acount'])->name('recruitment.recruitment.my_acount');

	Route::post('/comment', [RecruitmentController::class, 'postComment'])->name('recruitment.recruitment.comment');

	Route::post('/follow', [RecruitmentController::class, 'postFollow'])->name('recruitment.recruitment.follow');

	Route::get('/lien-he', [ContactController::class, 'contact'])->name('recruitment.contact.contact');
	Route::post('/lien-he', [ContactController::class, 'postContact'])->name('recruitment.contact.contact');

	//Candidate
	Route::post('/update_candidate-{id}', [CandidateController::class, 'postUpdate_candidate'])->name('recruitment.candidate.update_candidate');

	Route::get('/recruitment-{id}', [CandidateController::class, 'recruitment'])->middleware('auth')->name('recruitment.candidate.recruitment');
	Route::post('/recruitment-{id}', [CandidateController::class, 'postRecruitment'])->name('recruitment.candidate.resubmit');

	Route::post('/resubmit-{id}', [CandidateController::class, 'postResubmit'])->name('recruitment.candidate.resubmit');

	Route::get('/job_application', [CandidateController::class, 'job_application'])->name('recruitment.candidate.job_application');

	Route::get('/tracked_jobs', [CandidateController::class, 'tracked_jobs'])->name('recruitment.candidate.tracked_jobs');

	Route::get('/download-{id}', [CandidateController::class, 'download_cv'])->name('recruitment.candidate.download_cv');
	Route::get('/delapply-{id}', [CandidateController::class, 'del_apply'])->name('recruitment.candidate.del_apply');
	Route::get('/changepass_candidate', [CandidateController::class, 'changepass_candidate'])->name('recruitment.candidate.changepass_candidate');
	Route::post('/changepass_candidate', [CandidateController::class, 'postChangepass_candidate'])->name('recruitment.candidate.changepass_candidate');

	//Recruiter
	Route::post('/update_recruiter-{id}', [RecruiterController::class, 'postUpdate_recruiter'])->name('recruitment.recruiter.update_recruiter');

	Route::get('/publish_recruitment', [RecruiterController::class, 'publish_recruitment'])->name('recruitment.recruiter.publish_recruitment');
	Route::post('/publish_recruitment', [RecruiterController::class, 'postPublish_recruitment'])->name('recruitment.recruiter.publish_recruitment');

	Route::get('/job_listing', [RecruiterController::class, 'job_listing'])->name('recruitment.recruiter.job_listing');
	Route::get('/export_recruitment', [RecruiterController::class, 'export_recruitment'])->name('recruitment.recruiter.export_recruitment');
	
	Route::get('/recharge', [RecruiterController::class, 'recharge'])->name('recruitment.recruiter.recharge');
	Route::post('/recharge', [RecruiterController::class, 'postRecharge'])->name('recruitment.recruiter.recharge');
	
	Route::get('/application_file', [RecruiterController::class, 'application_file'])->name('recruitment.recruiter.application_file');
	Route::get('/download_cv-{id}', [RecruiterController::class, 'download_cv'])->name('recruitment.recruiter.download_cv');
	Route::get('/save_apply-{id}', [RecruiterController::class, 'save_apply'])->name('recruitment.recruiter.save_apply');
	Route::get('/del_apply-{id}', [RecruiterController::class, 'del_apply'])->name('recruitment.recruiter.del_apply');

	Route::get('/saved_file', [RecruiterController::class, 'saved_file'])->name('recruitment.recruiter.saved_file');

	Route::get('/transaction_history', [RecruiterController::class, 'transaction_history'])->name('recruitment.recruiter.transaction_history');

	Route::get('/preview_recruitment-{id}', [RecruiterController::class, 'preview_recruitment'])->name('recruitment.recruiter.preview_recruitment');
	Route::get('/modify_recruitment-{id}', [RecruiterController::class, 'modify_recruitment'])->name('recruitment.recruiter.modify_recruitment');
	Route::post('/modify_recruitment-{id}', [RecruiterController::class, 'postModify_recruitment'])->name('recruitment.recruiter.modify_recruitment');
	Route::get('/del_recruitment-{id}', [RecruiterController::class, 'del_recruitment'])->name('recruitment.recruiter.del_recruitment');
	Route::get('/changepass_recruiter', [RecruiterController::class, 'changepass_recruiter'])->name('recruitment.recruiter.changepass_recruiter');
	Route::post('/changepass_recruiter', [RecruiterController::class, 'postChangepass_recruiter'])->name('recruitment.recruiter.changepass_recruiter');

});

//admin

Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function(){

	Route::get('/',[AdminController::class,'index'])->name('admin.admin.index');

	//danh mục
	Route::prefix('/cat')->group(function(){

		Route::get('/', [CatController::class, 'index'])->name('admin.cat.index');
		//add
		Route::get('/add', [CatController::class, 'add'])->name('admin.cat.add');

		Route::post('/add', [CatController::class, 'postAdd'])->name('admin.cat.add');

		//edit
		Route::get('/edit/{id}', [CatController::class, 'edit'])->name('admin.cat.edit');

		Route::post('/edit/{id}', [CatController::class, 'postEdit'])->name('admin.cat.edit');

		//del
		Route::get('/del/{id}', [CatController::class, 'del'])->name('admin.cat.del');

	});

	//tin tức
	Route::prefix('/recruitment')->group(function(){

		Route::get('/', [NewRecruitmentController::class, 'index'])->name('admin.recruitment.index');
		Route::post('/', [NewRecruitmentController::class, 'postIndex'])->name('admin.recruitment.index');

		//del
		Route::get('/del/{id}', [NewRecruitmentController::class, 'del'])->name('admin.recruitment.del');

	});

	//user
	Route::prefix('/user')->group(function(){

		Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
		Route::post('/', [UserController::class, 'postIndex'])->name('admin.user.index');
		Route::post('/method', [UserController::class, 'postMethod'])->name('admin.user.method');

		//add	
		Route::get('/add', [UserController::class, 'add'])->name('admin.user.add');
		Route::post('/add', [UserController::class, 'postAdd'])->name('admin.user.add');

		//edit
		Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
		Route::post('/edit/{id}', [UserController::class, 'postEdit'])->name('admin.user.edit');

		//del
		Route::get('/del/{id}', [UserController::class, 'del'])->name('admin.user.del');
	});
	//candidate
	Route::prefix('/candidate')->group(function(){

		Route::get('/', [AdminCandidateController::class, 'index'])->name('admin.candidate.index');
		Route::post('/', [AdminCandidateController::class, 'postIndex'])->name('admin.candidate.index');
		Route::post('/method', [AdminCandidateController::class, 'postMethod'])->name('admin.candidate.method');

		//del
		Route::get('/del/{id}', [AdminCandidateController::class, 'del'])->middleware('user:admin')->name('admin.candidate.del');
	});

	//recruiter
	Route::prefix('/recruiter')->group(function(){

		Route::get('/', [AdminRecruiterController::class, 'index'])->name('admin.recruiter.index');
		Route::post('/', [AdminRecruiterController::class, 'postIndex'])->name('admin.recruiter.index');
		Route::post('/method', [AdminRecruiterController::class, 'postMethod'])->name('admin.recruiter.method');

		//del
		Route::get('/del/{id}', [AdminRecruiterController::class, 'del'])->middleware('user:admin')->name('admin.recruiter.del');
	});

	//bình luan
	Route::prefix('/comment')->group(function(){

		Route::get('/', [CommentController::class, 'index'])->name('admin.comment.index');

		//del
		Route::get('/del/{id}', [CommentController::class, 'del'])->name('admin.comment.del');
	});

	//contact
	Route::prefix('/contact')->group(function(){

		Route::get('/', [AdminContactController::class, 'index'])->name('admin.contact.index');

		//del
		Route::get('/del/{id}', [AdminContactController::class, 'del'])->name('admin.contact.del');
	});

	//payment
	Route::prefix('/payment')->group(function(){

		Route::get('/', [PaymentController::class, 'index'])->name('admin.payment.index');

		//del
		Route::get('/del/{id}', [PaymentController::class, 'del'])->name('admin.payment.del');
	});
	
});


//auth

Route::prefix('/auth')->namespace('Auth')->group(function(){

	//login admin
	Route::get('/login', [AuthController::class, 'login'])->name('auth.auth.login');
	Route::post('/login', [AuthController::class, 'postLogin'])->name('auth.auth.login');

	// //login candidate
	// Route::get('/login_candidate', [AuthController::class, 'login_candidate'])->name('auth.auth.login_candidate');
	// Route::post('/login_candidate', [AuthController::class, 'postLogin_candidate'])->name('auth.auth.login_candidate');

	// //login recruiter
	// Route::get('/login_recruiter', [AuthController::class, 'login_recruiter'])->name('auth.auth.login_recruiter');
	// Route::post('/login_recruiter', [AuthController::class, 'postLogin_recruiter'])->name('auth.auth.login_recruiter');

	//register candidate
	Route::get('/register_candidate', [AuthController::class, 'register_candidate'])->name('auth.auth.register_candidate');
	Route::post('/register_candidate', [AuthController::class, 'postRegister_candidate'])->name('auth.auth.register_candidate');

	//register recruiter
	Route::get('/register-recruiter', [AuthController::class, 'register_recruiter'])->name('auth.auth.register_recruiter');
	Route::post('/register-recruiter', [AuthController::class, 'postRegister_recruiter'])->name('auth.auth.register_recruiter');

	Route::get('/logout', [AuthController::class, 'logout'])->name('auth.auth.logout');

	Route::get('/email_confirm', [AuthController::class, 'email_confirm'])->name('auth.auth.email_confirm');

	Route::get('confirm', [AuthController::class, 'confirm'])->name('auth.auth.confirm');

	Route::get('/email', [AuthController::class, 'email'])->name('auth.auth.email');

	Route::get('/forgetpass', [AuthController::class, 'forgetpass'])->name('auth.auth.forgetpass');
	Route::post('/forgetpass', [AuthController::class, 'postForgetpass'])->name('auth.auth.forgetpass');

	Route::get('/changepass', [AuthController::class, 'changepass'])->name('auth.auth.changepass');
	Route::post('/changepass', [AuthController::class, 'postChangepass'])->name('auth.auth.changepass');

});
