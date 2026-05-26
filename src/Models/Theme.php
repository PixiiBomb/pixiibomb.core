<?php

namespace PixiiBomb\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents an available PixiiBomb frontend theme.
 *
 * A theme controls component-level styling, while its palettes
 * control the color skin used by that theme.
 */
class Theme extends Model
{
    /**
     * The attributes that are mass-assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'display_name',
        'folder_name',
        'description',
        'thumbnail_path',
        'default_palette',
        'palettes',
        'is_active',
        'is_default',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'palettes' => 'array',
        'stylesheets' => 'array',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];
}
