<?php

namespace Database\Factories;

use App\Models\LoanApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LoanApplication>
 */
class LoanApplicationFactory extends Factory
{
    protected $model = LoanApplication::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference_number' => 'DS-PK-'.date('Ym').'-'.fake()->unique()->numerify('####'),
            'status' => LoanApplication::STATUS_PENDING,
            'admin_notes' => null,
            'name' => fake()->name(),
            'occupation' => fake()->randomElement(['Dagang', 'Pariwisata', 'Jasa', 'Industri', 'Pegawai']),
            'occupation_other' => null,
            'current_address' => fake()->address(),
            'origin_address' => fake()->address(),
            'correspondence_address' => fake()->address(),
            'phone' => '0812'.fake()->numerify('########'),
            'loan_amount' => fake()->randomElement([10000000, 25000000, 50000000, 75000000, 100000000]),
            'loan_purpose' => fake()->randomElement(['Modal Usaha', 'Konsumtif', 'Pembelian Kendaraan', 'Renovasi Rumah']),
            'loan_term_months' => fake()->randomElement([12, 24, 36, 48, 60]),
            'collateral_type' => fake()->randomElement(['BPKB Sepeda Motor', 'BPKB Mobil', 'Sertifikat Hak Milik (SHM)', 'Simpanan Berjangka']),
            'collateral_description' => 'Agunan sah an. Pemohon',
            'payment_scheme' => fake()->randomElement(['Langsung', 'Transfer', 'Di Jemput', 'Debet Tabungan']),
            'mother_maiden_name' => fake()->name('female'),
            'application_date' => now()->toDateString(),
            'guarantor_name' => fake()->name(),
            'guarantor_occupation' => fake()->jobTitle(),
            'guarantor_current_address' => fake()->address(),
            'guarantor_origin_address' => fake()->address(),
            'guarantor_phone' => '0813'.fake()->numerify('########'),
            'guarantor_relationship' => fake()->randomElement(['Suami/Istri', 'Orang Tua', 'Saudara Kandung']),
            'heir_name' => fake()->name(),
            'heir_occupation' => fake()->jobTitle(),
            'heir_current_address' => fake()->address(),
            'heir_origin_address' => fake()->address(),
            'heir_phone' => '0819'.fake()->numerify('########'),
            'heir_relationship' => fake()->randomElement(['Anak', 'Istri', 'Suami']),
            'emergency_sibling_name' => fake()->name(),
            'emergency_sibling_address' => fake()->address(),
            'emergency_sibling_phone' => '0878'.fake()->numerify('########'),
            'emergency_other_name' => fake()->name(),
            'emergency_other_address' => fake()->address(),
            'emergency_other_phone' => '0857'.fake()->numerify('########'),
            'notes' => fake()->sentence(),
            'has_agreed' => true,
        ];
    }

    public function review(): static
    {
        return $this->state(fn () => [
            'status' => LoanApplication::STATUS_REVIEW,
            'admin_notes' => 'Sedang dilakukan verifikasi berkas oleh analis kredit.',
        ]);
    }

    public function approved(): static
    {
        return $this->state(fn () => [
            'status' => LoanApplication::STATUS_APPROVED,
            'admin_notes' => 'Disetujui komite kredit dengan plafon penuh.',
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn () => [
            'status' => LoanApplication::STATUS_REJECTED,
            'admin_notes' => 'Kapasitas angsuran belum mencukupi.',
        ]);
    }
}
