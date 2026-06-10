<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\WhatWeDo;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    private function defaultWhatWeDoData(): array
    {
        $emptyDescription = ['html' => '', 'delta' => ['ops' => []], 'text' => ''];

        return [
            'title_1' => '',
            'image_1' => '',
            'description_1' => $emptyDescription,

            'title_2' => '',
            'image_2' => '',
            'description_2' => $emptyDescription,

            'title_3' => '',
            'image_3' => '',
            'description_3' => $emptyDescription,
        ];
    }

    public function edit()
    {
        $content = Content::firstOrCreate(
            ['id' => 1],
            [
                'hero_section' => null,
                'about_solvein' => null,
            ]
        );

        $whatWeDo = WhatWeDo::query()->first();

        if (!$whatWeDo) {
            $whatWeDo = WhatWeDo::create($this->defaultWhatWeDoData());
        }

        return view('admin.content.edit', compact('content', 'whatWeDo'));
    }

    public function update(Request $request)
    {
        $emptyDescription = ['html' => '', 'delta' => ['ops' => []], 'text' => ''];

        $validated = $request->validate([
            'hero_section'  => ['nullable', 'json'],
            'about_solvein' => ['nullable', 'json'],

            'title_1' => ['nullable', 'string', 'max:255'],
            'title_2' => ['nullable', 'string', 'max:255'],
            'title_3' => ['nullable', 'string', 'max:255'],

            'description_1' => ['nullable', 'json'],
            'description_2' => ['nullable', 'json'],
            'description_3' => ['nullable', 'json'],

            'image_1' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_2' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_3' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $content = Content::firstOrCreate(
            ['id' => 1],
            [
                'hero_section' => null,
                'about_solvein' => null,
            ]
        );

        $content->hero_section = !empty($validated['hero_section'])
            ? json_decode($validated['hero_section'], true)
            : null;

        $content->about_solvein = !empty($validated['about_solvein'])
            ? json_decode($validated['about_solvein'], true)
            : null;

        $content->save();

        $whatWeDo = WhatWeDo::query()->first();

        if (!$whatWeDo) {
            $whatWeDo = WhatWeDo::create($this->defaultWhatWeDoData());
        }

        $whatWeDo->title_1 = $validated['title_1'] ?? '';
        $whatWeDo->title_2 = $validated['title_2'] ?? '';
        $whatWeDo->title_3 = $validated['title_3'] ?? '';

        $whatWeDo->description_1 = !empty($validated['description_1'])
            ? json_decode($validated['description_1'], true)
            : $emptyDescription;

        $whatWeDo->description_2 = !empty($validated['description_2'])
            ? json_decode($validated['description_2'], true)
            : $emptyDescription;

        $whatWeDo->description_3 = !empty($validated['description_3'])
            ? json_decode($validated['description_3'], true)
            : $emptyDescription;

        foreach ([1, 2, 3] as $number) {
            $imageField = 'image_' . $number;

            if ($request->hasFile($imageField)) {
                if ($whatWeDo->{$imageField}) {
                    Storage::disk('public')->delete($whatWeDo->{$imageField});
                }

                $whatWeDo->{$imageField} = $request->file($imageField)
                    ->store('what-we-do', 'public');
            }
        }

        $whatWeDo->save();

        return redirect()
            ->route('admin.content.edit')
            ->with('success', 'Content berhasil diperbarui.');
    }
}