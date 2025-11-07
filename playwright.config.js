import { defineConfig, devices } from '@playwright/test';

export default defineConfig({
  // Ensure consistent font rendering
  use: {
    // Force a specific font to avoid system font differences
    headless: true,
    viewport: { width: 1280, height: 620 },
    // Disable animations to reduce flakiness
    reducedMotion: 'reduce',
    // Force specific device scale factor
    deviceScaleFactor: 1,
    // Use consistent locale
    locale: 'en-US',
    // Disable GPU to avoid rendering differences
    launchOptions: {
      args: [
        '--disable-gpu',
        '--disable-dev-shm-usage',
        '--disable-setuid-sandbox',
        '--no-sandbox',
        '--disable-background-timer-throttling',
        '--disable-backgrounding-occluded-windows',
        '--disable-renderer-backgrounding',
        '--disable-features=TranslateUI',
        '--disable-extensions',
        '--disable-web-security',
        '--force-device-scale-factor=1',
        '--disable-font-subpixel-positioning',
      ],
    },
  },
  
  // Configure screenshot comparison
  expect: {
    // Allow small pixel differences
    threshold: 0.2, // 20% threshold
    // Use specific screenshot mode
    mode: 'skip-text-glyphs', // Skip text rendering differences
  },
  
  // Test directory
  testDir: './tests/Browser',
  
  // Configure projects for consistent testing
  projects: [
    {
      name: 'chromium',
      use: { 
        ...devices['Desktop Chrome'],
        viewport: { width: 1280, height: 620 },
      },
    },
  ],
});
