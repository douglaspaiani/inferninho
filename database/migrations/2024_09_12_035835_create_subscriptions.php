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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('user');
            $table->integer('subscriber');
            $table->integer('plan')->default(1);
            $table->integer('status')->default(1);
            $table->integer('renew')->default(0);
            $table->date('due_date');
            $table->float('price');
            $table->string('method');
            $table->string('final_card')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
