<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersRoleToString extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Change to simple string - PostgreSQL friendly
            $table->string('role', 50)->default('user')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 50)->default('cashier')->change();
        });
    }
}