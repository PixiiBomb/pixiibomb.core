<?php

namespace PixiiBomb\Core\Data;

use PixiiBomb\Core\Traits\{HasAlias, HasAssets, HasComponent, HasView};

/**
 * Represents a renderable section of a PixiiBomb page.
 *
 * Blocks are used by the Page object to compose layouts from
 * individual Blade views and optional aliases.
 */
class Block
{
    use HasAlias;
    use HasView;
    use HasComponent;
    use HasAssets;
}
