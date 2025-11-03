<?php

use Heidkaemper\StatamicThemes\Tests\TestCase;
use Illuminate\Support\Facades\View;

pest()->extends(TestCase::class)->in('Feature');

pest()->extend(TestCase::class)->beforeEach(function () {
    // remove dynamic avatar background to enable consistent screenshots
    View::startPush('head', '<style>header.bg-global-header-bg button .shape-squircle { background: #666 !important; }</style>');
})->in('Browser');
