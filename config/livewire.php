<?php

return [
    'class_namespace' => 'App\\Livewire',
    'view_path' => resource_path('views/livewire'),
    'layout' => 'app',
    'lazy_placeholder' => null,
    'temporary_file_upload' => [
        'disk' => 'local',
        'directory' => 'livewire-tmp',
        'rules' => null,
        'max_upload_size' => null,
    ],
    'temporary_file_upload_url' => null,
    'temporary_file_upload_using_signed_urls' => true,
    'render_on_redirect' => false,
    'auto_inject_alpine' => true,
    'auto_inject_assets' => true,
    'auto_inject_morph_markers' => true,
    'navigate' => [
        'enabled' => true,
    ],
];
