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
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->integer('top')->default(0);
            $table->integer('verify')->default(0);
            $table->integer('likes')->default(0);
            $table->date('birth')->nullable();
            $table->string('photo')->nullable();
            $table->string('username')->nullable();
            $table->string('cover')->nullable();
            $table->string('description')->nullable();
            $table->string('cpf')->nullable();
            $table->string('pix')->nullable();
            $table->integer('creator')->default(0);
            $table->string('token')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('telegram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('site')->nullable();
            $table->float('price_1')->nullable();
            $table->float('price_3')->nullable();
            $table->float('price_6')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->integer('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('hidden_name')->default(0);
            $table->integer('timer')->default(0);
            $table->integer('ban')->default(0);
            $table->string('customer')->nullable();
            $table->string('wallet')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
