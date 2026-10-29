<?php

namespace Tests\Feature;

use App\Models\LoanApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LoanApplicationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'email' => 'admin@dharmasiaga.co.id',
            'name' => 'Admin KSP Dharma Siaga',
            'password' => Hash::make('DharmaSiaga2026!'),
        ]);
    }

    public function test_public_loan_application_form_page_renders_successfully_with_pdf_sections(): void
    {
        $response = $this->get('/pengajuan-kredit');

        $response->assertOk()
            ->assertSee('Formulir Permohonan Pinjaman')
            ->assertSee('DATA PEMINJAM')
            ->assertSee('PENANGGUNG JAWAB')
            ->assertSee('AHLI WARIS')
            ->assertSee('DATA KELUARGA LAIN YANG BISA DIHUBUNGI')
            ->assertSeeText('PERSYARATAN DOKUMEN & CATATAN')
            ->assertSee('PERNYATAAN DAN PERSETUJUAN')
            ->assertSee('name="loan_amount"', false)
            ->assertSee('name="mother_maiden_name"', false)
            ->assertSee('name="guarantor_name"', false)
            ->assertSee('name="heir_name"', false);
    }

    public function test_loan_application_submission_validates_required_fields(): void
    {
        $response = $this->from('/pengajuan-kredit')->post('/pengajuan-kredit', []);

        $response->assertRedirect('/pengajuan-kredit')
            ->assertSessionHasErrors([
                'name',
                'occupation',
                'current_address',
                'origin_address',
                'phone',
                'loan_amount',
                'loan_purpose',
                'loan_term_months',
                'collateral_type',
                'payment_scheme',
                'mother_maiden_name',
                'guarantor_name',
                'heir_name',
                'has_agreed',
            ]);

        $this->assertDatabaseCount('loan_applications', 0);
    }

    public function test_user_can_submit_valid_loan_application_with_document_uploads(): void
    {
        Storage::fake('public');

        $payload = [
            'name' => 'I Wayan Sudarma',
            'occupation' => 'Dagang',
            'current_address' => 'Jl. Pura Demak No. 10, Denpasar',
            'origin_address' => 'Desa Mengwi, Badung',
            'correspondence_address' => 'Jl. Pura Demak No. 10, Denpasar',
            'phone' => '081234567890',
            'loan_amount' => '50.000.000',
            'loan_purpose' => 'Tambahan modal kerja toko kelontong',
            'loan_term_months' => 24,
            'collateral_type' => 'BPKB Sepeda Motor',
            'collateral_description' => 'Honda PCX 160cc Tahun 2023 DK 4567 AA',
            'payment_scheme' => 'Transfer',
            'mother_maiden_name' => 'Ni Wayan Rai',
            'application_date' => now()->toDateString(),
            'guarantor_name' => 'Ni Luh Putu Astuti',
            'guarantor_relationship' => 'Istri',
            'guarantor_occupation' => 'Pegawai Swasta',
            'guarantor_phone' => '081987654321',
            'guarantor_current_address' => 'Jl. Pura Demak No. 10, Denpasar',
            'guarantor_origin_address' => 'Desa Mengwi, Badung',
            'heir_name' => 'I Gede Aditya',
            'heir_relationship' => 'Anak',
            'heir_occupation' => 'Pelajar/Mahasiswa',
            'heir_phone' => '08122334455',
            'heir_current_address' => 'Jl. Pura Demak No. 10, Denpasar',
            'heir_origin_address' => 'Desa Mengwi, Badung',
            'emergency_sibling_name' => 'I Made Suwena',
            'emergency_sibling_phone' => '081333444555',
            'emergency_sibling_address' => 'Jl. Gunung Salak, Denpasar',
            'notes' => 'Mohon diproses sebelum akhir bulan.',
            'has_agreed' => '1',
            'ktp_file' => UploadedFile::fake()->create('ktp_pemohon.pdf', 500, 'application/pdf'),
        ];

        $response = $this->post('/pengajuan-kredit', $payload);

        $application = LoanApplication::first();
        $this->assertNotNull($application);
        $this->assertEquals('I Wayan Sudarma', $application->name);
        $this->assertEquals(50000000, $application->loan_amount);
        $this->assertEquals('pending', $application->status);
        $this->assertStringStartsWith('DS-PK-', $application->reference_number);
        $this->assertNotNull($application->ktp_file);

        Storage::disk('public')->assertExists($application->ktp_file);

        $response->assertRedirect(route('loan-applications.success', $application->reference_number));
    }

    public function test_success_page_renders_application_reference_and_details(): void
    {
        $application = LoanApplication::factory()->create([
            'name' => 'Ni Kadek Arini',
            'loan_amount' => 25000000,
            'loan_term_months' => 12,
        ]);

        $response = $this->get(route('loan-applications.success', $application->reference_number));

        $response->assertOk()
            ->assertSee('Permohonan Pinjaman Berhasil Dikirim!')
            ->assertSee($application->reference_number)
            ->assertSee('Ni Kadek Arini')
            ->assertSee('Rp 25.000.000')
            ->assertSee('12 Bulan');
    }

    public function test_unauthenticated_user_cannot_access_admin_panel(): void
    {
        $response = $this->get('/admin/pengajuan-kredit');

        $response->assertRedirect('/admin/login');
    }

    public function test_login_page_renders_without_registration_option(): void
    {
        $response = $this->get('/admin/login');

        $response->assertOk()
            ->assertSee('Panel Petugas')
            ->assertSee('Masuk ke Panel')
            ->assertDontSeeText('Register')
            ->assertDontSeeText('Daftar Akun Baru')
            ->assertDontSee('href="/register"', false)
            ->assertDontSee('href="'.url('/register').'"', false);
    }

    public function test_admin_can_authenticate_successfully(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@dharmasiaga.co.id',
            'password' => 'DharmaSiaga2026!',
        ]);

        $response->assertRedirect(route('admin.loan-applications.index'));
        $this->assertAuthenticatedAs($this->admin);
    }

    public function test_admin_fails_authentication_with_wrong_password(): void
    {
        $response = $this->from('/admin/login')->post('/admin/login', [
            'email' => 'admin@dharmasiaga.co.id',
            'password' => 'WrongPassword!',
        ]);

        $response->assertRedirect('/admin/login')
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_authenticated_admin_can_view_loan_applications_list_and_filter(): void
    {
        LoanApplication::factory()->count(3)->create(['status' => LoanApplication::STATUS_PENDING]);
        LoanApplication::factory()->count(2)->approved()->create();

        $response = $this->actingAs($this->admin)->get('/admin/pengajuan-kredit');

        $response->assertOk()
            ->assertSee('Daftar Pengajuan Pinjaman Kredit')
            ->assertSee('Menunggu Survey')
            ->assertSee('Disetujui');

        $pendingOnly = $this->actingAs($this->admin)->get('/admin/pengajuan-kredit?status=pending');
        $pendingOnly->assertOk();
    }

    public function test_authenticated_admin_can_view_application_detail_and_print_view(): void
    {
        $application = LoanApplication::factory()->create([
            'name' => 'I Ketut Darmawan',
            'phone' => '081234567899',
            'loan_amount' => 75000000,
        ]);

        $showResponse = $this->actingAs($this->admin)->get(route('admin.loan-applications.show', $application));
        $showResponse->assertOk()
            ->assertSee($application->reference_number)
            ->assertSee('I Ketut Darmawan')
            ->assertSee('DATA PEMINJAM')
            ->assertSee('PENANGGUNG JAWAB');

        $printResponse = $this->actingAs($this->admin)->get(route('admin.loan-applications.print', $application));
        $printResponse->assertOk()
            ->assertSee('FORMULIR PERMOHONAN PINJAMAN')
            ->assertSee($application->reference_number)
            ->assertSee('I Ketut Darmawan');
    }

    public function test_authenticated_admin_can_update_application_status_and_notes(): void
    {
        $application = LoanApplication::factory()->create([
            'status' => LoanApplication::STATUS_PENDING,
        ]);

        $response = $this->actingAs($this->admin)
            ->patch(route('admin.loan-applications.status', $application), [
                'status' => 'approved',
                'admin_notes' => 'Telah dilakukan survei lapangan dan disetujui komite pinjaman.',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('loan_applications', [
            'id' => $application->id,
            'status' => 'approved',
            'admin_notes' => 'Telah dilakukan survei lapangan dan disetujui komite pinjaman.',
        ]);
    }

    public function test_authenticated_admin_can_logout(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/logout');

        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
