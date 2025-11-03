<?php

it('checks rad theme in light mode', function () {
    $this->user->preferences([
        'base_theme' => 'rad',
    ]);

    $this->actingAs($this->user);

    visit('/cp/preferences/edit')
        ->on()->desktop()
        ->inLightMode()
        ->resize(1280, 620)
        ->assertScreenshotMatches();
});

it('checks rad theme in dark mode', function () {
    $this->user->preferences([
        'base_theme' => 'rad',
    ]);

    $this->actingAs($this->user);

    visit('/cp/preferences/edit')
        ->on()->desktop()
        ->inDarkMode()
        ->resize(1280, 620)
        ->assertScreenshotMatches();
});
