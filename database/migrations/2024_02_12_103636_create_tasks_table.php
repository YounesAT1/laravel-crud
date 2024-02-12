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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('idT');
            $table->bigInteger('idP')->unsigned();
            $table->bigInteger('idD')->unsigned();
            $table->integer('durationHours');
            $table->decimal('priceHour',8,2);
            $table->string('state');
            $table->foreign('idP')->references('idP')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idD')->references('idD')->on('developers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
