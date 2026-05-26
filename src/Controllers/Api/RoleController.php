<?php

namespace PixiiBomb\Core\Controllers\Api;

use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Validation\ValidationException;
use PixiiBomb\Core\Models\Role;
use PixiiBomb\Core\Schemas\RoleSchema;
use PixiiBomb\Core\Validation\SchemaValidation;

class RoleController extends ApiController
{
    protected function model(): string
    {
        return Role::class;
    }

    protected function schema(): string
    {
        return RoleSchema::class;
    }

    public function create(Request $request): JsonResponse
    {
        $data = SchemaValidation::validate($this->schema(), $request->all(), 'create');

        if (Role::query()->where('key', $data['key'])->exists()) {
            throw ValidationException::withMessages([
                'key' => ['The key has already been taken.'],
            ]);
        }

        $record = Role::query()->create($data);

        return response()->json([
            'data' => $record,
        ], 201);
    }

    /**
     * Delete a non-system role.
     */
    public function delete(int|string $id): JsonResponse
    {
        $record = Role::query()->findOrFail($id);

        if ($record->is_system) {
            return response()->json([
                'ok' => false,
                'message' => 'System roles cannot be deleted.',
            ], 403);
        }

        $record->delete();

        return response()->json([
            'ok' => true,
        ]);
    }

    /**
     * Delete all non-system roles.
     */
    public function deleteAll(): JsonResponse
    {
        $deleted = Role::query()
            ->where('is_system', false)
            ->delete();

        return response()->json([
            'ok' => true,
            'deleted' => $deleted,
        ]);
    }
}
