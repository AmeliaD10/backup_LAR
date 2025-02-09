<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProfilePictureNullableInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('profile_picture')->nullable()->change();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('profile_picture')->nullable(false)->change();
    });
}

}
