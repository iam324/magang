# Fix: Session Start Warning

## Masalah
```
Notice: session_start(): Ignoring session_start() because a session is already active 
in C:\xampp\htdocs\magang\auth_check.php on line 3
```

## Penyebab
Session dimulai 2 kali:
1. Di file utama (contoh: `edit_news.php`) dengan `session_start();`
2. Di `auth_check.php` yang di-include setelahnya, juga memanggil `session_start();`

## Solusi

### 1. Gunakan `session_status()` Check

**auth_check.php - SEBELUM:**
```php
<?php
session_start();

if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>
```

**auth_check.php - SESUDAH:**
```php
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>
```

### 2. Remove Redundant `session_start()`

**File yang menggunakan auth_check.php - SEBELUM:**
```php
<?php
session_start();  // ← Redundant!
require_once 'auth_check.php';
```

**File yang menggunakan auth_check.php - SESUDAH:**
```php
<?php
require_once 'auth_check.php';  // Session handled here
```

### 3. Untuk File Tanpa auth_check

**File yang tidak menggunakan auth_check.php:**
```php
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
```

## Penjelasan `session_status()`

```php
session_status()
```

Returns:
- `PHP_SESSION_DISABLED` - Sessions are disabled
- `PHP_SESSION_NONE` - Sessions are enabled but no session started yet
- `PHP_SESSION_ACTIVE` - Sessions are enabled and one has been started

## File yang Diperbaiki

1. ✅ **auth_check.php** - Added `session_status()` check
2. ✅ **edit_news.php** - Removed redundant `session_start()`
3. ✅ **update_news.php** - Removed redundant `session_start()`
4. ✅ **delete_news.php** - Added `session_status()` check

## Best Practices

### DO ✓
- Use `session_status()` check before `session_start()`
- Let `auth_check.php` handle session for admin pages
- Centralize session handling

### DON'T ✗
- Don't call `session_start()` multiple times
- Don't call `session_start()` in files that include `auth_check.php`
- Don't ignore session warnings

## Pattern untuk File Baru

### Admin Pages (Require Login)
```php
<?php
require_once 'auth_check.php';  // Handles session + auth
require_once 'db.php';
// Your code here
?>
```

### Public Pages (No Auth Required)
```php
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Your code here
?>
```

### Form Handlers
```php
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Process form
// Set session messages
// Redirect
?>
```

## Testing
- ✅ No more session warnings
- ✅ Authentication still works
- ✅ Session data accessible
- ✅ Redirect functions properly
- ✅ Flash messages work

## References
- PHP Manual: [session_status()](https://www.php.net/manual/en/function.session-status.php)
- PHP Manual: [session_start()](https://www.php.net/manual/en/function.session-start.php)
