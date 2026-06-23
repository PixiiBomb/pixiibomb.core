<?php

namespace PixiiBomb\Core\Controllers\Api;

use PixiiBomb\Core\Models\Role;
use PixiiBomb\Core\Validation\RoleValidation;

class RoleController extends ApiController
{
    protected function model(): string
    {
        return Role::class;
    }

    protected function validator(): string
    {
        return RoleValidation::class;
    }
}
