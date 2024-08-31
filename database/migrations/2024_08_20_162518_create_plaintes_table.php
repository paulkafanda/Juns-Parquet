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
        Schema::disableForeignKeyConstraints();

        Schema::create('plaintes', function (Blueprint $table) {
            $table->id();
            $table->string('motif');
            $table->integer('magistrat_id')->nullable();
            $table->integer('plaignant_id');
            $table->integer('accusee_id');

            $table->foreign('magistrat_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('plaignant_id')->references('id')->on('parties')->cascadeOnDelete();
            $table->foreign('accusee_id')->references('id')->on('parties')->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plaintes');
    }
};
