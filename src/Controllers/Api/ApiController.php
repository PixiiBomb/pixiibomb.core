<?php

namespace PixiiBomb\Core\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use PixiiBomb\Core\Validation\SchemaValidation;

/**
 * Base controller for PixiiBomb REST-style API resources.
 *
 * Provides reusable CRUD operations for Eloquent models:
 *  - Get
 *  - GetAll
 *  - Create
 *  - Update
 *  - Patch
 *  - Delete
 *  - DeleteAll
 *
 * Child controllers define:
 *  - Model
 *  - FormRequest mappings
 */
abstract class ApiController extends Controller
{
    /**
     * Get the model class this controller manages.
     *
     * @return class-string<Model>
     */
    abstract protected function model(): string;

    /**
     * Get the schema class this controller manages.
     *
     * @return class-string
     */
    abstract protected function schema(): string;

    /**
     * Get one record by id.
     */
    public function get(int|string $id): JsonResponse
    {
        $model = $this->model();
        $record = $model::query()->findOrFail($id);

        Gate::authorize('get', $record);

        return response()->json([
            'data' => $record,
        ]);
    }

    /**
     * Get all records.
     */
    public function getAll(): JsonResponse
    {
        $model = $this->model();

        Gate::authorize('getAll', $model);

        return response()->json([
            'data' => $model::query()->get(),
        ]);
    }

    /**
     * Create a new record.
     */
    public function create(Request $request): JsonResponse
    {
        $model = $this->model();

        Gate::authorize('create', $model);

        $record = $model::query()->create(
            $this->validated($request, 'create')
        );

        return response()->json([
            'data' => $record,
        ], 201);
    }

    /**
     * Fully update an existing record.
     */
    public function update(Request $request, int|string $id): JsonResponse
    {
        $model = $this->model();
        $record = $model::query()->findOrFail($id);

        Gate::authorize('update', $record);

        $record->update($this->validated($request, 'update'));

        return response()->json([
            'data' => $record->fresh(),
        ]);
    }

    /**
     * Partially update an existing record.
     */
    public function patch(Request $request, int|string $id): JsonResponse
    {
        $model = $this->model();
        $record = $model::query()->findOrFail($id);

        Gate::authorize('update', $record);

        $record->update($this->validated($request, 'patch'));

        return response()->json([
            'data' => $record->fresh(),
        ]);
    }

    /**
     * Delete an existing record.
     */
    public function delete(int|string $id): JsonResponse
    {
        $model = $this->model();
        $record = $model::query()->findOrFail($id);

        Gate::authorize('delete', $record);

        $record->delete();

        return response()->json([
            'ok' => true,
        ]);
    }

    /**
     * Delete all records for the managed model.
     */
    public function deleteAll(): JsonResponse
    {
        $model = $this->model();

        Gate::authorize('deleteAll', $model);

        $deleted = $model::query()->delete();

        return response()->json([
            'ok' => true,
            'deleted' => $deleted,
        ]);
    }

    /**
     * Validate the request using the FormRequest mapped to the given action.
     */
    protected function validated(Request $request, string $action): array
    {
        return SchemaValidation::validate(
            $this->schema(),
            $request->all(),
            $action
        );
    }
}
