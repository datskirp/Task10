<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class Product extends Model
{
    use HasFactory;

    const PRODUCT_FILTERS = ['name', 'manufacturer', 'category'];
    const PRODUCT_SORT = ['name', 'manufacturer', 'cost', 'category'];
    protected QueryBuilder $query;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'manufacturer',
        'release',
        'cost',
        'category',
    ];

    public function getSelected()
    {
        return QueryBuilder::for($this)
            ->allowedFilters(self::PRODUCT_FILTERS)
            ->allowedSorts(self::PRODUCT_SORT);
    }
}
