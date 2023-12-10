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
            $table->string('name');
<<<<<<< HEAD
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
=======
            $table->string('lastname')->nullable;
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->text('bio')->nullable();
>>>>>>> c401750 (Initial commit for assignment-3)
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
