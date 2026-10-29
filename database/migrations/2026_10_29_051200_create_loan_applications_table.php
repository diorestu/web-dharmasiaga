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
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number', 40)->unique();
            $table->string('status', 20)->default('pending')->index();
            $table->text('admin_notes')->nullable();

            // A. DATA PEMINJAM
            $table->string('name', 150);
            $table->string('occupation', 100);
            $table->string('occupation_other', 150)->nullable();
            $table->text('current_address');
            $table->text('origin_address');
            $table->text('correspondence_address')->nullable();
            $table->string('phone', 40);
            $table->unsignedBigInteger('loan_amount');
            $table->string('loan_purpose', 255);
            $table->unsignedInteger('loan_term_months');
            $table->string('collateral_type', 100);
            $table->text('collateral_description')->nullable();
            $table->string('payment_scheme', 50);
            $table->string('mother_maiden_name', 150);
            $table->date('application_date');

            // B. PENANGGUNG JAWAB
            $table->string('guarantor_name', 150);
            $table->string('guarantor_occupation', 100)->nullable();
            $table->text('guarantor_current_address')->nullable();
            $table->text('guarantor_origin_address')->nullable();
            $table->string('guarantor_phone', 40)->nullable();
            $table->string('guarantor_relationship', 100)->nullable();

            // C. AHLI WARIS
            $table->string('heir_name', 150);
            $table->string('heir_occupation', 100)->nullable();
            $table->text('heir_current_address')->nullable();
            $table->text('heir_origin_address')->nullable();
            $table->string('heir_phone', 40)->nullable();
            $table->string('heir_relationship', 100)->nullable();

            // D. DATA KELUARGA LAIN YANG BISA DIHUBUNGI
            $table->string('emergency_sibling_name', 150)->nullable();
            $table->text('emergency_sibling_address')->nullable();
            $table->string('emergency_sibling_phone', 40)->nullable();
            $table->string('emergency_other_name', 150)->nullable();
            $table->text('emergency_other_address')->nullable();
            $table->string('emergency_other_phone', 40)->nullable();

            // Persyaratan Dokumen & Catatan Tambahan
            $table->text('notes')->nullable();
            $table->string('ktp_file', 255)->nullable();
            $table->string('kk_file', 255)->nullable();
            $table->string('collateral_file', 255)->nullable();
            $table->string('income_slip_file', 255)->nullable();
            $table->string('location_sketch_file', 255)->nullable();
            $table->boolean('has_agreed')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
