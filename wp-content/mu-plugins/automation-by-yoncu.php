<?php
/*
  Plugin Name: WordPress automation by Yöncü Bilişim Çözümleri
  Description: Management of this WordPress site is provided by Yöncü Bilişim Çözümleri.
*/

// This plugin was added because Automatic Updates, Automatic Backups, and
// other features are managed externally by Yöncü Bilişim Çözümleri.

// To block this plugin, create an empty file in the same directory named:
//     block-automation-by-yoncu.php

// Turn off WordPress automatic updates since these are managed externally.
// If you remove this to re-enable WordPress's automatic updates then it's 
// advised to disable auto-updating in Yöncü Bilişim Çözümleri.
add_filter( 'automatic_updater_disabled', '__return_true' );

// Disable WordPress site health test for Automatic Updates since these are
// managed externally by Yöncü Bilişim Çözümleri.
function yoncu_filter_site_status_tests($tests) {
	unset($tests['async']['background_updates']);
	return $tests;
}
add_filter('site_status_tests', 'yoncu_filter_site_status_tests');
