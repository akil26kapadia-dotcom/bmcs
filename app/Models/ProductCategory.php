<?php

namespace App\Models;

class ProductCategory extends Model
{
    protected static string $table = 'product_categories';

    public static function allOrdered(): array
    {
        return static::db()
            ->query('SELECT * FROM product_categories ORDER BY sort_order ASC, name ASC')
            ->fetchAll();
    }
}
