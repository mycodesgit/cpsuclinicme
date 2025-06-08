<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientUpcomingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PatientvisitController;
use App\Http\Controllers\MedicineController;

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

Route::group(['middleware'=>['guest']],function(){
    Route::get('/', function () {
        return view('login');
    });

    Route::get('/login',[LoginController::class,'loginView'])->name('getLogin');
    Route::post('/login/auth',[LoginController::class,'loginAuthenticate'])->name('postLogin');
});

Route::group(['middleware'=>['login_auth']],function(){
    Route::get('/dashboard',[DashboardController::class,'dash'])->name('dash');
    
    Route::prefix('/patient')->group(function () {
        Route::get('/patients/data/{id}', [PatientController::class, 'patientData'])->name('patients.data');
        Route::get('/add', [PatientController::class,'patientAdd'])->name('patientAdd');
        Route::get('/student', [PatientController::class,'studentRead'])->name('studentRead');
        Route::get('/student/list/show/search', [PatientController::class,'studentShow'])->name('studentShow');
        Route::get('/student/list/show/search/ajax', [PatientController::class,'getStudentData'])->name('getStudentData');


        Route::get('/student/upcoming/', [PatientUpcomingController::class,'studentUpcomingRead'])->name('studentUpcomingRead');
        Route::get('/student/upcoming/ajax', [PatientUpcomingController::class,'getStudentUpcomingData'])->name('getStudentUpcomingData');
        Route::get('/student/upcoming/show/search/moreinfo/{id}', [PatientUpcomingController::class,'moreInfoupcoming'])->name('moreInfoupcoming');

        Route::get('/student/list/show/search/moreinfo/{id}', [PatientController::class,'moreInfo'])->name('moreInfo');
        Route::get('/get-college', [PatientController::class, 'getCollege'])->name('getCollege');
        Route::get('/get-course', [PatientController::class, 'getCourse'])->name('getCourse');

        //Files
        Route::get('student/list/show/search/file/{id}', [FileController::class, 'fileRead'])->name('fileRead');
        Route::post('student/list/show/search/file/file-create/{id}', [FileController::class, 'fileCreate'])->name('fileCreate');
        Route::delete('student/list/show/search/file/file/deleteFile/{id}', [FileController::class, 'deleteFile'])->name('deleteFile');



        Route::get('/list/{id}', [PatientController::class,'patientRead'])->name('patientRead');
        Route::post('/create',[PatientController::class,'patientCreate'])->name('patientCreate');
        Route::post('/update', [PatientController::class, 'patientUpdate'])->name('patientUpdate');
        Route::post('/mh-update', [PatientController::class, 'patientHistory'])->name('patientHistory');

        

        Route::get('list/delete/{id}', [PatientController::class, 'patientDelete'])->name('patientDelete');
    }); 

    Route::prefix('/medicine')->group(function(){
        Route::get('/list', [MedicineController::class, 'medicineRead'])->name('medicineRead');
        Route::post('/medicineInsert', [MedicineController::class, 'medicineInsert'])->name('medicineInsert');
        Route::delete('/medicineDelete/{id}', [MedicineController::class, 'medicineDelete'])->name('medicineDelete');
        Route::get('/medicineEditRead/{id}', [MedicineController::class, 'medicineEditRead'])->name('medicineEditRead');
        Route::post('/medicineUpdate/{id}', [MedicineController::class, 'medicineUpdate'])->name('medicineUpdate');
    });
  
    Route::prefix('patient-visit')->group( function(){
        Route::get('/list', [PatientvisitController::class, 'patientvisitList'])->name('patientvisitList');
        Route::get('/patientListOption', [PatientvisitController::class, 'patientListOption'])->name('patientListOption');
        Route::get('/list/{id}', [PatientvisitController::class, 'visitSearch'])->name('visitSearch');
        Route::post('/add', [PatientvisitController::class, 'addPatient'])->name('addPatient');
        Route::get('/students', [PatientvisitController::class, 'ListStudent'])->name('ListStudent');
        Route::post('/studentLogin', [PatientvisitController::class, 'studentLogin'])->name('studentLogin');
        Route::get('/transaction/{id}', [PatientvisitController::class, 'patienttrans'])->name('transaction');
        Route::post('/addItem/{id}', [PatientvisitController::class, 'patientsAddItem'])->name('addItem');
        Route::get('/remove-item/{id}', [PatientvisitController::class, 'removeItem'])->name('removeItem');
        Route::get('/Settings/{id}', [PatientvisitController::class, 'Settings'])->name('Settings');
    });

    Route::prefix('test-system')->group( function(){
        Route::get('test', [PatientvisitController::class, 'test'])->name('test');
        Route::get('test2', [PatientvisitController::class, 'test2'])->name('test2');
    });
    


    Route::prefix('/reports')->group(function (){
        Route::get('/refused', [ReportController::class,'refusedReport'])->name('refusedReport');
        Route::get('/waiver', [ReportController::class,'waiverReport'])->name('waiverReport');
        Route::get('/', [ReportController::class,'reportsSrch'])->name('reportsSrch');
        Route::get('/{id}', [ReportController::class,'reportsRead'])->name('reportsRead');
        Route::get('/pehe-report/{id}', [ReportController::class,'peheReport'])->name('peheReport');
       
    });

    //Users
    Route::prefix('/users')->group(function () {
        Route::get('/list',[UserController::class,'userRead'])->name('userRead');
        Route::get('/list/fetch/ajax',[UserController::class,'getusersRead'])->name('getusersRead');
        Route::post('/list', [UserController::class, 'userCreate'])->name('userCreate');
        Route::post('list/update', [UserController::class, 'userUpdate'])->name('userUpdate');
        Route::post('list/update/pass', [UserController::class, 'userPassUpdate'])->name('userPassUpdate');
        Route::post('list/update/status', [UserController::class, 'userStatusUpdate'])->name('userStatusUpdate');
        Route::get('list/delete/{id}', [UserController::class, 'userDelete'])->name('userDelete');
    });

    

    //Address
    Route::prefix('/address')->group(function() {
        Route::get('/provinces/{regionId}', [AddressController::class, 'getProvinces'])->name('getProvinces');
        Route::get('/cities/{provinceId}', [AddressController::class, 'getCities'])->name('getCities');
        Route::get('/barangays/{cityId}', [AddressController::class, 'getBarangays'])->name('getBarangays');
    });    
    
    Route::prefix('/settings')->group(function () {
        Route::get('/list/patient', [SettingsController::class,'accountRead'])->name('accountRead');
        Route::get('/complaint', [SettingsController::class,'complaintRead'])->name('complaintRead');
        Route::post('/complaintCreate', [SettingsController::class,'complaintCreate'])->name('complaintCreate');
        Route::get('/complaintEditRead/{id}', [SettingsController::class,'complaintEditRead'])->name('complaintEditRead');
        Route::post('/complaintUpdate/{id}', [SettingsController::class,'complaintUpdate'])->name('complaintUpdate');
        Route::delete('/complaint/{id}', [SettingsController::class, 'complaintDelete'])->name('complaintDelete');
    });
    
    Route::get('/logout',[DashboardController::class,'logout'])->name('logout');
});
