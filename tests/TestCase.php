<?php

namespace Heidkaemper\StatamicThemes\Tests;

use Heidkaemper\StatamicThemes\ServiceProvider;
use Statamic\Auth\File\Role;
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

        $this->setUpTestData();
    }

    protected function setUpTestData(): void
    {
        $role = (new Role)
            ->handle('test')
            ->addPermission('access cp')
            ->save();

        $this->user = User::make()
            ->email('john@example.com')
            ->assignRole($role)
            ->save();

        Stache::clear();
    }
}
