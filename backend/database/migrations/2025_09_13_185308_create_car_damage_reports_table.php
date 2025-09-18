<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('car_damage_reports', function (Blueprint $table) {
            $table->id();
            $table->string('reporter_name');
            $table->string('car_model');
            $table->string('license_plate');
            $table->text('description');
            $table->string('damage_level'); // e.g. minor, moderate, severe
            $table->boolean('is_resolved')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_damage_reports');
    }
};
