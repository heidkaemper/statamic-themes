<?php

namespace Heidkaemper\StatamicThemes\Tests;

use Heidkaemper\StatamicThemes\ServiceProvider;
use Statamic\Facades\Stache;
use Statamic\Facades\User;
use Statamic\Testing\AddonTestCase;

class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('statamic:install');
        $this->withVite();

        $this->setUpTestData();
    }

    protected function setUpTestData(): void
    {
        User::all()->each(fn ($user) => $user->delete());

        $this->user = User::make()
            ->email('john@example.com')
            ->makeSuper()
            ->save();

        Stache::clear();
    }
}
