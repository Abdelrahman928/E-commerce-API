<?php

use App\Http\Controllers\api\v1\auth\CartController;
use App\Http\Controllers\api\v1\auth\CategoryController;
use App\Http\Controllers\api\v1\auth\DiscountController;
use App\Http\Controllers\api\v1\auth\ManageProfileController;
use App\Http\Controllers\api\v1\auth\OrderController;
use App\Http\Controllers\api\v1\auth\ProductController;
use App\Http\Controllers\api\v1\auth\VerifyUserController;
use App\Http\Controllers\api\v1\ForgotPasswordController;
use App\Http\Controllers\api\v1\LoginController;
use App\Http\Controllers\api\v1\RegisterController;
use App\Http\Middleware\IsAdmin;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Route;

Route::prefix('V1')->group(function(){

    Route::middleware('throttle:api')->group(function(){
        Route::controller(LoginController::class)->group(function(){
            Route::post('/email-login',  'emailLogin');
            Route::post('/Phone-number-login', 'phoneLogin');
        });

        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetPasswordRequest']);
    });

    Route::middleware('throttle:api')->group(function(){
        Route::controller(RegisterController::class)->group(function(){
            Route::post('/register', 'registerUsingEmail');
            Route::post('/enter-phone-number', 'enterPhone');
        });
    });
    
    Route::middleware(['auth:sanctum', 'isVerified'])->group(function(){
        Route::controller(ForgotPasswordController::class)
        ->prefix('forgot-password')
        ->middleware('throttle:api')
        ->group(function(){
            Route::post('/forgot-password/verify', 'verify');
            Route::post('/forgot-password/reset-password', 'resetPassword');
        });
        
        Route::middleware('throttle:api')->group(function(){
            Route::controller(VerifyUserController::class)->group(function(){
                Route::post('/verify-email', 'verifyEmail');
                Route::post('/verify-Phone-number', 'verifyPhone');
            });
        });
        
        Route::controller(CategoryController::class)->group(function(){
            Route::get('/{category:name}','showCategory');
            Route::get('/{category:name}/products/{product:name}', 'showProduct');
            route::post('/{category:name}/products/{product:name}', 'addProductToCart')->middleware('throttle:api');
            route::post('/{category:name}/subcategories/{subcategory:name}/products/{product:name}', 'addToCart')->Middleware('throttle:api');
        });

        Route::controller(SubCategory::class)->group(function(){
            Route::get('/{category:name}/sub-categories/{subCategory:name}/products/{product:name}', 'showProduct');
            Route::get('/{category:name}/sub-categories/{subCategory:name}','showSubCategory');
        });

        Route::controller(CartController::class)->group(function(){
            route::get('/cart-items','index');
            route::get('/cart-items/{cartItem:name}', 'show');
            route::patch('/cart-items/{cartItem:name}', 'update')->middleware('throttle:api');
            route::delete('/cart-items/{cartItem:name}', 'destroy')->middleware('throttle:api');
        });

        Route::controller(ManageProfileController::class)->group(function(){
            Route::middleware('throttle:api')->group(function(){
                Route::post('/profile/manage', 'changeEmail');
                Route::post('/profile/manage', 'changePassword');
                Route::post('/profile/manage', 'verifyDeletePhone');
                Route::post('/profile/manage', 'deletePhone');
                Route::post('/profile/manage', 'addPhone');
                Route::post('/profile/manage', 'verifyPhone');
                Route::post('/profile/payment', 'addPaymentMethod');
            });
            Route::get('/profile/manage', 'show');
            Route::get('/profile/addresses', 'indexShippingAddresses');
            Route::post('/profile/addresses', 'createShippingAddress')->middleware('trhottle:api');
            Route::get('/profile/payment', 'indexPaymentMethods');
        });

        Route::controller(OrderController::class)->group(function(){
            Route::get('/user-cart/review-order', 'index');

            Route::controller(ManageProfileController::class)->group(function(){
                Route::get('/user-cart/review-order/chose-payment-method', 'indexPaymentMethods');
                Route::get('/user-cart/review-order/chose-shipping-address', 'indexShippingAddresses');

                Route::middleware('throttle:api')->group(function(){
                    Route::post('/user-cart/review-order/chose-payment-method', 'addPaymentMethod');
                    Route::post('/user-cart/review-order/chose-shipping-address', 'createShippingAddresses');
                });
            });

            Route::post('/user-cart/review-order/payment', 'payment');
        });
        
        Route::post('logout', [LoginController::class, 'logoutUser']);
    });

    Route::middleware(['auth:sanctum', IsAdmin::class])->group(function(){
        Route::middleware('throttle:admin')->group(function(){
            Route::controller(ProductController::class)->group(function(){
                Route::post('/add-product/create', 'create');
                Route::patch('/product/{product:name}', 'update');
                Route::delete('product/{product:name}', 'destroy');
            });
    
            Route::controller(CategoryController::class)->group(function(){
                Route::post('/create-new-category','create');
                Route::delete('/categories/{category:name}','destroy');
            });
    
            Route::controller(DiscountController::class)->group(function(){
                Route::post('/add-discount', 'addDiscount');
            });    
        });
        Route::get('/list-items', [DiscountController::class, 'listDiscountables']);
        Route::get('/add-product/list-categories', [ProductController::class, 'allCategoriesWithSubcategories']);
    });
});