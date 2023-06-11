<?php

use App\Models\SheetTypePatient;
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
        Schema::table('consultation_sheets', function (Blueprint $table) {
            $table->foreignIdFor(SheetTypePatient::class)->after('center_hospital_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultation_sheets', function (Blueprint $table) {
            $table->dropColumn('sheet_type_patient_id');
        });
    }
};
