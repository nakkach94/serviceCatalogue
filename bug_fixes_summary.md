# Bug Fixes Summary

## Overview
This document details 3 critical bugs found in the Service Catalogue plugin codebase and their respective fixes.

## Bug 1: Logic Error - Undefined Constant `PLUGIN_SERVICECATALOGUE_ROOT`

**File**: `setup.php`
**Lines**: 109-111
**Severity**: Critical

### Description
The code uses an undefined constant `PLUGIN_SERVICECATALOGUE_ROOT` in the uninstall function, which would cause a PHP fatal error when attempting to uninstall the plugin.

### Original Code
```php
$files_to_remove = [
    PLUGIN_SERVICECATALOGUE_ROOT . '/css/style.css',
    PLUGIN_SERVICECATALOGUE_ROOT . '/js/script.js',
    PLUGIN_SERVICECATALOGUE_ROOT . '/_tmp/*'
];
```

### Fixed Code
```php
$plugin_dir = dirname(__FILE__);
$files_to_remove = [
    $plugin_dir . '/css/style.css',
    $plugin_dir . '/js/script.js',
    $plugin_dir . '/_tmp/*'
];
```

### Impact
- **Before**: Fatal error during plugin uninstallation
- **After**: Plugin can be safely uninstalled with proper file cleanup

---

## Bug 2: Security Vulnerability - Cross-Site Scripting (XSS)

**File**: `front/submenu.php`
**Line**: 41
**Severity**: High

### Description
The code directly outputs variables without proper HTML escaping, creating a potential XSS vulnerability where malicious input could be reflected back to the user's browser.

### Original Code
```php
echo "<h2><i class='fas fa-$icon'></i> $title</h2>";
```

### Fixed Code
```php
echo "<h2><i class='fas fa-" . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . "'></i> " . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . "</h2>";
```

### Impact
- **Before**: Potential XSS vulnerability allowing injection of malicious scripts
- **After**: All user-controllable output is properly escaped, preventing XSS attacks

---

## Bug 3: Performance Issue - Deprecated Database Method

**File**: `setup.php`
**Line**: 87
**Severity**: Medium

### Description
The code uses the deprecated `insertOrDie()` method which is not supported in newer versions of GLPI and doesn't provide proper error handling.

### Original Code
```php
$DB->insertOrDie('glpi_plugin_servicecatalogue_configs', [
    'name' => $name,
    'value' => is_array($value) ? json_encode($value) : $value
], "Erreur d'insertion de configuration par défaut");
```

### Fixed Code
```php
if (!$DB->insert('glpi_plugin_servicecatalogue_configs', [
    'name' => $name,
    'value' => is_array($value) ? json_encode($value) : $value
])) {
    trigger_error("Erreur d'insertion de configuration par défaut pour '$name'", E_USER_WARNING);
}
```

### Impact
- **Before**: Compatibility issues with newer GLPI versions, poor error handling
- **After**: Modern database API usage with proper error handling and better performance

---

## Summary

All three bugs have been successfully fixed:

1. **Logic Error**: Replaced undefined constant with proper directory path
2. **Security Vulnerability**: Added HTML escaping to prevent XSS attacks
3. **Performance Issue**: Modernized database operations with proper error handling

These fixes improve the plugin's security, compatibility, and maintainability while ensuring it works correctly with current and future versions of GLPI.