<?php

namespace PixiiBomb\Core\Validation;

use Illuminate\Validation\ValidationException;
use Opis\JsonSchema\Errors\ErrorFormatter;
use Opis\JsonSchema\Validator;

class SchemaValidation
{
    /**
     * Validate request data against a schema action.
     *
     * @param class-string $schemaClass
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     *
     * @throws ValidationException
     */
    public static function validate(string $schemaClass, array $data, string $action): array
    {
        if (! method_exists($schemaClass, $action)) {
            throw new \InvalidArgumentException("Schema action [$action] does not exist on [$schemaClass].");
        }

        $schema = $schemaClass::$action();

        $validator = new Validator();
        $validator->setMaxErrors(50);
        $dataObject = json_decode(json_encode($data));

        $result = $validator->validate($dataObject, $schema);

        if ($result->isValid()) {
            return $data;
        }

        $formatter = new ErrorFormatter();
        $error = $result->error();

        throw ValidationException::withMessages([
            'schema' => $formatter->formatNested($error),
        ]);
    }
}
