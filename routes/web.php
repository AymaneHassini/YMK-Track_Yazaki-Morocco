<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
    Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/logout', [AdminController::class, 'AdminLogoutPage'])->name('admin.logout.page');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('/all/employee', 'AllEmployee')->name('all.employee')->middleware('permission:employee.all');
    Route::get('/add/employee', 'AddEmployee')->name('add.employee')->middleware('permission:employee.add');
    Route::post('/store/employee', 'StoreEmployee')->name('employee.store')->middleware('permission:employee.add');
    Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit.employee')->middleware('permission:employee.edit');
    Route::post('/update/employee', 'UpdateEmployee')->name('employee.update')->middleware('permission:employee.edit');
    Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee')->middleware('permission:employee.delete');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/all/customer', 'AllCustomer')->name('all.customer')->middleware('permission:customer.all');
    Route::get('/add/customer', 'AddCustomer')->name('add.customer')->middleware('permission:customer.add');
    Route::post('/store/customer', 'StoreCustomer')->name('customer.store')->middleware('permission:customer.add');
    Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit.customer')->middleware('permission:customer.edit');
    Route::post('/update/customer', 'UpdateCustomer')->name('customer.update')->middleware('permission:customer.edit');
    Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete.customer')->middleware('permission:customer.delete');
});
Route::controller(SupplierController::class)->group(function () {
    Route::get('/all/supplier', 'AllSupplier')->name('all.supplier')->middleware('permission:supplier.all');
    Route::get('/add/supplier', 'AddSupplier')->name('add.supplier')->middleware('permission:supplier.add');
    Route::post('/store/supplier', 'StoreSupplier')->name('supplier.store')->middleware('permission:supplier.add');
    Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit.supplier')->middleware('permission:supplier.edit');
    Route::post('/update/supplier', 'UpdateSupplier')->name('supplier.update')->middleware('permission:supplier.edit');
    Route::get('/details/supplier/{id}', 'DetailsSupplier')->name('details.supplier')->middleware('permission:supplier.all'); // Add this line
    Route::get('/delete/supplier/{id}', 'DeleteSupplier')->name('delete.supplier')->middleware('permission:supplier.delete');
});
// Salary Management Routes - Advance Salary
Route::controller(SalaryController::class)->group(function () {

    Route::get('/add/advance/salary', 'AddAdvanceSalary')
        ->name('add.advance.salary')
        ->middleware('permission:salary.add');

    Route::post('/advance/salary/store', 'AdvanceSalaryStore')
        ->name('advance.salary.store')
        ->middleware('permission:salary.add');

    Route::get('/all/advance/salary', 'AllAdvanceSalary')
        ->name('all.advance.salary')
        ->middleware('permission:salary.all');
     
    Route::get('/edit/advance/salary/{id}', 'EditAdvanceSalary')
        ->name('edit.advance.salary')
        ->middleware('permission:salary.edit');

    Route::post('/advance/salary/update', 'AdvanceSalaryUpdate')
        ->name('advance.salary.update')
        ->middleware('permission:salary.edit');

    Route::get('/delete/advance/salary/{id}', 'DeleteAdvanceSalary')
        ->name('delete.advance.salary')
        ->middleware('permission:salary.delete');
});

// Salary Payment Routes
Route::controller(SalaryController::class)->group(function () {

    Route::get('/pay/salary', 'PaySalary')
        ->name('pay.salary')
        ->middleware('permission:salary.pay');

    Route::get('/pay/now/salary/{id}', 'PayNowSalary')
        ->name('pay.now.salary')
        ->middleware('permission:salary.pay');

    Route::post('/employe/salary/store', 'EmployeSalaryStore')
        ->name('employe.salary.store')
        ->middleware('permission:salary.pay');

    Route::get('/month/salary', 'MonthSalary')
        ->name('month.salary')
        ->middleware('permission:salary.paid');
});

Route::controller(AttendanceController::class)->group(function () {
    Route::middleware('permission:attendance.menu')->group(function () {

        Route::get('/employee/attend/list', 'EmployeeAttendanceList')->name('employee.attend.list');
        Route::get('/add/employee/attend', 'AddEmployeeAttendance')->name('add.employee.attend');
        Route::post('/employee/attend/store', 'EmployeeAttendanceStore')->name('employee.attend.store');
    
        Route::get('/edit/employee/attend/{date}', 'EditEmployeeAttendance')->name('employee.attend.edit');
        Route::get('/view/employee/attend/{date}', 'ViewEmployeeAttendance')->name('employee.attend.view');
    });

});
Route::controller(CategoryController::class)->group(function () {
    Route::middleware('permission:category.menu')->group(function () {

        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::post('/store/category', 'StoreCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('category.update');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });
});
Route::controller(ProductController::class)->group(function () {

    Route::get('/all/product', 'AllProduct')->name('all.product');
    Route::get('/add/product', 'AddProduct')->name('add.product');
    Route::post('/store/product', 'StoreProduct')->name('product.store');
    Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
    Route::post('/update/product', 'UpdateProduct')->name('product.update');
    Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
    
    Route::get('/barcode/product/{id}', 'BarcodeProduct')->name('barcode.product');
    
    Route::get('/import/product', 'ImportProduct')->name('import.product');
    Route::get('/export', 'Export')->name('export');
    Route::post('/import', 'Import')->name('import');

});
Route::controller(PosController::class)->group(function () {

    Route::get('/pos', 'Pos')->name('pos');
    Route::post('/add-cart', 'AddCart');
    Route::get('/allitem', 'AllItem');
    Route::post('/cart-update/{rowId}', 'CartUpdate');
    Route::get('/cart-remove/{rowId}', 'CartRemove');
   
    Route::post('/create-invoice', 'CreateInvoice');
    


});
Route::controller(OrderController::class)->group(function () {

    Route::post('/final-invoice', 'FinalInvoice');
    Route::get('/pending/order', 'PendingOrder')->name('pending.order');
    Route::get('/order/details/{order_id}', 'OrderDetails')->name('order.details');
    Route::post('/order/status/update', 'OrderStatusUpdate')->name('order.status.update');
   
    Route::get('/complete/order', 'CompleteOrder')->name('complete.order');
   
    Route::get('/stock', 'StockManage')->name('stock.manage');
    Route::get('/order/invoice-download/{order_id}', 'OrderInvoice');
   
    Route::get('/pending/due', 'PendingDue')->name('pending.due');
    Route::get('/order/due/{id}', 'OrderDueAjax');
    Route::post('/update/due', 'UpdateDue')->name('update.due');
});
Route::controller(RoleController::class)->group(function () {

    Route::get('/all/permission', 'AllPermission')->name('all.permission');
    Route::get('/add/permission', 'AddPermission')->name('add.permission');
    Route::post('/store/permission', 'StorePermission')->name('permission.store');
    Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
   
    Route::post('/update/permission', 'UpdatePermission')->name('permission.update');
    Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');

});
Route::controller(RoleController::class)->group(function () {

    Route::get('/all/roles', 'AllRoles')->name('all.roles');
    Route::get('/add/roles', 'AddRoles')->name('add.roles');
    Route::post('/store/roles', 'StoreRoles')->name('roles.store');
    Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
   
    Route::post('/update/roles', 'UpdateRoles')->name('roles.update');
    Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');

});

Route::controller(RoleController::class)->group(function () {
   
    Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
    Route::post('/role/permission/store', 'StoreRolesPermission')->name('role.permission.store');
   
    Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
   
    Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
   
    Route::post('/role/permission/update/{id}', 'RolePermissionUpdate')->name('role.permission.update');
   
    Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');

});
Route::controller(AdminController::class)->group(function () {

    Route::get('/all/admin', 'AllAdmin')->name('all.admin');
    Route::get('/add/admin', 'AddAdmin')->name('add.admin');
    Route::post('/store/admin', 'StoreAdmin')->name('admin.store');
    Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
    Route::post('/update/admin', 'UpdateAdmin')->name('admin.update');
    Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
    Route::get('/database/backup', 'DatabaseBackup')->name('database.backup');
    Route::get('/backup/now', 'BackupNow');
    Route::get('/{getFilename}', [AdminController::class, 'DownloadDatabase'])
    ->where('getFilename', '^(?!login|register|dashboard|profile|admin|.*password).*$');

    Route::get('/delete/database/{getFilename}', 'DeleteDatabase');
  

});
require __DIR__.'/auth.php';
