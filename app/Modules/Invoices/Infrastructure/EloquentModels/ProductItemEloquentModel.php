<?php

namespace App\Modules\Invoices\Infrastructure\EloquentModels;

use App\Domain\Enums\CurrencyEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProductItemEloquentModel extends Model
{
    use HasUuids;


    protected $table = 'products';
    protected $fillable = [
        'id',
        'name',
        'price',
        'currency',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    protected $casts = [
        'currency' => CurrencyEnum::class
    ];

    public function uniqueIds(): array
    {
        return ['id'];
    }
}
