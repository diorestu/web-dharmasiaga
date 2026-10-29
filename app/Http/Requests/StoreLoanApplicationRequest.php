<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLoanApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare inputs before validation (sanitize currency and date).
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('loan_amount')) {
            $cleaned = preg_replace('/\D/', '', (string) $this->input('loan_amount'));
            $this->merge([
                'loan_amount' => $cleaned !== '' ? (int) $cleaned : null,
            ]);
        }

        if (! $this->filled('application_date')) {
            $this->merge([
                'application_date' => now()->toDateString(),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // A. DATA PEMINJAM
            'name' => ['required', 'string', 'max:150'],
            'occupation' => ['required', 'string', 'max:100'],
            'occupation_other' => ['nullable', 'string', 'max:150'],
            'current_address' => ['required', 'string', 'max:500'],
            'origin_address' => ['required', 'string', 'max:500'],
            'correspondence_address' => ['nullable', 'string', 'max:500'],
            'phone' => ['required', 'string', 'max:40'],
            'loan_amount' => ['required', 'integer', 'min:500000', 'max:1000000000'],
            'loan_purpose' => ['required', 'string', 'max:255'],
            'loan_term_months' => ['required', 'integer', 'min:1', 'max:120'],
            'collateral_type' => ['required', 'string', 'max:100'],
            'collateral_description' => ['nullable', 'string', 'max:500'],
            'payment_scheme' => ['required', 'string', 'max:50'],
            'mother_maiden_name' => ['required', 'string', 'max:150'],
            'application_date' => ['required', 'date'],

            // B. PENANGGUNG JAWAB
            'guarantor_name' => ['required', 'string', 'max:150'],
            'guarantor_occupation' => ['nullable', 'string', 'max:100'],
            'guarantor_current_address' => ['nullable', 'string', 'max:500'],
            'guarantor_origin_address' => ['nullable', 'string', 'max:500'],
            'guarantor_phone' => ['nullable', 'string', 'max:40'],
            'guarantor_relationship' => ['nullable', 'string', 'max:100'],

            // C. AHLI WARIS
            'heir_name' => ['required', 'string', 'max:150'],
            'heir_occupation' => ['nullable', 'string', 'max:100'],
            'heir_current_address' => ['nullable', 'string', 'max:500'],
            'heir_origin_address' => ['nullable', 'string', 'max:500'],
            'heir_phone' => ['nullable', 'string', 'max:40'],
            'heir_relationship' => ['nullable', 'string', 'max:100'],

            // D. DATA KELUARGA LAIN (DARURAT)
            'emergency_sibling_name' => ['nullable', 'string', 'max:150'],
            'emergency_sibling_address' => ['nullable', 'string', 'max:500'],
            'emergency_sibling_phone' => ['nullable', 'string', 'max:40'],
            'emergency_other_name' => ['nullable', 'string', 'max:150'],
            'emergency_other_address' => ['nullable', 'string', 'max:500'],
            'emergency_other_phone' => ['nullable', 'string', 'max:40'],

            // Catatan & Berkas
            'notes' => ['nullable', 'string', 'max:1000'],
            'ktp_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'kk_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'collateral_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'income_slip_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'location_sketch_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'has_agreed' => ['accepted'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap peminjam wajib diisi.',
            'occupation.required' => 'Pekerjaan atau bidang usaha wajib dipilih.',
            'current_address.required' => 'Alamat tinggal saat ini wajib diisi.',
            'origin_address.required' => 'Alamat asal (sesuai KTP) wajib diisi.',
            'phone.required' => 'Nomor telepon / WhatsApp peminjam wajib diisi.',
            'loan_amount.required' => 'Jumlah pinjaman wajib diisi.',
            'loan_amount.min' => 'Jumlah pinjaman minimal adalah Rp 500.000.',
            'loan_purpose.required' => 'Tujuan penggunaan pinjaman wajib diisi.',
            'loan_term_months.required' => 'Jangka waktu pinjaman wajib dipilih.',
            'collateral_type.required' => 'Agunan/jaminan pinjaman wajib dipilih.',
            'payment_scheme.required' => 'Skema pembayaran wajib dipilih.',
            'mother_maiden_name.required' => 'Nama ibu kandung wajib diisi.',
            'guarantor_name.required' => 'Nama penanggung jawab wajib diisi.',
            'heir_name.required' => 'Nama ahli waris wajib diisi.',
            'has_agreed.accepted' => 'Anda harus menyetujui pernyataan kebenaran informasi dan ketentuan permohonan pinjaman.',
            'ktp_file.max' => 'Ukuran berkas KTP maksimal 5 MB.',
            'kk_file.max' => 'Ukuran berkas KK maksimal 5 MB.',
            'collateral_file.max' => 'Ukuran berkas agunan maksimal 5 MB.',
            'income_slip_file.max' => 'Ukuran berkas bukti penghasilan maksimal 5 MB.',
            'location_sketch_file.max' => 'Ukuran berkas denah lokasi maksimal 5 MB.',
        ];
    }
}
