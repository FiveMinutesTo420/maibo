<?php

use App\Models\Diagnostic;
use App\Models\Clinic;
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
        Schema::create('clinic_diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Clinic::class, 'clinic_id');
            $table->foreignIdFor(Diagnostic::class, 'diagnostic_id');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_diagnostics');
    }
};
