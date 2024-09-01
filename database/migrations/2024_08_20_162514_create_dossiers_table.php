<?php

use App\Models\Plainte;
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
            $table->string('nom');
            $table->date('date_ouverture')->default(now());
            $table->string('suite_reservee')->nullable();
            $table->date('date_fixation')->nullable();
            $table->date('date_classement')->nullable();
            $table->foreignIdFor(Plainte::class)->constrained();
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
