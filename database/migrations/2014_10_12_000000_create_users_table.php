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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->string("phone_number")->nullable()->unique();
            $table->string("country")->nullable();
            $table->string("state")->nullable();
            $table->string("city")->nullable();
            $table->string("street_adress")->nullable();
            $table->date("birthday")->nullable();
            $table->enum("gender",["male","female"])->default("male");
            $table->text("bio")->nullable();
            $table->enum("status",["single","married"])->default("single");
            $table->string("front_image")->nullable();
            $table->string("back_image")->nullable();
            $table->string("education_status")->nullable();
            $table->string("intrests")->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp("last_active")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
