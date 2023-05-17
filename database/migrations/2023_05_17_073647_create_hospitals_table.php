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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Country::class);
            $table->string('name',255);
            $table->string('abbreviation',255)->nullable();
            $table->string('logo',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('phone',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('street',255)->nullable();
            $table->string('number_street',255)->nullable();
            $table->decimal('long',)->default(0);
            $table->decimal('lat',)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
