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

        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
            $table->date('date_ouverture');
            $table->string('suite_reservee');
            $table->date('date_fixation');
            $table->date('data_classement');
            $table->foreignId('partie_id')->constrained('parties');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
