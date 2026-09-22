<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContent;

class CmsController extends Controller
{
    public function edit()
    {
        $content = SiteContent::pluck('value', 'key')->all();
        return view('admin.edit', compact('content'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'hero_title_id' => ['required', 'string', 'max:120'],
            'hero_title_en' => ['required', 'string', 'max:120'],
            'whatsapp' => ['required', 'string', 'max:30'],
            'meta_description' => ['required', 'string', 'max:180'],
        ]);
        foreach ($data as $key => $value) SiteContent::updateOrCreate(['key' => $key], ['value' => $value]);
        return back()->with('status', 'Konten tersimpan ke SQLite.');
    }
}
