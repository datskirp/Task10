<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\ProductStoreRequest;
use PHPUnit\Framework\TestCase;

class ProductStoreRequestTest extends TestCase
{
    public function test_contains_valid_rules()
    {
        $r = new ProductStoreRequest();

        $this->assertEquals([
            'name' => ['string', 'required', 'max:255'],
            'manufacturer' => ['string', 'required', 'max:255'],
            'release' => ['date', 'required'],
            'cost' => ['numeric', 'required', 'min:0'],
            'category' => ['string', 'required', 'max:255'],
        ], $r->rules());
    }
}
