<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class SavingsController extends Controller
{
    public function show(string $service): View
    {
        $product = collect(config('cooperative.savings'))->firstWhere('id', $service);

        abort_if($product === null, 404);

        $message = "Halo KSP Dharma Siaga, saya ingin mengetahui lebih lanjut tentang {$product['title']}.\nKode referal layanan: {$product['referral_code']}";
        $whatsappUrl = 'https://wa.me/'.config('cooperative.office.whatsapp_number').'?text='.rawurlencode($message);

        return view('pages.savings-show', compact('product', 'whatsappUrl'));
    }
}
