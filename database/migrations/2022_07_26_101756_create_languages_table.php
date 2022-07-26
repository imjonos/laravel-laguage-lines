<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable('languages')) {
            Schema::create('languages', function (Blueprint $table) {
                $table->id();
                $table->string('abbr', 10);
                $table->string('locale', 20)->nullable()->default(null);
                $table->string('name', 100);
                $table->tinyInteger('default')->default(0);
                $table->tinyInteger('active')->default(1);
                $table->timestamps();

                $table->index(["active"], 'active');
                $table->index(["default"], 'default');
                $table->unique(["abbr"], 'abbr');
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
}
