# EZELog
Logger for Laravel (Support eloquent and mongodb)

This logger modules being created for recoding the Audit logs.

## Installation
Install the package using composer
```
composer require ezelink/ezelog
```

or add the following line to the composer.json under the `require` section and update composer
```
"ezelink/ezelog": "^1.0"
composer update
```

## Configurations
1. Open the file add config/app.php
2. Add the following line under `providers`

```
EZELog\EZELogServiceProvider::class,
```

## Examples
```
EZELog\Facades\AuditLog::log('user login failed');
```
OR
```
EZELog\Facades\AuditLog::log('user login failed', $username);
```
