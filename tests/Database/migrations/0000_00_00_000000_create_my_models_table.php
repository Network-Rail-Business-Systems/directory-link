<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('my_models', function (Blueprint $table) {
            $table->string('azure_id')->primary();
            $table->string('business_area');
            $table->string('email');
            $table->string('employee_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('location');
            $table->string('name');
            $table->string('phone');
            $table->string('title');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('my_models');
    }
};
