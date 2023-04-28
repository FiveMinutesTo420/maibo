<?php

use App\Models\Doctor;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->foreignIdFor(Clinic::class, 'clinic_id');
            $table->foreignIdFor(Doctor::class, 'doctor_id');
            $table->dateTime('date');
            $table->text('comment');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
