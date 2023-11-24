<?php

assert_options(ASSERT_ACTIVE, TRUE);
assert_options(ASSERT_EXCEPTION, TRUE);

/**
 * Enable local development services.
 */
if (file_exists($app_root . '/sites/development.services.yml') && getenv('DRUPAL_DISABLE_CACHE')) {
  $settings['container_yamls'][] = $app_root . '/sites/development.services.yml';
  if (file_exists($app_root . '/sites/development-theme.services.yml') && getenv('DRUPAL_ENABLE_DEBUG')) {
    $settings['container_yamls'][] = $app_root . '/sites/development-theme.services.yml';
  }

  /**
   * Disable the render cache (this includes the page cache).
   *
   * Note: you should test with the render cache enabled, to ensure the correct
   * cacheability metadata is present. However, in the early stages of
   * development, you may want to disable it.
   *
   * This setting disables the render cache by using the Null cache back-end
   * defined by the development.services.yml file above.
   *
   * Do not use this setting until after the site is installed.
   */
  $settings['cache']['bins']['render'] = 'cache.backend.null';

  /**
   * Disable Dynamic Page Cache.
   *
   * Note: you should test with Dynamic Page Cache enabled, to ensure the correct
   * cacheability metadata is present (and hence the expected behavior). However,
   * in the early stages of development, you may want to disable it.
   */
  $settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
  $settings['cache']['bins']['page'] = 'cache.backend.null';

  /**
   * Show all error messages, with backtrace information.
   *
   * In case the error level could not be fetched from the database, as for
   * example the database connection failed, we rely only on this value.
   */
  $config['system.logging']['error_level'] = 'verbose';

  /**
   * Disable CSS and JS aggregation.
   */
  $config['system.performance']['css']['preprocess'] = FALSE;
  $config['system.performance']['js']['preprocess'] = FALSE;
}


/**
 * Trusted host configuration.
 *
 * Drupal core can use the Symfony trusted host mechanism to prevent HTTP Host
 * header spoofing.
 *
 * To enable the trusted host mechanism, you enable your allowable hosts
 * in $settings['trusted_host_patterns']. This should be an array of regular
 * expression patterns, without delimiters, representing the hosts you would
 * like to allow.
 *
 * For example:
 * @code
 * $settings['trusted_host_patterns'] = [
 *   '^www\.example\.com$',
 * ];
 * @endcode
 * will allow the site to only run from www.example.com.
 *
 * If you are running multisite, or if you are running your site from
 * different domain names (eg, you don't redirect http://www.example.com to
 * http://example.com), you should specify all of the host patterns that are
 * allowed by your site.
 *
 * For example:
 * @code
 * $settings['trusted_host_patterns'] = [
 *   '^example\.com$',
 *   '^.+\.example\.com$',
 *   '^example\.org$',
 *   '^.+\.example\.org$',
 * ];
 * @endcode
 * will allow the site to run off of all variants of example.com and
 * example.org, with all subdomains included.
 */
/**
 * $settings['trusted_host_patterns'] = [
 *  '^example\.com$',
 *  '^.+\.example\.com$',
 * ];
 */

$settings['trusted_host_patterns'] = [
  '^\.localhost$',
  '^.+\.localhost$',
  getenv('TRUSTED_HOST_PATTERNS'),
  getenv('TRUSTED_HOST_PATTERNS_ALIAS'),
];

/**
 * Show all error messages, with backtrace information.
 *
 * In case the error level could not be fetched from the database, as for
 * example the database connection failed, we rely only on this value.
 */
//$config['system.logging']['error_level'] = 'verbose';

/**
 * Allow test modules and themes to be installed.
 *
 * Drupal ignores test modules and themes by default for performance reasons.
 * During development it can be useful to install test extensions for debugging
 * purposes.
 */
$settings['extension_discovery_scan_tests'] = TRUE;

/**
 * Enable access to rebuild.php.
 *
 * This setting can be enabled to allow Drupal's php and database cached
 * storage to be cleared via the rebuild.php page. Access to this page can also
 * be gained by generating a query string from rebuild_token_calculator.sh and
 * using these parameters in a request to rebuild.php.
 */
$settings['rebuild_access'] = FALSE;

/**
 * Skip file system permissions hardening.
 *
 * The system module will periodically check the permissions of your site's
 * site directory to ensure that it is not writable by the website user. For
 * sites that are managed with a version control system, this can cause problems
 * when files in that directory such as settings.php are updated, because the
 * user pulling in the changes won't have permissions to modify files in the
 * directory.
 */
$settings['skip_permissions_hardening'] = TRUE;
