<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
      public function edit()
    {
        $content = Content::firstOrCreate(
            ['id' => 1],
            [
                'hero_section' => null,
                'about_solvein' => null,
            ]
        );

        return view('admin.content.edit', compact('content'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'hero_section'  => ['nullable', 'string'],
            'about_solvein' => ['nullable', 'string'],
        ]);

        $content = Content::firstOrCreate(
            ['id' => 1],
            ['hero_section' => null, 'about_solvein' => null]
        );

        $content->hero_section = !empty($validated['hero_section'])
            ? json_decode($validated['hero_section'], true)
            : null;

        $content->about_solvein = !empty($validated['about_solvein'])
            ? json_decode($validated['about_solvein'], true)
            : null;

        $content->save();

        return redirect()
            ->route('admin.content.edit')
            ->with('success', 'Content berhasil diperbarui.');
    }
}
