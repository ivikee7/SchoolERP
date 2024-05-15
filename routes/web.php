<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\EnquiryPublicController;
use App\Http\Controllers\Google\Workspace\Admin\GoogleUserController;
use App\Http\Controllers\Google\Workspace\Classroom\CoursesController;
use App\Http\Controllers\GSuite;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LeaveManagementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPermissionsController;
use App\Http\Controllers\UserProfileController;
use App\Livewire\ImageController as LivewireImageController;
use App\Livewire\StoreManagementSystem\Seller;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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

// g
// Route::get('/g', function () {
//     \App\Models\Inventory\Product\ProductCategory::create([
//         'product_category_name' => 'book'
//     ])::create([
//         'product_category_name' => 'store_management_system'
//     ]);
// });


// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Public Enquiry
Route::get('/public/enquiry', function () {
    return view('public.enquiry.enquiry');
})->name('public.enquiry');
// Route::post('/public/enquiry', [EnquiryController::class, 'publicStore'])->name('public.enquiry.store');

// Message
Route::get('/p/m/{id}', [MessageController::class, 'showPublic'])->name('public.message.show');
Route::get('/message', function () {
    return view('public.message');
})->name('public.enquiry');

// Auth Check
Route::group(['middleware' => ['auth']], function () {
    // Theme Settings
    Route::get('/theme', [ThemeController::class, 'setttings'])->name('theme.setting');

    // Role & Permission
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('user_permission', UserPermissionsController::class);
    Route::get('/user_permission_assign/data', [UserPermissionsController::class, 'userSearchForPermissionAssign']);

    // General Access
    Route::get('/', [HomeController::class, 'home'])->name('index');

    // Profile
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');

    // User
    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
        Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
        // Information
        Route::post('/information/{id}', [UserController::class, 'informationUpdate'])->name('user.information.update');
    });

    Route::prefix('/image')->group(function () {
        Route::get('/{id}', [ImageController::class, 'index'])->name('image.index');
        Route::post('/{id}', [ImageController::class, 'update'])->name('image.update');

        // Livewire
        Route::get('/{id}', LivewireImageController::class)->name('image-controller.index');
    });

    // Student
    Route::prefix('/student')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('student.index');
        Route::get('/create', [StudentController::class, 'create'])->name('student.create');
        Route::post('/', [StudentController::class, 'store'])->name('student.store');
        Route::get('/{id}', [StudentController::class, 'show'])->name('student.show');
        Route::put('/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::get('/list/class/wise', [StudentController::class, 'classStudents'])->name('student.class.students');
    });

    // Admission
    Route::prefix('/student/admission')->group(function () {
        Route::put('{id}', [AdmissionController::class, 'update'])->name('admission.update');
        Route::get('trashed', [AdmissionController::class, 'trashed'])->name('admission.trashed.index');
    });

    // Change class section
    Route::prefix('/student/class')->group(function () {
        Route::get('/section/change', [StudentController::class, 'changeClassSectionEdit'])->name('student.change.class.section.edit');
        Route::post('/section/change', [StudentController::class, 'changeClassSectionUpdate'])->name('student.change.class.section.update');
        Route::get('/change', [StudentController::class, 'getStudentsAjaxCall'])->name('student.change.class.section.ajax.students');
        Route::get('/strength', [StudentController::class, 'getClassStudentsStrengthAjaxCall'])->name('class.student.strength.ajax');
    });

    // Enquiry
    Route::prefix('/student/admission/enquiry')->group(function () {
        Route::get('/', [EnquiryController::class, 'index'])->name('enquiry.index');
        Route::get('create', [EnquiryController::class, 'create'])->name('enquiry.create');
        Route::post('/', [EnquiryController::class, 'store'])->name('enquiry.store');
        Route::delete('{id}', [EnquiryController::class, 'destroy'])->name('enquiry.destroy');
        Route::get('trashed', [EnquiryController::class, 'trashed'])->name('enquiry.trashed.index');
    });

    // ID Card
    Route::prefix('/id-card')->group(function () {
        Route::GET('/{id}/print', [\App\Http\Controllers\IDCardController::class, 'render'])->name('id.card.render');
    });

    // Website
    Route::prefix('/website')->group(function () {
        Route::get('/enquiry', [EnquiryPublicController::class, 'index'])->name('website.enquiry.index');
    });

    // Message
    Route::prefix('/send/message')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('message.index');
        Route::get('create', [MessageController::class, 'create'])->name('message.create');
        Route::post('/', [MessageController::class, 'store'])->name('message.store');
        Route::get('show', [MessageController::class, 'show'])->name('message.show');
        Route::get('/{id}/edit', [MessageController::class, 'edit'])->name('message.edit');
        Route::put('/{id}', [MessageController::class, 'update'])->name('message.update');
        Route::delete('{id}', [MessageController::class, 'destroy'])->name('message.destroy');
        Route::get('trashed', [MessageController::class, 'trashed'])->name('message.trashed.index');
        Route::get('{id}', [MessageController::class, 'restore'])->name('message.restore');
    });

    // Registration
    Route::prefix('/student/admission/registration')->group(function () {
        Route::get('/', [RegistrationController::class, 'index'])->name('registration.index');
        Route::get('create', [RegistrationController::class, 'create'])->name('registration.create');
        Route::post('/', [RegistrationController::class, 'store'])->name('registration.store');
        Route::delete('{id}', [RegistrationController::class, 'destroy'])->name('registration.destroy');
        Route::get('trashed', [RegistrationController::class, 'trashed'])->name('registration.trashed.index');
        Route::get('{id}', [RegistrationController::class, 'restore'])->name('registration.restore');
    });

    // Attendance
    Route::prefix('attendance')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('user.attendance.index');
        Route::post('/', [AttendanceController::class, 'store'])->name('user.attendance.store');
        // Report
        Route::get('/report/daily', [AttendanceController::class, 'daily'])->name('user.attendance.report.daily');
        Route::get('/report/monthly', [AttendanceController::class, 'monthly'])->name('user.attendance.report.monthly');
    });

    // Leave Management
    Route::prefix('attendance/leave-management/leave')->group(function () {
        Route::get('/', [LeaveManagementController::class, 'index'])->name('user.attendance.leave.management.index');
        // Create
        Route::get('/create', [LeaveManagementController::class, 'create'])->name('user.attendance.leave.management.create');
        Route::post('/create', [LeaveManagementController::class, 'store'])->name('user.attendance.leave.management.store');
        // Approval
        Route::get('/edit', [LeaveManagementController::class, 'edit'])->name('user.attendance.leave.management.edit');
        Route::get('/edit/{id}/accept', [LeaveManagementController::class, 'accept'])->name('user.attendance.leave.management.accept');
        Route::get('/edit/{id}/reject', [LeaveManagementController::class, 'reject'])->name('user.attendance.leave.management.reject');
        Route::get('/edit/{id}/destroy', [LeaveManagementController::class, 'destroy'])->name('user.attendance.leave.management.destroy');
        // Report
        Route::get('/report/daily', [LeaveManagementController::class, 'daily'])->name('user.attendance.leave.management.report.daily');
        Route::get('/report/monthly', [LeaveManagementController::class, 'monthly'])->name('user.attendance.leave.management.report.monthly');
    });
    // Inventry
    Route::prefix('/inventry')->group(function () {
        // Library
        Route::prefix('/library')->group(function () {
            Route::prefix('/book')->group(function () {
                Route::get('/', [App\Http\Controllers\Inventory\Library\BookController::class, 'render'])->name('inventry.library.book.render');
                Route::get('/create', [App\Http\Controllers\Inventory\Library\BookController::class, 'create'])->name('inventry.library.book.create');
                Route::post('/store', [App\Http\Controllers\Inventory\Library\BookController::class, 'store'])->name('inventry.library.book.store');
                Route::get('/show/{id}', [App\Http\Controllers\Inventory\Library\BookController::class, 'show'])->name('inventry.library.book.show');
                Route::get('/edit/{id}', [App\Http\Controllers\Inventory\Library\BookController::class, 'edit'])->name('inventry.library.book.edit');
                Route::post('/update/{id}', [App\Http\Controllers\Inventory\Library\BookController::class, 'update'])->name('inventry.library.book.update');
                Route::get('/get-authors', [App\Http\Controllers\Inventory\Library\BookController::class, 'getAuthors'])->name('inventry.library.book.getAuthors');
                Route::get('/get-books-title', [App\Http\Controllers\Inventory\Library\BookController::class, 'getBooksTitle'])->name('inventry.library.book.getBooksTitle');
            });
            Route::prefix('/location')->group(function () {
                Route::get('/', [App\Http\Controllers\Inventory\Library\LocationController::class, 'render'])->name('inventry.library.book.location.render');
                Route::get('/create', [App\Http\Controllers\Inventory\Library\LocationController::class, 'create'])->name('inventry.library.book.location.create');
                Route::post('/store', [App\Http\Controllers\Inventory\Library\LocationController::class, 'store'])->name('inventry.library.book.location.store');
                Route::get('/show/{id}', [App\Http\Controllers\Inventory\Library\LocationController::class, 'show'])->name('inventry.library.book.location.show');
                Route::get('/edit/{id}', [App\Http\Controllers\Inventory\Library\LocationController::class, 'edit'])->name('inventry.library.book.location.edit');
                Route::post('/update/{id}', [App\Http\Controllers\Inventory\Library\LocationController::class, 'update'])->name('inventry.library.book.location.update');
            });
            Route::prefix('/category')->group(function () {
                Route::get('/', [App\Http\Controllers\Inventory\Library\BookCategoryController::class, 'render'])->name('inventry.library.book.category.render');
                Route::get('/create', [App\Http\Controllers\Inventory\Library\BookCategoryController::class, 'create'])->name('inventry.library.book.category.create');
                Route::post('/store', [App\Http\Controllers\Inventory\Library\BookCategoryController::class, 'store'])->name('inventry.library.book.category.store');
                Route::get('/show/{id}', [App\Http\Controllers\Inventory\Library\BookCategoryController::class, 'show'])->name('inventry.library.book.category.show');
                Route::get('/edit/{id}', [App\Http\Controllers\Inventory\Library\BookCategoryController::class, 'edit'])->name('inventry.library.book.category.edit');
                Route::post('/update/{id}', [App\Http\Controllers\Inventory\Library\BookCategoryController::class, 'update'])->name('inventry.library.book.category.update');
            });
            // Route::prefix('/author')->group(function () {
            //     Route::get('/get', [App\Http\Controllers\Inventory\Library\BookAuthorController::class, 'getAuthor'])->name('inventry.library.book.author');
            //     Route::get('/', [App\Http\Controllers\Inventory\Library\BookAuthorController::class, 'render'])->name('inventry.library.book.author.render');
            //     Route::get('/create', [App\Http\Controllers\Inventory\Library\BookAuthorController::class, 'create'])->name('inventry.library.book.author.create');
            //     Route::post('/store', [App\Http\Controllers\Inventory\Library\BookAuthorController::class, 'store'])->name('inventry.library.book.author.store');
            //     Route::get('/show/{id}', [App\Http\Controllers\Inventory\Library\BookAuthorController::class, 'show'])->name('inventry.library.book.author.show');
            //     Route::get('/edit/{id}', [App\Http\Controllers\Inventory\Library\BookAuthorController::class, 'edit'])->name('inventry.library.book.author.edit');
            //     Route::post('/update/{id}', [App\Http\Controllers\Inventory\Library\BookAuthorController::class, 'update'])->name('inventry.library.book.author.update');
            // });
            Route::prefix('/publisher')->group(function () {
                Route::get('/get', [App\Http\Controllers\Inventory\Library\BookPublisherController::class, 'getPublisher'])->name('inventry.library.book.publisher');
                Route::get('/', [App\Http\Controllers\Inventory\Library\BookPublisherController::class, 'render'])->name('inventry.library.book.publisher.render');
                Route::get('/create', [App\Http\Controllers\Inventory\Library\BookPublisherController::class, 'create'])->name('inventry.library.book.publisher.create');
                Route::post('/store', [App\Http\Controllers\Inventory\Library\BookPublisherController::class, 'store'])->name('inventry.library.book.publisher.store');
                Route::get('/show/{id}', [App\Http\Controllers\Inventory\Library\BookPublisherController::class, 'show'])->name('inventry.library.book.publisher.show');
                Route::get('/edit/{id}', [App\Http\Controllers\Inventory\Library\BookPublisherController::class, 'edit'])->name('inventry.library.book.publisher.edit');
                Route::post('/update/{id}', [App\Http\Controllers\Inventory\Library\BookPublisherController::class, 'update'])->name('inventry.library.book.publisher.update');
            });

            Route::prefix('/supplier')->group(function () {
                Route::get('/', [App\Http\Controllers\Inventory\Library\BookSupplierController::class, 'render'])->name('inventry.library.book.supplier.render');
                Route::get('/create', [App\Http\Controllers\Inventory\Library\BookSupplierController::class, 'create'])->name('inventry.library.book.supplier.create');
                Route::post('/store', [App\Http\Controllers\Inventory\Library\BookSupplierController::class, 'store'])->name('inventry.library.book.supplier.store');
                Route::get('/show/{id}', [App\Http\Controllers\Inventory\Library\BookSupplierController::class, 'show'])->name('inventry.library.book.supplier.show');
                Route::get('/edit/{id}', [App\Http\Controllers\Inventory\Library\BookSupplierController::class, 'edit'])->name('inventry.library.book.supplier.edit');
                Route::post('/update/{id}', [App\Http\Controllers\Inventory\Library\BookSupplierController::class, 'update'])->name('inventry.library.book.supplier.update');
            });
            Route::prefix('/borror')->group(function () {
                Route::get('/', [App\Http\Controllers\Inventory\Library\BookBorrowController::class, 'render'])->name('inventry.library.book.borrow.render');
                Route::get('/returneds', [App\Http\Controllers\Inventory\Library\BookBorrowController::class, 'returneds'])->name('inventry.library.book.borrow.returneds');
                Route::get('/losts', [App\Http\Controllers\Inventory\Library\BookBorrowController::class, 'losts'])->name('inventry.library.book.borrow.losts');
                Route::get('/create', [App\Http\Controllers\Inventory\Library\BookBorrowController::class, 'create'])->name('inventry.library.book.borrow.create');
                Route::post('/store', [App\Http\Controllers\Inventory\Library\BookBorrowController::class, 'store'])->name('inventry.library.book.borrow.store');
                Route::get('/return/{id}', [App\Http\Controllers\Inventory\Library\BookBorrowController::class, 'return'])->name('inventry.library.book.borrow.return');
                Route::get('/lost/{id}', [App\Http\Controllers\Inventory\Library\BookBorrowController::class, 'lost'])->name('inventry.library.book.borrow.lost');
                Route::post('/update/{id}', [App\Http\Controllers\Inventory\Library\BookBorrowController::class, 'update'])->name('inventry.library.book.borrow.update');
                Route::get('/get-users', [App\Http\Controllers\Inventory\Library\BookBorrowController::class, 'getUsers'])->name('inventry.library.book.borrow.getUsers');
                Route::get('/get-books', [App\Http\Controllers\Inventory\Library\BookBorrowController::class, 'getBooks'])->name('inventry.library.book.borrow.getBooks');
            });
        });

        Route::prefix('/product')->group(function () {
            Route::get('/', [App\Http\Controllers\Inventory\Product\ProductController::class, 'render'])->name('inventory.product.render');
            Route::get('/create', [App\Http\Controllers\Inventory\Product\ProductController::class, 'create'])->name('inventory.product.create');
            Route::post('/store', [App\Http\Controllers\Inventory\Product\ProductController::class, 'store'])->name('inventory.product.store');
            Route::get('/{id}/show', [App\Http\Controllers\Inventory\Product\ProductController::class, 'show'])->name('inventory.product.show');
            Route::get('/{id}/edit', [App\Http\Controllers\Inventory\Product\ProductController::class, 'edit'])->name('inventory.product.edit');
            Route::post('/{id}/update', [App\Http\Controllers\Inventory\Product\ProductController::class, 'update'])->name('inventory.product.update');

            Route::prefix('/class')->group(function () {
                Route::get('/', [App\Http\Controllers\Inventory\Product\ClassHasProductController::class, 'render'])->name('inventory.product.class.render');
                Route::get('/{class_id}/has_products', [App\Http\Controllers\Inventory\Product\ClassHasProductController::class, 'classHasProducts'])->name('inventory.product.class.has_product.render');
                Route::get('/{class_id}/create', [App\Http\Controllers\Inventory\Product\ClassHasProductController::class, 'create'])->name('inventory.product.class.create');
                Route::post('/{class_id}/store', [App\Http\Controllers\Inventory\Product\ClassHasProductController::class, 'store'])->name('inventory.product.class.store');
                Route::get('/{id}/show', [App\Http\Controllers\Inventory\Product\ClassHasProductController::class, 'show'])->name('inventory.product.class.show');
                Route::get('/{id}/edit', [App\Http\Controllers\Inventory\Product\ClassHasProductController::class, 'edit'])->name('inventory.product.class.edit');
                Route::post('/{id}/update', [App\Http\Controllers\Inventory\Product\ClassHasProductController::class, 'update'])->name('inventory.product.class.update');
            });
            Route::prefix('/sale')->group(function () {
                Route::get('/', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'render'])->name('inventory.product.sale.render');
                Route::get('/create', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'create'])->name('inventory.product.sale.create');
                Route::post('/store', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'store'])->name('inventory.product.sale.store');
                Route::get('/{id}/show', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'show'])->name('inventory.product.sale.show');
                Route::get('/{id}/edit', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'edit'])->name('inventory.product.sale.edit');
                Route::post('/{id}/update', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'update'])->name('inventory.product.sale.update');
                Route::get('/{id}/invoice/print', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'invoicePrint'])->name('inventory.product.sale.invoice.print');
                Route::get('/get-users', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'getUsers'])->name('inventory.product.sale.getUsers');
                Route::get('/get-book-of-class', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'getBooksOfClass'])->name('inventory.product.sale.getBookOfClass');

                Route::get('/student', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'getUsers'])->name('inventory.product.sale.getStudents');
                // Route::post('/get-books', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'getBooks'])->name('inventory.product.sale.getBooks');
                Route::post('/get-books', [App\Http\Controllers\Inventory\Product\BookSaleController::class, 'getProducts'])->name('inventory.product.sale.getBooks');
            });
        });

        // Book
        // Route::prefix('/book')->group(function () {
        //     Route::get('/buy', [App\Http\Controllers\Book\BookController::class, 'create'])->name('book.buy.create');
        //     Route::get('/sale', [App\Http\Controllers\Book\SaleController::class, 'create'])->name('book.sale.create');
        //     Route::post('/sale', [App\Http\Controllers\Book\SaleController::class, 'store'])->name('book.sale.store');

        //     Route::prefix('/assign')->group(function () {
        //         Route::get('/', [App\Http\Controllers\Book\AssignController::class, 'render'])->name('book.assign.render');
        //         Route::get('/get-class-books/{id}', [App\Http\Controllers\Book\AssignController::class, 'classHasProducts'])->name('book.assign.get.class.books');
        //         Route::get('/get-classes', [App\Http\Controllers\Book\AssignController::class, 'getClasses'])->name('book.assign.get.classes');
        //         Route::get('/get-books', [App\Http\Controllers\Book\AssignController::class, 'getBooks'])->name('book.assign.get.books');
        //     });
        // });
    });

    // G-Suite
    Route::prefix('/g-suite')->group(function () {
        Route::get('/users/create', [GSuite::class, 'usersCreateIndex'])->name('gsuite.users.create.index');
        Route::get('/users/update', [GSuite::class, 'usersUpdateIndex'])->name('gsuite.users.update.index');
    });

    // Google
    Route::prefix('/google')->group(function () {
        // Workspace
        Route::prefix('/workspace')->group(function () {
            // Classroom
            Route::prefix('/classroom')->group(function () {
                Route::group(['middleware' => ['permission:classroom_class_create']], function () {
                    Route::get('/course/create', [
                        function () {
                            return view('google.workspace.classroom.create');
                        },
                    ])->name('google.workspace.classroom.course.create');
                    Route::post('/course/create', [CoursesController::class, 'createCourse'])->name('google.workspace.classroom.course.store');
                    Route::get('/{courseId}/delete', [CoursesController::class, 'deleteCourse'])->name('google.workspace.classroom.course.delete');
                });
                Route::get('/all/courses', [CoursesController::class, 'listCourses'])->name('google.workspace.classroom.listCourses');
                Route::get('/{courseId}/course', [CoursesController::class, 'getCourse'])->name('google.workspace.classroom.course');
            });
            Route::prefix('/admin')->group(function () {
                Route::group(['middleware' => ['permission:admin_console_access']], function () {
                    Route::get('/users', [GoogleUserController::class, 'suspended'])->name('google.workspace.admin.listUser');
                });
            });
        });
    });

    // LiveWire

    // Store Management System
    Route::prefix('/store-management-system')->group(function () {
        Route::get('/seller', \App\Livewire\StoreManagementSystem\Seller::class)->name('store-management-system.seller');
        Route::get('/{id}/products', \App\Livewire\StoreManagementSystem\Products::class)->name('store-management-system.products');
        Route::get('/{id}/cart', \App\Livewire\StoreManagementSystem\Cart::class)->name('store-management-system.cart');
        Route::get('/{id}/invoice-create', \App\Livewire\StoreManagementSystem\Invoice\InvoiceCreate::class)->name('store-management-system.invoice-create');
        Route::get('/{id}/{product_invoice_id}/invoice-show', \App\Livewire\StoreManagementSystem\Invoice\InvoiceShow::class)->name('store-management-system.invoice');
        Route::get('/{id}/{product_invoice_id}/invoice-print', \App\Livewire\StoreManagementSystem\Invoice\InvoicePrint::class)->name('store-management-system.invoice-print');
        Route::get('/invoices', \App\Livewire\StoreManagementSystem\Invoice\Invoices::class)->name('store-management-system.invoices');
        Route::get('/product-manage', \App\Livewire\StoreManagementSystem\ProductManage::class)->name('store-management-system.product-manage');
        Route::get('/class-has-product', \App\Livewire\StoreManagementSystem\ClassHasProduct::class)->name('store-management-system.class-has-product');
        Route::get('/{class_id}/class-has-product-manage', \App\Livewire\StoreManagementSystem\ClassHasProductManage::class)->name('store-management-system.class-has-product-manage');
        Route::get('/payment', \App\Livewire\StoreManagementSystem\Invoice\Payment::class)->name('store-management-system.invoice.payment');
        Route::get('/transaction', \App\Livewire\StoreManagementSystem\Invoice\Transaction::class)->name('store-management-system.invoice.transaction');
    });

    // Appointment
    Route::prefix('/appointment')->group(function () {
        Route::get('/', \App\Livewire\Appointment::class)->name('appointment');
    });

    // WhatsApp
    Route::prefix('/whatsapp')->group(function () {
        Route::get('/', \App\Livewire\Meta\Whatsapp::class)->name('whatsapp');
    });

    // Report Management System
    Route::prefix('/user-daily-report')->group(function () {
        Route::get('/', \App\Livewire\UserDailyReport::class)->name('user-daily-report');
        Route::get('/user-report_type', \App\Livewire\UserReportType::class)->name('user-report-type');
    });

    // Substitution Management System
    Route::prefix('/substitution')->group(function () {
        Route::get('/', \App\Livewire\Class\Substitution::class)->name('substitution');
    });

    // Substitution Management System
    Route::prefix('/user-attendance')->group(function () {
        Route::get('/', \App\Livewire\Attendance\UserAttendanceMonthly::class)->name('user-attendance.monthly');
    });
});
