<?php

namespace App\Modules\Invoices\Application\Mappers;

use App\Modules\Invoices\Domain\Model\Entities\ProductItem;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Model\ValueObjects\Name;
use App\Modules\Invoices\Domain\Model\ValueObjects\Price;
use App\Modules\Invoices\Infrastructure\EloquentModels\ProductItemEloquentModel;

class ProductItemMapper
{

    public static function fromEloquent(ProductItemEloquentModel $eloquentModel): ProductItem
    {
        return new ProductItem(
            id: new Id($eloquentModel->id),
            name: new Name($eloquentModel->name),
            price: new Price($eloquentModel->price, $eloquentModel->currency),
        );
    }

}
