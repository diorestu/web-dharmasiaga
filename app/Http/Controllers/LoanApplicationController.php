<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanApplicationRequest;
use App\Models\LoanApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoanApplicationController extends Controller
{
    /**
     * Show the public loan application form.
     */
    public function create(): View
    {
        return view('pages.loan-application', [
            'today' => now()->toDateString(),
        ]);
    }

    /**
     * Store a newly created loan application in storage.
     */
    public function store(StoreLoanApplicationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $fileKeys = [
            'ktp_file',
            'kk_file',
            'collateral_file',
            'income_slip_file',
            'location_sketch_file',
        ];

        foreach ($fileKeys as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $path = $request->file($fileKey)->store('loan-documents', 'public');
                $validated[$fileKey] = $path;
            } else {
                $validated[$fileKey] = null;
            }
        }

        $validated['reference_number'] = LoanApplication::generateReferenceNumber();
        $validated['status'] = LoanApplication::STATUS_PENDING;
        $validated['has_agreed'] = true;

        $loanApplication = LoanApplication::create($validated);

        return redirect()
            ->route('loan-applications.success', $loanApplication->reference_number)
            ->with('status', 'Permohonan pinjaman Anda berhasil dikirim! Catat nomor referensi Anda di bawah ini.');
    }

    /**
     * Show the confirmation / success page.
     */
    public function success(string $reference): View
    {
        $application = LoanApplication::where('reference_number', $reference)->firstOrFail();

        return view('pages.loan-application-success', compact('application'));
    }
}
