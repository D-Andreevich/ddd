<?php

namespace App\Modules\Invoices\Domain\Factories;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Domain\Model\Invoice;
use App\Modules\Invoices\Domain\Model\ValueObjects\Date;
use App\Modules\Invoices\Domain\Model\ValueObjects\Id;
use App\Modules\Invoices\Domain\Model\ValueObjects\InvoiceNumber;
use App\Modules\Invoices\Domain\Model\ValueObjects\Products;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

class InvoiceFactory
{
    public static function new(array $attributes = null): Invoice
    {
        $attributes = $attributes ?: [];

        $faker = Factory::create();

        $defaults = [
            'id' => Uuid::uuid4()->toString(),
            'number' => $faker->uuid(),
            'status' => StatusEnum::DRAFT->value,
            'date' => $faker->date(),
            'dueDate' => $faker->date(),
        ];

        $attributes = array_replace($defaults, $attributes);

        return new Invoice(
            invoiceId: new Id($attributes['id']),
            invoiceNumber: new InvoiceNumber($attributes['number']),
            statusEnum: StatusEnum::tryFrom($attributes['status']),
            invoiceDate: Date::fromPrimitives($attributes['date']),
            dueDate: Date::fromPrimitives($attributes['dueDate']),
            company: CompanyFactory::new(),
            products: new Products([]),
        );
    }
}
