<?php

namespace App\Models;

class User extends Model
{
    protected static string $table = 'users';

    public static function findByEmail(string $email): ?array
    {
        $stmt = static::db()->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function recordFailedAttempt(int $id, int $attempts, ?string $lockedUntil): void
    {
        $stmt = static::db()->prepare(
            'UPDATE users SET failed_attempts = :attempts, locked_until = :locked_until WHERE id = :id'
        );
        $stmt->execute(['attempts' => $attempts, 'locked_until' => $lockedUntil, 'id' => $id]);
    }

    public static function recordSuccessfulLogin(int $id): void
    {
        $stmt = static::db()->prepare(
            'UPDATE users SET failed_attempts = 0, locked_until = NULL, last_login_at = NOW() WHERE id = :id'
        );
        $stmt->execute(['id' => $id]);
    }
}
