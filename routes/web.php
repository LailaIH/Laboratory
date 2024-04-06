<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DebitController;
use App\Http\Controllers\InvoiceController;





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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('admin')->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
        })->name('admin');

        //the other panel
        // Route::get('/layout', function () {
        //     return view('layout');
        //     })->name('layout');

           
                
            // Samples Routes 
            Route::get('/samples', [SampleController::class, 'index'])->name('samples.index');
            Route::get('/samples/create', [SampleController::class, 'create'])->name('samples.create');
            Route::post('/samples/store', [SampleController::class, 'store'])->name('samples.store');
            Route::get('/samples/show/{id}', [SampleController::class, 'show'])->name('samples.show');
            Route::get('/samples/edit/{id}', [SampleController::class, 'edit'])->name('samples.edit');
            Route::put('/samples/update/{id}', [SampleController::class, 'update'])->name('samples.update');
            Route::patch('/samples/{sample}', [SampleController::class, 'updateStatus'])->name('samples.updateStatus');
            //Route::get('/patients/search', [SampleController::class, 'search']);
            Route::get('/autocomplete-search', [SampleController::class, 'autocompleteSearch']);
            //Route::get('/no-discount-samples', [SampleController::class, 'noDiscountSamples']);
            Route::get('/samples/discount/{id}', [SampleController::class, 'discountReason'])->name('samples.discount');
            Route::post('/samples/store/reason/{id}', [SampleController::class, 'storeReason'])->name('samples.store_reason');
            Route::get('/samples/approve', [SampleController::class, 'approve'])->name('samples.approve');
            Route::get('/samples/rejected-samples', [SampleController::class, 'rejectedSamples'])->name('samples.rejected');
            Route::post('/samples/approve-reason/{id}', [SampleController::class, 'approveDiscountReason'])->name('samples.approve_discount_reason');
            Route::post('/samples/reject-reason/{id}', [SampleController::class, 'rejectDiscountReason'])->name('samples.reject_discount_reason');

            //Results Routes    
            Route::get('/results', [ResultController::class, 'index'])->name('results.index');
            Route::get('/results/create/{id}', [ResultController::class, 'create'])->name('results.create');
            Route::post('/results/store/{id}', [ResultController::class, 'store'])->name('results.store');
            Route::get('/results/search/patients/samples', [ResultController::class, 'searchPatientSamples'])->name('results.search_patients_samples');
            Route::post('/results/find/samples', [ResultController::class, 'findSamples'])->name('results.find_samples');
            Route::patch('/results/update-status/{result}', [SampleController::class, 'updateStatus'])->name('results.updateStatus');

            //admin approval
            Route::get('/results/not-approved/admin', [ResultController::class, 'notApprovedByAdminResults'])->name('results.not_approved_by_admin');
            Route::post('/results/admin-approve/{id}', [ResultController::class, 'adminApproveResult'])->name('results.admin_approve');
            //doctor approval
            Route::get('/results/not-approved/doctor', [ResultController::class, 'notApprovedByDoctorResults'])->name('results.not_approved_by_doctor');
            Route::post('/results/doctor-approve/{id}', [ResultController::class, 'doctorApproveResult'])->name('results.doctor_approve');

        //Patients
        Route::get('/patients/with-samples', [PatientController::class, 'patientsWithPriceQuotation'])->name('patients.patients_with_samples');
        Route::get('/patients/price-quotation/{id}', [PatientController::class, 'priceQuotation'])->name('patients.price_quotation');

        //debits
        Route::get('/debits', [DebitController::class, 'index'])->name('debits.index');
        Route::get('/debits/create', [DebitController::class, 'create'])->name('debits.create');
        Route::post('/debits/store', [DebitController::class, 'store'])->name('debits.store');
        Route::get('/debits/pay/form/{id}', [DebitController::class, 'debitsPayForm'])->name('debits.pay_form');
        Route::post('/debits/pay/debit/{id}', [DebitController::class, 'payDebit'])->name('debits.pay_debit');

        // Invoices
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/show/{id}', [InvoiceController::class, 'show'])->name('invoices.show');









       
    });  


