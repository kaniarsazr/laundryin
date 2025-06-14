<?php
require_once __DIR__ . '/init.php';

$date = date('Y-m-d_H-i-s');
$backupFile = __DIR__ . "/storage/backups/laundryin_$date.sql";
$command = "\"C:\\xampp\\mysql\\bin\\mysqldump.exe\" -u " . DB_USER . " " . DB_NAME . " > \"$backupFile\"";
exec($command);

if (file_exists($backupFile)) {
    echo "Backup successfully saved to: $backupFile\n";
} else {
    echo "Backup failed.\n";
}