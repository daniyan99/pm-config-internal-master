<?php
    
    use Illuminate\Http\Request;
    
    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */
    
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('product/quick-preview', 'ProductController@quickPreview')->name('product.quickPreview');
    Route::get('product/create-product', 'ProductController@productCreate')->name('product.productCreate');
    
    Route::get('configurator/preload-images', 'Configurator\\ConfiguratorController@preloadImages')->name('configurator.preloadImages');
    Route::get('configurator/request-image', 'Configurator\\ConfiguratorController@getImageBasedOnRequest')->name('configurator.requestImage');
    
    
    
    Route::resource('product', 'ProductController');
    
