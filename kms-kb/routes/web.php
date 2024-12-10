<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevisionsController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', [ProfileController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/register/new', [RegisteredUserController::class, 'store'])->name('register.store');
Route::get('/rkb', [RevisionsController::class, 'view'])->middleware(['auth', 'verified'])->name('rkb');
Route::get('/rkb/page/{page}', [RevisionsController::class, 'view_page'])->middleware(['auth', 'verified'])->name('rkb_page');
Route::get('/rkb/filter/{api}', [RevisionsController::class, 'view_filter'])->middleware(['auth', 'verified'])->name('rkb_filter');
Route::get('/rkb/sort/{sort}', [RevisionsController::class, 'view_sort'])->middleware(['auth', 'verified'])->name('rkb_sort');
Route::get('/rkb/sort/brand/{brand}', [RevisionsController::class, 'view_sort_brand'])->middleware(['auth', 'verified'])->name('rkb_sort_brand');

Route::get('/mkb', function () {
    return Inertia::render('Mkb');
})->middleware(['auth', 'verified'])->name('mkb');

Route::get('/dkb', function () {
    return Inertia::render('Dkb');
})->middleware(['auth', 'verified'])->name('dkb');

Route::get('/api', function () {
    return Inertia::render('Api');
})->middleware(['auth', 'verified'])->name('api');

Route::get('/settings', [ApiController::class, 'settings_view'])->middleware(['auth', 'verified'])->name('settings');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/activity', [ProfileController::class, 'activity'])->name('activity');

    Route::post('/apis/read', [ApiController::class, 'apis_read'])->name('apis.read');
    Route::post('/api/read', [ApiController::class, 'api_read'])->name('api.read');
    Route::post('/api/create', [ApiController::class, 'write'])->name('api.create');
    Route::post('/api/update', [ApiController::class, 'api_update'])->name('api.update');
    Route::post('/api/delete', [ApiController::class, 'api_delete'])->name('api.delete');
    Route::post('/api/update-state', [ApiController::class, 'update_state'])->name('api.update.state');
    Route::post('/api/update-endpoint', [ApiController::class, 'update_endpoint'])->name('api.update.endpoint');
    Route::post('/api/update-credentials', [ApiController::class, 'update_credentials'])->name('api.update.credentials');
    Route::post('/api/decrease-sort', [ApiController::class, 'api_decrease_sort'])->name('api.decrease.sort');
    Route::post('/api/increase-sort', [ApiController::class, 'api_increase_sort'])->name('api.increase.sort');

    Route::get('/rkb/cars', [RevisionsController::class, 'cars'])->name('rkb.cars.overview');
    Route::get('/rkb/cars/page/{page}', [RevisionsController::class, 'cars_page'])->name('rkb.cars.overview.page');
    Route::get('/rkb/cars/filter/{api}', [RevisionsController::class, 'cars_filter'])->name('rkb.cars.filter.page');
    Route::get('/rkb/cars/sort/{sort}', [RevisionsController::class, 'cars_sort'])->name('rkb.cars.sort.page');
    Route::post('/rkb/cars/search', [RevisionsController::class, 'cars_search'])->name('rkb.cars.search.page');

    Route::get('/rkb/customers/{id}', [RevisionsController::class, 'customers'])->name('rkb.customers.overview');
    Route::get('/rkb/revisions', [RevisionsController::class, 'revisions'])->name('rkb.revisions.overview');
    Route::get('/rkb/manuals', [RevisionsController::class, 'manuals'])->name('rkb.manuals.overview');
    Route::get('/rkb/parts', [RevisionsController::class, 'parts'])->name('rkb.manuals.parts');


    Route::post('/car/create', [CarController::class, 'create_car'])->name('car.create');
    Route::post('/car/logo/edit', [CarController::class, 'edit_logo_car'])->name('car.logo.edit');
    Route::post('/car/brand/edit', [CarController::class, 'edit_brand_car'])->name('car.brand.edit');
    Route::post('/car/delete', [CarController::class, 'delete_car'])->name('car.delete');
    Route::post('/car/models/read', [CarController::class, 'read_models'])->name('car.models.read');
    Route::post('/car/models/tickets/read', [CarController::class, 'read_model_tickets'])->name('car.models.tickets.read');
    Route::post('/car/model/create', [CarController::class, 'create_model'])->name('car.model.create');
    Route::post('/car/model/edit', [CarController::class, 'edit_model_car'])->name('car.model.edit');
    Route::post('/car/model/ticket/link', [CarController::class, 'link_ticket'])->name('car.model.link.ticket');
    Route::post('/car/model/delete', [CarController::class, 'delete_model'])->name('car.model.delete');
    Route::get('/car/model/{id}', [CarController::class, 'view_model'])->name('car.model.view');
    Route::post('/car/model/type/create', [CarController::class, 'create_model_type'])->name('car.model.type.create');
    Route::post('/car/model/type/delete', [CarController::class, 'delete_type'])->name('car.model.type.delete');
    Route::post('/car/model/type/variant/delete', [CarController::class, 'delete_variant'])->name('car.model.type.variant.delete');
    Route::post('/car/models/types/tickets/read', [CarController::class, 'read_model_type_tickets'])->name('car.models.types.tickets.read');
    Route::post('/car/model/type/ticket/link', [CarController::class, 'link_ticket_type'])->name('car.model.type.link.ticket');
    Route::post('/car/model/type/edit', [CarController::class, 'edit_model_type_car'])->name('car.model.type.edit');
    Route::post('/car/model/variant/edit', [CarController::class, 'edit_model_type_variant_car'])->name('car.model.variant.edit');
    Route::post('/car/model/build/edit', [CarController::class, 'edit_model_type_build_car'])->name('car.model.build.edit');
    Route::post('/car/model/type/variant/create', [CarController::class, 'create_model_type_variant'])->name('car.model.type.variant.create');
    Route::post('/car/model/revision/delete', [CarController::class, 'delete_model_revision'])->name('car.model.revision.delete');
    Route::post('/car/checked', [CarController::class, 'car_check'])->name('car.check');

    
    Route::post('/revision/create', [RevisionsController::class, 'create'])->name('revision.create');
    Route::post('/revision/delete', [RevisionsController::class, 'revision_delete'])->name('revision.delete');
    Route::post('/revision/title/edit', [RevisionsController::class, 'title_edit'])->name('revision.title.edit');
    Route::post('/revision/complain/edit', [RevisionsController::class, 'complain_edit'])->name('revision.complain.edit');
    Route::post('/revision/revision_desc/edit', [RevisionsController::class, 'revision_desc_edit'])->name('revision.revision_desc.edit');
    Route::post('/revision/modellen/read', [RevisionsController::class, 'read_modellen_revision'])->name('revision.modellen.read');
    Route::post('/revision/modellen/unlink', [RevisionsController::class, 'unlink_modellen_revision'])->name('revision.modellen.unlink');
    Route::post('/revision/modellen/link', [RevisionsController::class, 'link_modellen_revision'])->name('revision.modellen.link');
    Route::get('/revision/ticket/{id}', [RevisionsController::class, 'view_ticket'])->name('revision.ticket');
    Route::post('/revision/tickets/read', [RevisionsController::class, 'read_revision_tickets'])->name('revision.ticket.read');
    Route::post('/revision/ticket/link', [RevisionsController::class, 'link_revision_tickets'])->name('revision.ticket.link');

    Route::post('/ticket/manual/read', [RevisionsController::class, 'ticket_manual_read'])->name('ticket.manual.read');
    Route::post('/ticket/parts/read', [RevisionsController::class, 'ticket_manual_parts'])->name('ticket.manual.parts');
    Route::post('/ticket/part/link', [RevisionsController::class, 'ticket_link_parts'])->name('ticket.link.parts');
    Route::post('/ticket/part/delete', [RevisionsController::class, 'ticket_delete_parts'])->name('ticket.link.delete');
    Route::post('/ticket/manual/delete', [RevisionsController::class, 'ticket_manual_delete'])->name('ticket.manual.delete');
    Route::post('/ticket/manual/create', [RevisionsController::class, 'ticket_manual_create'])->name('ticket.manual.create');
    Route::get('/ticket/manual/update', [RevisionsController::class, 'ticket_manual_update'])->name('ticket.manual.update');
    Route::get('/ticket/manual/update/title', [RevisionsController::class, 'ticket_manual_update_title'])->name('ticket.manual.update.title');
    Route::post('/ticket/customers/read', [RevisionsController::class, 'ticket_customers_read'])->name('ticket.customers.read');
    Route::post('/ticket/customer/link', [RevisionsController::class, 'ticket_customer_link'])->name('ticket.customer.link');
    Route::post('/ticket/user/read', [RevisionsController::class, 'ticket_user_read'])->name('ticket.user.read');
    Route::post('/ticket/user/link', [RevisionsController::class, 'ticket_user_link'])->name('ticket.user.link');

    Route::post('/revision/checked', [RevisionsController::class, 'revision_check'])->name('revision.check');

    
    Route::get('/customer/{id}', [CustomerController::class, 'view_customer'])->name('customers.view');
    Route::post('/customers/read', [CustomerController::class, 'read_customers'])->name('customers.read');
    Route::post('/car/customers/unlink', [CustomerController::class, 'unlink_customers'])->name('customers.unlink');
    Route::post('/car/customers/link', [CustomerController::class, 'link_customers'])->name('customers.link');
    Route::post('/revision/customers/read', [CustomerController::class, 'read_customers_revision'])->name('revision.customers.read');
    Route::post('/revision/customers/unlink', [CustomerController::class, 'unlink_customers_revision'])->name('revision.customers.unlink');
    Route::post('/revision/customers/link', [CustomerController::class, 'link_customers_revision'])->name('revision.customers.link');
    Route::post('/customers/delete', [CustomerController::class, 'customers_delete'])->name('customers.delete');

    Route::post('/customer/firstname/edit', [CustomerController::class, 'customers_firstname_edit'])->name('customers.firstname.edit');
    Route::post('/customer/lastname/edit', [CustomerController::class, 'customers_lastname_edit'])->name('customers.lastname.edit');
    Route::post('/customer/address/edit', [CustomerController::class, 'customers_address_edit'])->name('customers.address.edit');
    Route::post('/customer/zipcode/edit', [CustomerController::class, 'customers_zipcode_edit'])->name('customers.zipcode.edit');
    Route::post('/customer/city/edit', [CustomerController::class, 'customers_city_edit'])->name('customers.city.edit');
    Route::post('/customer/middlename/edit', [CustomerController::class, 'customers_middlename_edit'])->name('customers.middlename.edit');
    Route::post('/customer/birthdate/edit', [CustomerController::class, 'customers_birthdate_edit'])->name('customers.birthdate.edit');
    Route::post('/customer/gender/edit', [CustomerController::class, 'customers_gender_edit'])->name('customers.gender.edit');
    Route::post('/customer/housenr/edit', [CustomerController::class, 'customers_housenr_edit'])->name('customers.housenr.edit');
    Route::post('/customer/country/edit', [CustomerController::class, 'customers_country_edit'])->name('customers.country.edit');
    Route::post('/customer/reference/edit', [CustomerController::class, 'customers_reference_edit'])->name('customers.reference.edit');
    Route::post('/customer/mgrid/edit', [CustomerController::class, 'customers_mgrid_edit'])->name('customers.mgrid.edit');
    Route::post('/customer/odooid/edit', [CustomerController::class, 'customers_odooid_edit'])->name('customers.odooid.edit');
    Route::post('/customer/email/edit', [CustomerController::class, 'customers_email_edit'])->name('customers.email.edit');
    Route::post('/customer/phonenr/edit', [CustomerController::class, 'customers_phonenr_edit'])->name('customers.phonenr.edit');

    Route::post('/customer/company/read', [CustomerController::class, 'customer_company_read'])->name('customer.company.read');
    Route::post('/customer/company/link', [CustomerController::class, 'customer_company_link'])->name('customer.company.link');

    Route::post('/brands/all', [CarController::class, 'brands_all'])->name('brands.all');

    Route::post('/part/stock/edit', [RevisionsController::class, 'part_stock_edit'])->name('part.stock.edit');
    Route::post('/part/location/edit', [RevisionsController::class, 'part_location_edit'])->name('part.location.edit');
    Route::post('/part/name/edit', [RevisionsController::class, 'part_name_edit'])->name('part.name.edit');
    Route::post('/parts/delete', [RevisionsController::class, 'part_delete'])->name('parts.delete');

    
});

require __DIR__.'/auth.php';
