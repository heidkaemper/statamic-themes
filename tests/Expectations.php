<?php

use Pest\Browser\Playwright\Client;
use Pest\TestSuite;
use PHPUnit\Framework\ExpectationFailedException;

expect()->extend('toMatchScreenshotLax', function () {
    $page = $this->value->page();

    $page->addStyleTag('* {
        transition: none !important;
        animation: none !important;
        body {
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }
    }');

    $page->waitForLoadState('networkidle');
    $page->waitForFunction('document.readyState === "complete"');

    usleep(100000); // 0.1 seconds

    $pageReflection = new ReflectionClass($page);
    $guid = $pageReflection->getProperty('guid')->getValue($page);
    $actualImageBlob = $pageReflection->getMethod('screenshotBinary')->invoke($page, true);

    assert(is_string($actualImageBlob), 'Unable to screenshot');

    try {
        expect($actualImageBlob)->toMatchSnapshot();
    } catch (ExpectationFailedException) {
        [$snapshotName, $expectedImageBlob] = TestSuite::getInstance()->snapshots->get();

        $response = Client::instance()->execute(
            $guid,
            'expectScreenshot',
            [
                'type' => 'png',
                'fullPage' => true,
                'caret' => 'hide',
                'animations' => 'disabled',
                'scale' => 'css',
                'expected' => $expectedImageBlob,
                'timeout' => 30000,
                'isNot' => false,
                'comparisonMethod' => 'pixelmatch',
                'threshold' => 0.3,
                'maxDiffPixels' => 300,
                'maxDiffPixelRatio' => 0.01,
                'detectAntialiasing' => true,
                'forceSameDimensions' => true,
            ]
        );

        $snapshotName = pathinfo($snapshotName, PATHINFO_FILENAME);

        foreach ($response as $message) {
            if (isset($message['result']['diff'])) {
                $pageReflection->getMethod('createImageDiffView')->invoke(
                    $page,
                    $snapshotName,
                    $expectedImageBlob,
                    $actualImageBlob,
                    $message['result']['diff'],
                    false
                );

                throw new ExpectationFailedException(<<<'EOT'
                    Screenshot does not match the last one.
                    - Expected? Update the snapshots with [--update-snapshots].
                    EOT,
                );
            }
        }
    }

    return $this;
});
