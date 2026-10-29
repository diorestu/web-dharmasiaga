<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanApplicationController extends Controller
{
    /**
     * Display a listing of the loan applications.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status', 'all');
        $search = $request->query('q');

        $stats = [
            'total' => LoanApplication::count(),
            'pending' => LoanApplication::where('status', LoanApplication::STATUS_PENDING)->count(),
            'review' => LoanApplication::where('status', LoanApplication::STATUS_REVIEW)->count(),
            'approved' => LoanApplication::where('status', LoanApplication::STATUS_APPROVED)->count(),
            'rejected' => LoanApplication::where('status', LoanApplication::STATUS_REJECTED)->count(),
            'total_amount' => LoanApplication::sum('loan_amount'),
        ];

        $applications = LoanApplication::query()
            ->filter(['status' => $status, 'q' => $search])
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.loan-applications.index', compact('applications', 'stats', 'status', 'search'));
    }

    /**
     * Display the specified loan application.
     */
    public function show(LoanApplication $loanApplication): View
    {
        return view('admin.loan-applications.show', [
            'application' => $loanApplication,
        ]);
    }

    /**
     * Display the printable loan application matching the official form.
     */
    public function print(LoanApplication $loanApplication): View
    {
        return view('admin.loan-applications.print', [
            'application' => $loanApplication,
        ]);
    }

    /**
     * Update the status and admin notes for the loan application.
     */
    public function updateStatus(Request $request, LoanApplication $loanApplication): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,review,approved,rejected'],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $loanApplication->update($validated);

        return back()->with('status', "Status pengajuan #{$loanApplication->reference_number} berhasil diperbarui.");
    }
}
