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
        $pivotMember = 'member_id';
        $pivotUser = 'user_id';

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('gender');
            $table->date('birth_date');
            $table->string('birthplace');
            $table->string('document_rg', length: 12)->nullable();
            $table->string('document_cpf', length: 14)->nullable()->unique();
            $table->unsignedTinyInteger('marital_status');
            $table->date('marriage_date')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', length: 14)->nullable();
            $table->string('secondary_phone', length: 14)->nullable();
            $table->string('mobile_phone', length: 15)->nullable();
            $table->string('street');
            $table->string('number', length: 6);
            $table->string('complement')->nullable();
            $table->string('neighborhood');
            $table->string('postal_code', length: 9);
            $table->string('city');
            $table->string('state', length: 2);
            $table->unsignedTinyInteger('educational_level')->nullable();
            $table->string('occupation')->nullable();
            $table->boolean('is_under_discipline')->default(false);
            $table->boolean('is_baptized')->default(false);
            $table->date('baptism_date')->nullable();
            $table->string('baptism_church')->nullable();
            $table->string('baptism_pastor')->nullable();
            $table->boolean('has_professed_faith')->default(false);
            $table->date('profession_of_faith_date')->nullable();
            $table->string('profession_of_faith_church')->nullable();
            $table->string('profession_of_faith_pastor')->nullable();
            $table->string('last_church')->nullable();
            $table->dateTime('created_at', precision: 0)->useCurrent();
            $table->dateTime('updated_at', precision: 0)->useCurrent()->useCurrentOnUpdate();
            $table->index('name', 'members_name_index');
        });

        Schema::create('member_admissions', function (Blueprint $table) use ($pivotMember, $pivotUser) {
            $table->id();
            $table->unsignedTinyInteger('membership_type');
            $table->unsignedTinyInteger('membership_status');
            $table->string('admission_order');
            $table->date('admission_date');
            $table->integer('admission_reason');
            $table->integer('admission_minute');
            $table->date('dismissal_date')->nullable();
            $table->integer('dismissal_reason')->nullable();
            $table->integer('dismissal_minute')->nullable();
            $table->unsignedBigInteger($pivotUser)->index();
            $table->unsignedBigInteger($pivotMember);
            $table->dateTime('created_at', precision: 0)->useCurrent();
            $table->dateTime('updated_at', precision: 0)->useCurrent()->useCurrentOnUpdate();

            $table->foreign($pivotMember)
                ->references('id') // member id
                ->on('members')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_admissions');
        Schema::dropIfExists('members');
    }
};
