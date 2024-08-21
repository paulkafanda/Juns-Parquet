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

        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('nom');
            $table->string('post_nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->string('sexe');
            $table->string('tel');
            $table->string('origine');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
