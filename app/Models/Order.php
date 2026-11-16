<?php
namespace App\Models;

use App\Core\Database;
use App\Core\Model;

class Order extends Model
{
    protected static string $table = 'orders';

    /** Save an order and its items in one go. */
    public static function place(int $userId, array $cart, string $address): int
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $orderId = self::create([
            'user_id' => $userId,
            'total'   => $total,
            'address' => $address,
            'status'  => 'pending',
        ]);

        foreach ($cart as $item) {
            Database::query(
                'INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)',
                [$orderId, $item['id'], $item['qty'], $item['price']]
            );
        }
        return $orderId;
    }

    public static function forUser(int $userId): array
    {
        return Database::fetchAll('SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC', [$userId]);
    }
}
