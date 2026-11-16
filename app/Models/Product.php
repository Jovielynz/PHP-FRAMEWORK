<?php
namespace App\Models;

use App\Core\Database;
use App\Core\Model;

class Product extends Model
{
    protected static string $table = 'products';

    public static function byCategory(string $category): array
    {
        return Database::fetchAll('SELECT * FROM products WHERE category = ? ORDER BY id', [$category]);
    }

    public static function categories(): array
    {
        return array_column(Database::fetchAll('SELECT DISTINCT category FROM products ORDER BY category'), 'category');
    }

    public static function featured(int $limit = 4): array
    {
        return Database::fetchAll('SELECT * FROM products ORDER BY id LIMIT ' . (int) $limit);
    }
}
