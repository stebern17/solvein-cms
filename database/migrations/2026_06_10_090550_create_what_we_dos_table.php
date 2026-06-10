<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('what_we_dos', function (Blueprint $table) {
            $table->id();
            $table->string('title_1');
            $table->string('image_1');
            $table->jsonb('description_1');
            $table->string('title_2');
            $table->string('image_2');
            $table->jsonb('description_2');
            $table->string('title_3');
            $table->string('image_3');
            $table->jsonb('description_3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('what_we_dos');
    }
};
