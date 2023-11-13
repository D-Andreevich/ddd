<?php

namespace App\Modules\Invoices\Application\Mappers;

use App\Modules\Invoices\Domain\Model\Entities\Company;
use App\Modules\Invoices\Domain\Model\ValueObjects\City;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Model\ValueObjects\Name;
use App\Modules\Invoices\Domain\Model\ValueObjects\Phone;
use App\Modules\Invoices\Domain\Model\ValueObjects\StreetAddress;
use App\Modules\Invoices\Domain\Model\ValueObjects\ZipCode;
use App\Modules\Invoices\Infrastructure\EloquentModels\CompanyEloquentModel;

class CompanyMapper
{

    public static function fromEloquent(CompanyEloquentModel $eloquentModel): Company
    {
        return new Company(
            id: new Id($eloquentModel->id),
            name: new Name($eloquentModel->name),
            streetAddress: new StreetAddress($eloquentModel->street),
            city: new City($eloquentModel->city),
            zipCode: new ZipCode($eloquentModel->zip),
            phone: new Phone($eloquentModel->phone)
        );
    }

}
