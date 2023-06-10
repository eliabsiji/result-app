<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SharkController;
use App\Http\Controllers\AcademicOperationsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SchoolArmController;
use App\Http\Controllers\SubjectClassController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AcademicinfoController;
use App\Http\Controllers\SubjectTeacherController;
use App\Http\Controllers\ClassTeacherController;
use App\Http\Controllers\SchoolsessionController;
use App\Http\Controllers\SchooltermController;
use App\Http\Controllers\AjaxSubController;
use App\Http\Controllers\AjaxSubclassController;
use App\Http\Controllers\AjaxclassteacherController;
use App\Http\Controllers\AjaxclassController;
use App\Http\Controllers\AjaxarmController;
use App\Http\Controllers\AjaxsessionController;
use App\Http\Controllers\AjaxsubteacherController;
use App\Http\Controllers\AjaxsubjectController;
use App\Http\Controllers\StaffImageUploadController;
use App\Http\Controllers\StudentImageUploadController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolHouseController;
use App\Http\Controllers\StudentHouseController;
use App\Http\Controllers\ClassOperationController;
use App\Http\Controllers\ClasscategoryController;
use App\Http\Controllers\SubjectOperationController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\MyClassController;
use App\Http\Controllers\ViewStudentController;
use App\Http\Controllers\AjaxsubjectopController;
use App\Http\Controllers\MySubjectController;
use App\Http\Controllers\MyresultroomController;
use App\Http\Controllers\MyScoreSheetController;
use App\Http\Controllers\StudentResultsController;
use App\Http\Controllers\AjaxStudentDeleteController;
use App\Http\Controllers\AjaxschoolhouseController;
use App\Http\Controllers\StudentpersonalityprofileController;
use App\Http\Controllers\AjaxclasssettingsController;


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

Auth::routes();



Route::group(['middleware' => ['auth']], function() {
    //Route::resource('users', UserController::class);
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('posts', PostController::class);
    Route::resource('shark', SharkController::class);
    Route::resource('academicoperations', AcademicOperationsController::class);
    Route::resource('subject', SubjectController::class);
    Route::resource('schoolclass', SchoolClassController::class);
    Route::resource('schoolarm', SchoolArmController::class);
    Route::resource('subjectclass', SubjectclassController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('staffacademicinfo', AcademicinfoController::class);
    Route::resource('subjectteacher', SubjectTeacherController::class);
    Route::resource('classteacher', ClassTeacherController::class);
    Route::resource('session', SchoolsessionController::class);
    Route::resource('term', SchooltermController::class);
    Route::resource('student', StudentController::class);
    Route::resource('classoperation', ClassOperationController::class);
    Route::resource('classcategories', ClasscategoryController::class);
    Route::resource('subjectoperation', SubjectOperationController::class);
    Route::resource('parent', ParentController::class);
    Route::resource('studentImageUpload', StudentImageUploadController::class);
    Route::resource('myclass', MyClassController::class);
    Route::resource('mysubject', MySubjectController::class);
    Route::resource('myresultroom', MyresultroomController::class);
    Route::resource('studentresults', StudentResultsController::class);
    Route::resource('subjectscoresheet', MyScoreSheetController::class);
    Route::resource('schoolhouse',SchoolHouseController::class);
    Route::resource('studenthouse',StudentHouseController::class);
    //Route::resource('studentpersonalityprofile',StudentpersonalityprofileController::class);
    Route::get('/viewstudent/{id}/{termid}/{sessionid}',[ViewStudentController::class, 'show']);
    Route::get('/subjectscoresheet/{schoolclassid}/{subjectclassid}/{staffid}/{termid}/{sessionid}',[MyScoreSheetController::class, 'subjectscoresheet']);
    //Route::resource('viewstudent', viewStudentController::class);
    Route::resource('subjectoperation', SubjectOperationController::class);
    Route::get('/subjectinfo/{id}/{schid}/{sessid}/{termid}',[SubjectOperationController::class, 'subjectinfo']);
    Route::get('/viewresults/{id}/{schoolclassid}/{sessid}/{termid}',[StudentResultsController::class, 'viewresults']);
    Route::get('/studentpersonalityprofile/{id}/{schoolclassid}/{sessid}/{termid}',[StudentpersonalityprofileController::class,'studentpersonalityprofile']);
    Route::post('save',[StudentpersonalityprofileController::class,'save'])->name('save');
    Route::get('export', [MyScoreSheetController::class, 'export']);
    Route::post('classsetting', [MyClassController::class, 'importsheet'])->name('import.post');;
    Route::post('importsheet', [MyScoreSheetController::class, 'importsheet'])->name('import.post');;
    Route::get('/importform/{schoolclassid}/{subjectclassid}/{staffid}/{termid}/{sessionid}', [MyScoreSheetController::class, 'importform']);





    Route::delete('/ajaxsub/{id}', [AjaxSubController::class, 'delete']);
    Route::delete('/ajaxsubclass/{id}', [AjaxSubclassController::class, 'delete']);
    Route::delete('/ajaxclassteacher/{id}', [AjaxclassteacherController::class, 'delete']);
    Route::delete('/ajaxclass/{id}', [AjaxclassController::class, 'delete']);
    Route::delete('/ajaxarm/{id}', [AjaxarmController::class, 'delete']);
    Route::delete('/ajaxsession/{id}', [AjaxsessionController::class, 'delete']);
    Route::delete('/ajaxsubteacher/{id}', [AjaxsubteacherController::class, 'delete']);
    Route::delete('/ajaxsubject/{id}', [AjaxsubjectController::class, 'delete']);
   // Route::delete('/ajaxsubjectop/{id}', [AjaxsubjectopController::class, 'delete']);
    Route::delete('/ajaxstudentdelete/{id}', [AjaxStudentDeleteController::class, 'delete']);
    Route::delete('/ajaxschoolhousedelete/{id}', [AjaxschoolhouseController::class, 'delete']);
    Route::delete('/ajaxclasssettings/{id}', [AjaxclasssettingsController::class, 'delete']);
    Route::get('image-upload', [ StaffImageUploadController::class, 'imageUpload' ])->name('image.upload');
    Route::post('image-upload', [ StaffImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');





});
