# EZELog
Logger for Laravel (Support eloquent and mongodb)

This logger modules being created for recoding the Audit logs.

## Installation


## Configurations


## Examples
```
EZELog\Facades\AuditLog::log('user login failed');
```
OR
```
EZELog\Facades\AuditLog::log('user login failed', $username);
```
