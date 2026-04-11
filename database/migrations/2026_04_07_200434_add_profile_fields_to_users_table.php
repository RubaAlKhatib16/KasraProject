<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
            $table->string('phone')->unique()->nullable()->after('email');
            $table->date('dob')->nullable()->after('phone');
            $table->enum('gender', ['male', 'female'])->nullable()->after('dob');
            $table->boolean('marketing')->default(false)->after('gender');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'phone', 'dob', 'gender', 'marketing']);
        });
    }
};