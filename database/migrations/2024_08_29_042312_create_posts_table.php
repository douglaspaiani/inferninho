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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->string('description')->nullable();
            $table->text('photos')->nullable();
            $table->string('video')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('private')->default(0);
            $table->float('value')->default(0);
            $table->integer('nocomments')->default(0);
            $table->float('views')->default(0);
            $table->integer('public')->default(0);
            $table->datetime('schedule')->nullable();
            $table->datetime('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
