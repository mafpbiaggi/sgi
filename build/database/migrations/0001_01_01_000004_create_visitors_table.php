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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 50);
            $table->integer('age');
            $table->string('phone', length: 15);
            $table->string('email', length: 30);
            $table->date('visit_date');
            $table->string('attends_church', length: 70)->nullable();
            $table->string('prayer_request', length: 70)->nullable();
            $table->string('referral_source', length: 1);
            $table->string('referral_source_social_media', length: 50)->nullable();
            $table->string('referral_source_other', length: 50)->nullable();
            $table->dateTime('created_at', precision: 0);
            $table->dateTime('updated_at', precision: 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
