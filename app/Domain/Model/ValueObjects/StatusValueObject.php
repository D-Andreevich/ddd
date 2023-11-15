<?php

namespace App\Domain\Model\ValueObjects;

use App\Domain\Exceptions\ModificationProhibitedException;
use App\Domain\Exceptions\WrongStatusChangeDirectionException;

abstract class StatusValueObject implements ValueObjectInterface
{
    protected \BackedEnum $name;

    /**
     *
     * @var class-string<StatusValueObject>[]
     */
    protected array $next = [];

    public function ensureCanBeChangedTo(self $nextStatus): void
    {
        if (!$this->canBeChangedTo($nextStatus)) {
            throw new WrongStatusChangeDirectionException($this->getName(), $nextStatus->getName());
        }
    }

    public function canBeChangedTo(self $status): bool
    {
        return in_array(get_class($status), $this->next, true);
    }

    public function getName(): \BackedEnum
    {
        return $this->name;
    }

    public function ensureAllowsModification(): void
    {
        if (!$this->allowModification()) {
            throw new ModificationProhibitedException();
        }
    }

    public function allowModification(): bool
    {
        return true;
    }

    public function jsonSerialize()
    {
        return $this->getName();
    }

}
