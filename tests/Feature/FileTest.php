<?php

it('injects css file', function () {
    $path = __DIR__ . '/../__fixtures__/test.css';

    file_put_contents($path, 'body { background: pink; }');

    $this->app['config']->set('statamic.themes.themes', [
        'test_theme' => [
            'file' => $path,
        ],
    ]);

    $this->user->preferences([
        'base_theme' => 'test_theme',
    ]);

    $this
        ->actingAs($this->user)
        ->get('/cp/dashboard')
        ->assertOk()
        ->assertSee('<style>body { background: pink; }</style>', false);
});

it('fails gracefully when file is invalid', function () {
    $this->app['config']->set('statamic.themes.themes', [
        'test_theme' => [
            'file' => 'non_existing_file.css',
        ],
    ]);

    $this->user->preferences([
        'base_theme' => 'test_theme',
    ]);

    $this
        ->actingAs($this->user)
        ->get('/cp/dashboard')
        ->assertOk();
});
