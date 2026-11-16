<?php
namespace App\Core;

/**
 * Model - base class with common table helpers.
 * Child classes only need to set $table.
 */
abstract class Model
{
    protected static string $table = '';

    public static function all(): array
    {
        return Database::fetchAll('SELECT * FROM ' . static::$table . ' ORDER BY id');
    }

    public static function find(int $id): ?array
    {
        return Database::fetchOne('SELECT * FROM ' . static::$table . ' WHERE id = ?', [$id]);
    }

    public static function create(array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $marks   = implode(', ', array_fill(0, count($data), '?'));
        Database::query(
            'INSERT INTO ' . static::$table . " ($columns) VALUES ($marks)",
            array_values($data)
        );
        return (int) Database::lastInsertId();
    }
}
