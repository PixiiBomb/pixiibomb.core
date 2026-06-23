<?php

namespace PixiiBomb\Core\Validation;

use PixiiBomb\Core\Enums\Action;

abstract class ResourceValidation
{
    abstract protected static function fields(): array;

    protected static function requiredFor(Action $action): array
    {
        return [];
    }

    public static function rules(Action $action, ?array $only = null): array
    {
        $fields = static::fields();

        if ($only !== null) {
            $fields = array_intersect_key($fields, array_flip($only));
        }

        $rules = [];

        foreach ($fields as $field => $fieldRules) {
            $fieldRules = is_array($fieldRules)
                ? $fieldRules
                : [$fieldRules];

            if (in_array($field, static::requiredFor($action), true)) {
                array_unshift($fieldRules, 'required');
            } else {
                array_unshift(
                    $fieldRules,
                    $action === Action::PATCH
                        ? 'sometimes'
                        : 'nullable'
                );
            }

            $rules[$field] = $fieldRules;
        }

        return $rules;
    }
}
