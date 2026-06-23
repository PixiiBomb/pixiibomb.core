<?php

namespace PixiiBomb\Core\Enums;

enum Action: string
{
    case GET = 'get';
    case GET_ALL = 'getAll';
    case CREATE = 'create';
    case UPDATE = 'update';
    case PATCH = 'patch';
    case DELETE = 'delete';
}
