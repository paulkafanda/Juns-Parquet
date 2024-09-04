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

            $table->foreignIdFor(\App\Models\User::class, 'magistrat_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Partie::class, 'plaignant_id')->constrained('parties')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Partie::class, 'accusee_id')->constrained('parties')->cascadeOnDelete();

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
