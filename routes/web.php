<?php

Route::group(['middleware' => ['web', 'auth', 'role:admin'], 'prefix' => 'admin'], function () {
    Route::namespace('Nos\LanguageLine\Http\Controllers')->group(function () {
        Route::pattern('languageline', '[0-9]+');
        Route::resource('/languagelines', 'LanguageLineController');
        Route::post('/languagelines/massdestroy', 'LanguageLineController@massDestroy')->name(
            'languagelines.massdestroy'
        );
        Route::put('/languagelines/{languageline}/toggleboolean', 'LanguageLineController@toggleBoolean')->name(
            'languagelines.toggleboolean'
        );
        Route::get('/languagelines/export', 'LanguageLineController@export')->name('languagelines.export');
        Route::post('/languagelines/import', 'LanguageLineController@import')->name('languagelines.import');
        Route::post('/languagelines/scan', 'LanguageLineController@scanTranslations')->name('languagelines.scan');
    });
});
