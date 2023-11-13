<?php

namespace App\Modules\Invoices\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CompanyEloquentModel extends Model
{
    use HasUuids;


    protected $table = 'companies';
    protected $fillable = [
        'id',
        'name',
        'street',
        'city',
        'zip',
        'phone',
        'email',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    protected $casts = [
    ];

    public function uniqueIds(): array
    {
        return ['id'];
    }
}
