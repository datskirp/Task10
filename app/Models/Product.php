<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class Product extends Model
{
    use HasFactory;

    public const PRODUCT_FILTERS = ['name', 'manufacturer', 'category'];
    public const PRODUCT_SORT = ['name', 'manufacturer', 'cost', 'category'];
    protected QueryBuilder $query;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'manufacturer',
        'release',
        'cost',
        'category',
    ];

    public function checkForFilters()
    {
        return QueryBuilder::for($this)
            ->allowedFilters(self::PRODUCT_FILTERS)
            ->allowedSorts(self::PRODUCT_SORT)
            ->paginate()
            ->withQueryString();
    }
}
