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
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->integer('subscriber');
            $table->integer('post');
            $table->integer('status')->default(0);
            $table->float('value');
            $table->string('pay')->nullable();
            $table->integer('private')->default(1);
            $table->integer('view')->default(0);
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gifts');
    }
};
