<?php

use App\Models\CenterHospital;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\User;
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
        Schema::create('consultation_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('sheet_number')->nullable();
            $table->boolean('active')->default(false);
            $table->foreignIdFor(Patient::class)->constrained();
            $table->foreignIdFor(CenterHospital::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_sheets');
    }
};
