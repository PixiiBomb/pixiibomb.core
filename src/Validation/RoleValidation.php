<?php

namespace PixiiBomb\Core\Validation;

use Illuminate\Validation\Rule;
use PixiiBomb\Core\Enums\Action;
use PixiiBomb\Core\Models\Role;

class RoleValidation extends ResourceValidation
{
    protected static function fields(): array
    {
        return [
            'key' => ['string', 'max:30', Rule::unique(Role::class, 'key')],
            'display_name' => ['string', 'max:255'],
            'description' => ['string'],
            'priority' => ['integer'],
        ];
    }

    protected static function requiredFor(Action $action): array
    {
        return match ($action) {
            Action::CREATE => [
                'key',
                'display_name',
            ],

            Action::UPDATE => [
                'display_name',
            ],

            default => [],
        };
    }
}
