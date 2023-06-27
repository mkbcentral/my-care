<?php

use App\Models\BloodGroup;
use App\Models\City;
use App\Models\Country;
use App\Models\Municipality;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('id_code')->nullable();
            $table->string('full_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('social_security_number')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone_number')->nullable();
            $table->foreignIdFor(BloodGroup::class)->constrained();
            $table->string('district')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_street_number')->nullable();
            $table->foreignIdFor(Country::class)->constrained();
            $table->foreignIdFor(City::class)->nullable()->constrained();
            $table->foreignIdFor(Municipality::class)->nullable()->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
