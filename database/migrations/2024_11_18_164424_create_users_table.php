<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('first_name'); // First Name (REQUIRED)
            $table->string('middle_name'); // Middle Name (REQUIRED)
            $table->string('last_name'); // Last Name (REQUIRED)
            $table->string('email')->unique(); // Email (unique and REQUIRED)
            $table->string('password'); // Password (REQUIRED)
            // $table->string('profile_picture'); // Profile Picture (optional)
            $table->timestamps(); // Created_at and Updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
