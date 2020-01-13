<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */
Route::group(['middleware' => [], 'prefix' => 'admin'], function () {
    Route::namespace('CodersStudio\LanguageLine\Http\Controllers')->group(function () {
        Route::pattern('languageline', '[0-9]+');
        Route::resource('/languagelines', 'LanguagelineController');
        Route::post('/languagelines/massdestroy', 'LanguagelineController@massDestroy')->name('languagelines.massdestroy');
        Route::put('/languagelines/{languageline}/toggleboolean', 'LanguagelineController@toggleBoolean')->name('languagelines.toggleboolean');
        Route::get('/languagelines/export', 'LanguagelineController@export')->name('languagelines.export');
        Route::post('/languagelines/import', 'LanguagelineController@import')->name('languagelines.import');
        Route::post('/languagelines/scan', 'LanguagelineController@scanTranslations');
    });
});
