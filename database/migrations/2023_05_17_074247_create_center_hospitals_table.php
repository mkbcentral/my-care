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
        Schema::create('center_hospitals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Hospital::class)->constrained();
            $table->foreignIdFor(\App\Models\City::class)->constrained();
            $table->string('name',255);
            $table->string('center_phone',255)->nullable();
            $table->string('municipality',255)->nullable();
            $table->string('street',255)->nullable();
            $table->string('number_street',255)->nullable();
            $table->decimal('long',)->default(0);
            $table->decimal('lat',)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('center_hospitals');
    }
};
