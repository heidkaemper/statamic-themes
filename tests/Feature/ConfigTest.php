<?php

it('sets config then user has selected a theme', function () {
    $theme_values = config('statamic.themes.additional_themes.statamic5.theme');

    $this->user->preferences([
        'base_theme' => 'statamic5',
    ]);

    $this->actingAs($this->user)->get('/cp/dashboard');

    $this->assertEquals(config('statamic.cp.theme'), $theme_values);
});

it('does not change config when user has not selected a theme', function () {
    $this->actingAs($this->user)->get('/cp/dashboard');

    $this->assertEmpty(config('statamic.cp.theme'));
});

it('does not change config when the selected theme could not be found', function () {
    $this->user->preferences([
        'base_theme' => 'non_existing_theme',
    ]);

    $this->actingAs($this->user)->get('/cp/dashboard');

    $this->assertEmpty(config('statamic.cp.theme'));
});
