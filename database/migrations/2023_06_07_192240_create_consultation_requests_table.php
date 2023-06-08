<?php

use App\Models\CenterHospital;
use App\Models\Consultation;
use App\Models\ConsultationSheet;
use App\Models\FromSheet;
use App\Models\Patient;
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
        Schema::create('consultation_requests', function (Blueprint $table) {
            $table->id();
            $table->string('number_request')->nullable();
            $table->foreignIdFor(CenterHospital::class)->constrained();
            $table->foreignIdFor(ConsultationSheet::class)->constrained();
            $table->foreignIdFor(Consultation::class)->constrained();
            $table->enum('status',['IN_PROCESS','VALIDED','REJECTED'])->default('IN_PROCESS');
            $table->enum('health_status',['HEALED','DEAD','REJECTED'])->default('HEALED');
            $table->boolean('is_hospitalized')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_requests');
    }
};
