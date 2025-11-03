<?php

it('checks statamic5 theme in light mode', function () {
    $this->user->preferences([
        'base_theme' => 'statamic5',
    ]);

    $this->actingAs($this->user);

    visit('/cp/preferences/edit')
        ->on()->desktop()
        ->inLightMode()
        ->resize(1280, 620)
        ->assertScreenshotMatches();
});

it('checks statamic5 theme in dark mode', function () {
    $this->user->preferences([
        'base_theme' => 'statamic5',
    ]);

    $this->actingAs($this->user);

    visit('/cp/preferences/edit')
        ->on()->desktop()
        ->inDarkMode()
        ->resize(1280, 620)
        ->assertScreenshotMatches();
});
