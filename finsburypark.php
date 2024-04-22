<?php

require_once 'finsburypark.civix.php';
use CRM_Finsburypark_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function finsburypark_civicrm_config(&$config) {
  _finsburypark_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_alterBundle(). Add Bootstrap.
 */

function finsburypark_civicrm_alterBundle(CRM_Core_Resources_Bundle $bundle) {
  $theme = Civi::service('themes')->getActiveThemeKey();
  if ($theme !== 'finsburypark') {
    return;
  }

  switch ($theme . ':' . $bundle->name) {
    case 'finsburypark:bootstrap3':
      $bundle->clear();
      $bundle->addStyleFile('finsburypark', 'css/bootstrap3.css');
      $bundle->addScriptFile('finsburypark', 'js/bootstrap.min.js', [
        'translate' => FALSE,
      ]);
      $bundle->addScriptFile('finsburypark', 'js/noConflict.js', [
        'translate' => FALSE,
      ]);
      break;
  }
  if ($bundle->name == 'coreStyles') {
    $bundle->filter(function($snippet) {
      if ($snippet['name'] == 'civicrm:css/civicrm.css') {
        $snippet['weight'] = 290;
        return $snippet;
      }
      elseif (($snippet['name'] == 'civicrm:css/custom.css') or (strpos($snippet['name'], 'custom.css') !== false)) {
        $snippet['weight'] = 300;
        return $snippet;
      }
      return TRUE;
    });
  }
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function finsburypark_civicrm_install() {
  _finsburypark_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function finsburypark_civicrm_enable() {
  _finsburypark_civix_civicrm_enable();
}
