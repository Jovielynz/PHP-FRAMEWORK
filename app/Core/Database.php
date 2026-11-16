<?php
namespace App\Core;

use PDO;
use PDOException;

/**
 * Database - a single shared PDO connection (singleton).
 * Usage: Database::query('SELECT * FROM products WHERE id = ?', [$id]);
 */
class Database
{
    private static ?PDO $pdo = null;

    public static function connection(): PDO
    {
        if (self::$pdo === null) {
            $cfg = App::config('database');

            try {
                if ($cfg['driver'] === 'sqlite') {
                    $dsn = 'sqlite:' . $cfg['sqlite_path'];
                    self::$pdo = new PDO($dsn);
                } else {
                    $dsn = "mysql:host={$cfg['host']};dbname={$cfg['name']};charset=utf8mb4";
                    self::$pdo = new PDO($dsn, $cfg['user'], $cfg['password']);
                }
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    /** Run a prepared statement and return the statement. */
    public static function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = self::connection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function fetchAll(string $sql, array $params = []): array
    {
        return self::query($sql, $params)->fetchAll();
    }

    public static function fetchOne(string $sql, array $params = []): ?array
    {
        $row = self::query($sql, $params)->fetch();
        return $row === false ? null : $row;
    }

    public static function lastInsertId(): string
    {
        return self::connection()->lastInsertId();
    }
}
