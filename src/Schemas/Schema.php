<?php

namespace PixiiBomb\Core\Schemas;

class Schema
{
    protected static function schema(array $required, array $properties): object
    {
        return json_decode(json_encode([
            '$schema' => 'https://json-schema.org/draft/2020-12/schema',
            'type' => 'object',
            'required' => $required,
            'additionalProperties' => false,
            'properties' => $properties,
        ]));
    }

    protected static function withoutProperties(object $schema, array $properties): object
    {
        $schema = self::clone($schema);

        foreach ($properties as $property) {
            unset($schema->properties->{$property});
        }

        $schema->required = array_values(array_filter(
            $schema->required ?? [],
            fn(string $field) => !in_array($field, $properties, true)
        ));

        return $schema;
    }

    protected static function withoutRequired(object $schema): object
    {
        $schema = self::clone($schema);
        $schema->required = [];

        return $schema;
    }

    protected static function clone(object $schema): object
    {
        return json_decode(json_encode($schema));
    }
}
