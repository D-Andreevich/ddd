<?php

namespace App\Modules\Invoices\Infrastructure\EloquentModels;

use App\Domain\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class InvoiceEloquentModel extends Model
{
    use HasUuids;


    protected $table = 'invoices';
    protected $fillable = [
        'id',
        'number',
        'date',
        'due_date',
        'company_id',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    protected $casts = [
        'status' => StatusEnum::class
    ];

    public function uniqueIds(): array
    {
        return ['id', 'number'];
    }

    public function company()
    {
        return $this->hasOne(CompanyEloquentModel::class, 'id', 'company_id');
    }

    public function products()
    {
        return $this->belongsToMany(ProductItemEloquentModel::class,
            'invoice_product_lines',
            'invoice_id',
            'product_id',
        )->withPivot('quantity');
    }
}
