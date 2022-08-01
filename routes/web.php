<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\mainController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\FleetOfficerController;
use App\Http\Controllers\vehicleController;
use App\Http\Controllers\AdminDepartmentController;
use App\Http\Controllers\FillingStationController;
use App\Http\Controllers\FuelDepartmentController;
use App\Http\Controllers\MaintenanceDepartmentController;
use App\Http\Controllers\FinanceDepartmentController;
use App\Http\Controllers\StorekeeperController;
use App\Http\Controllers\FuelDataController;
use App\Http\Controllers\FuelRequestController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\FinanceRequestController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\StorekeeperRequestController;

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
    if(session()->has('log')){return redirect('dashboard');}
    return view('login');
});
Route::get('logout', function () {
    session()->pull('log');
    return redirect('/');
});


Route::post('authenticate', [LoginController::class, 'authentication']);

Route::view('register','register');
Route::post('store', [SuperAdminController::class, 'store']);
Route::get('Dashboard', [mainController::class, 'index']);

Route::get('Organization', [OrganizationController::class, 'index']);
Route::post('addOrganization', [OrganizationController::class, 'store']);
Route::post('updateOrganization', [OrganizationController::class, 'update']);
Route::post('deleteOrganization', [OrganizationController::class, 'destroy']);

Route::get('fleet Officer', [FleetOfficerController::class, 'index']);
Route::post('addFleetOfficer', [FleetOfficerController::class, 'store']);
Route::post('updateFleetOfficer', [FleetOfficerController::class, 'update']);
Route::post('deleteFleetOfficer', [FleetOfficerController::class, 'destroy']);

Route::get('vehicle', [vehicleController::class, 'index']);
Route::post('addVehicle', [vehicleController::class, 'store']);
Route::post('updateVehicle', [vehicleController::class, 'update']);
Route::post('deleteVehicle', [vehicleController::class, 'destroy']);

Route::get('admin', [AdminDepartmentController::class, 'index']);
Route::post('addAdmin', [AdminDepartmentController::class, 'store']);
Route::post('updateAdmin', [AdminDepartmentController::class, 'update']);
Route::post('deleteAdmin', [AdminDepartmentController::class, 'destroy']);

Route::get('filling station', [FillingStationController::class, 'index']);
Route::post('addFillingStation', [FillingStationController::class, 'store']);
Route::post('updateFillingStation', [FillingStationController::class, 'update']);
Route::post('deleteFillingStation', [FillingStationController::class, 'destroy']);

Route::get('fuel department', [FuelDepartmentController::class, 'index']);
Route::post('addFuelDepartment', [FuelDepartmentController::class, 'store']);
Route::post('updateFuelDepartment', [FuelDepartmentController::class, 'update']);
Route::post('deleteFuelDepartment', [FuelDepartmentController::class, 'destroy']);

Route::get('maintenance department', [MaintenanceDepartmentController::class, 'index']);
Route::post('addMaintenanceDepartment', [MaintenanceDepartmentController::class, 'store']);
Route::post('updateMaintenanceDepartment', [MaintenanceDepartmentController::class, 'update']);
Route::post('deleteMaintenanceDepartment', [MaintenanceDepartmentController::class, 'destroy']);

Route::get('finance', [FinanceDepartmentController::class, 'index']);
Route::post('addFinance', [FinanceDepartmentController::class, 'store']);
Route::post('updateFinance', [FinanceDepartmentController::class, 'update']);
Route::post('deleteFinance', [FinanceDepartmentController::class, 'destroy']);

Route::get('storekeeper', [StorekeeperController::class, 'index']);
Route::post('addStorekeeper', [StorekeeperController::class, 'store']);
Route::post('updateStorekeeper', [StorekeeperController::class, 'update']);
Route::post('deleteStorekeeper', [StorekeeperController::class, 'destroy']);

Route::get('fuel data', [FuelDataController::class, 'index']);
Route::post('addFuelData', [FuelDataController::class, 'store']);
Route::post('updateFuelData', [FuelDataController::class, 'update']);
Route::post('deleteFuelData', [FuelDataController::class, 'destroy']);

Route::get('fuel request', [FuelRequestController::class, 'index']);
Route::post('addFuelRequest', [FuelRequestController::class, 'store']);
Route::post('updateFuelRequest', [FuelRequestController::class, 'update']);
Route::post('deleteFuelRequest', [FuelRequestController::class, 'destroy']);
Route::post('acceptFuelRequest', [FuelRequestController::class, 'accept']);
Route::post('rejectFuelRequest', [FuelRequestController::class, 'reject']);

Route::get('maintenance request', [MaintenanceRequestController::class, 'index']);
Route::post('addMaintenanceRequest', [MaintenanceRequestController::class, 'store']);
Route::post('updateMaintenanceRequest', [MaintenanceRequestController::class, 'update']);
Route::post('deleteMaintenanceRequest', [MaintenanceRequestController::class, 'destroy']);
Route::post('acceptMaintenanceRequest', [MaintenanceRequestController::class, 'accept']);
Route::post('rejectMaintenanceRequest', [MaintenanceRequestController::class, 'reject']);

Route::get('admin request', [AdminRequestController::class, 'index']);
Route::post('addAdminRequest', [AdminRequestController::class, 'store']);
Route::post('updateAdminRequest', [AdminRequestController::class, 'update']);
Route::post('deleteAdminRequest', [AdminRequestController::class, 'destroy']);
Route::post('acceptAdminRequest', [AdminRequestController::class, 'accept']);
Route::post('rejectAdminRequest', [AdminRequestController::class, 'reject']);

Route::get('request', [FinanceRequestController::class, 'financeRequest']);
Route::get('finance request', [FinanceRequestController::class, 'index']);
Route::post('addFinanceRequest', [FinanceRequestController::class, 'store']);
Route::post('updateFinanceRequest', [FinanceRequestController::class, 'update']);
Route::post('deleteFinanceRequest', [FinanceRequestController::class, 'destroy']);
Route::post('acceptFinanceRequest', [FinanceRequestController::class, 'accept']);
Route::post('rejectFinanceRequest', [FinanceRequestController::class, 'reject']);

Route::get('warehouse', [WarehouseController::class, 'index']);
Route::post('addWarehouse', [WarehouseController::class, 'store']);
Route::post('updateWarehouse', [WarehouseController::class, 'update']);
Route::post('deleteWarehouse', [WarehouseController::class, 'destroy']);
Route::post('acceptWarehouse', [WarehouseController::class, 'accept']);
Route::post('rejectWarehouse', [WarehouseController::class, 'reject']);
Route::post('inWarehouse', [WarehouseController::class, 'inProduct']);
Route::post('outWarehouse', [WarehouseController::class, 'outProduct']);

Route::get('storekeeper request', [StorekeeperRequestController::class, 'index']);
Route::post('addStorekeeperRequest', [StorekeeperRequestController::class, 'store']);
Route::post('updateStorekeeperRequest', [StorekeeperRequestController::class, 'update']);
Route::post('deleteStorekeeperRequest', [StorekeeperRequestController::class, 'destroy']);
Route::post('acceptStorekeeperRequest', [StorekeeperRequestController::class, 'accept']);
Route::post('rejectStorekeeperRequest', [StorekeeperRequestController::class, 'reject']);


Route::post('test', [FuelDataController::class, 'edit']);

