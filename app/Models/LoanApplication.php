<?php

namespace App\Models;

use Database\Factories\LoanApplicationFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    /** @use HasFactory<LoanApplicationFactory> */
    use HasFactory;

    public const STATUS_PENDING = 'pending';

    public const STATUS_REVIEW = 'review';

    public const STATUS_APPROVED = 'approved';

    public const STATUS_REJECTED = 'rejected';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'reference_number',
        'status',
        'admin_notes',
        'name',
        'occupation',
        'occupation_other',
        'current_address',
        'origin_address',
        'correspondence_address',
        'phone',
        'loan_amount',
        'loan_purpose',
        'loan_term_months',
        'collateral_type',
        'collateral_description',
        'payment_scheme',
        'mother_maiden_name',
        'application_date',
        'guarantor_name',
        'guarantor_occupation',
        'guarantor_current_address',
        'guarantor_origin_address',
        'guarantor_phone',
        'guarantor_relationship',
        'heir_name',
        'heir_occupation',
        'heir_current_address',
        'heir_origin_address',
        'heir_phone',
        'heir_relationship',
        'emergency_sibling_name',
        'emergency_sibling_address',
        'emergency_sibling_phone',
        'emergency_other_name',
        'emergency_other_address',
        'emergency_other_phone',
        'notes',
        'ktp_file',
        'kk_file',
        'collateral_file',
        'income_slip_file',
        'location_sketch_file',
        'has_agreed',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'application_date' => 'date',
            'loan_amount' => 'integer',
            'loan_term_months' => 'integer',
            'has_agreed' => 'boolean',
        ];
    }

    /**
     * Generate a sequential human-readable reference number: DS-PK-YYYYMM-XXXX
     */
    public static function generateReferenceNumber(): string
    {
        $prefix = 'DS-PK-'.date('Ym');
        $latest = static::query()
            ->where('reference_number', 'like', $prefix.'-%')
            ->orderByDesc('id')
            ->value('reference_number');

        $sequence = 1;
        if ($latest && preg_match('/-(\d+)$/', $latest, $matches)) {
            $sequence = ((int) $matches[1]) + 1;
        }

        return sprintf('%s-%04d', $prefix, $sequence);
    }

    /**
     * Human-readable label for status.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_REVIEW => 'Sedang Ditinjau',
            self::STATUS_APPROVED => 'Disetujui',
            self::STATUS_REJECTED => 'Ditolak',
            default => 'Menunggu Survey / Verifikasi',
        };
    }

    /**
     * Badge CSS class for status.
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_REVIEW => 'status-review',
            self::STATUS_APPROVED => 'status-approved',
            self::STATUS_REJECTED => 'status-rejected',
            default => 'status-pending',
        };
    }

    /**
     * Formatted loan amount in Rupiah.
     */
    public function getFormattedLoanAmountAttribute(): string
    {
        return 'Rp '.number_format((float) $this->loan_amount, 0, ',', '.');
    }

    /**
     * Direct WhatsApp chat link to applicant.
     */
    public function getApplicantWhatsappUrlAttribute(): string
    {
        $cleanPhone = preg_replace('/\D/', '', (string) $this->phone);
        if (str_starts_with($cleanPhone, '0')) {
            $cleanPhone = '62'.substr($cleanPhone, 1);
        }

        $message = "Halo Bapak/Ibu {$this->name}, kami dari KSP Dharma Siaga terkait pengajuan pinjaman Anda dengan nomor referensi {$this->reference_number}.";

        return 'https://wa.me/'.$cleanPhone.'?text='.rawurlencode($message);
    }

    /**
     * Scope a query to filter by search query or status.
     *
     * @param  Builder<LoanApplication>  $query
     * @param  array{status?: ?string, q?: ?string}  $filters
     * @return Builder<LoanApplication>
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        if (! empty($filters['status']) && $filters['status'] !== 'all') {
            $query->where('status', $filters['status']);
        }

        if (! empty($filters['q'])) {
            $search = '%'.$filters['q'].'%';
            $query->where(function (Builder $q) use ($search): void {
                $q->where('reference_number', 'like', $search)
                    ->orWhere('name', 'like', $search)
                    ->orWhere('phone', 'like', $search)
                    ->orWhere('occupation', 'like', $search);
            });
        }

        return $query;
    }
}
