<?php

namespace PixiiBomb\Core\Support;

use InvalidArgumentException;
use PixiiBomb\Core\Enums\AssetType;

class PixiiAssetManager
{
    /**
     * Application-root-relative resource directories registered under each
     * asset namespace.
     *
     * @var array<string, list<string>>
     */
    protected array $namespaces = [];

    /**
     * Registers a package resource directory under an asset namespace.
     *
     * Multiple package resource directories may be registered under the same
     * namespace. This allows related packages to expose assets through one
     * shared namespace.
     *
     * @param string $namespace The asset namespace.
     * @param string $directory The application-root-relative resources path.
     *
     * @return self Returns the asset manager for method chaining.
     */
    public function registerNamespace(string $namespace, string $directory): self
    {
        $namespace = trim($namespace);
        $directory = $this->normalizePath($directory);

        if ($namespace === '') {
            throw new InvalidArgumentException(
                'The asset namespace cannot be empty.',
            );
        }

        if ($directory === '') {
            throw new InvalidArgumentException(
                "The resource directory for asset namespace [{$namespace}] cannot be empty.",
            );
        }

        $this->namespaces[$namespace] ??= [];

        if (! in_array($directory, $this->namespaces[$namespace], true)) {
            $this->namespaces[$namespace][] = $directory;
        }

        return $this;
    }

    /**
     * Resolves logical stylesheet names into Vite entry points.
     *
     * The `resources/css` directory and `.css` extension are supplied
     * automatically. Minified stylesheets must be requested explicitly by
     * including `.min` in the logical asset name.
     *
     * Unresolved stylesheets are omitted, and duplicate entry points are
     * removed.
     *
     * Examples:
     *
     * - blocks/application-welcome
     * - blocks/application-welcome.min
     * - pixii::blocks/ui-welcome
     *
     * @param list<string> $stylesheets The logical stylesheet names.
     *
     * @return list<string> The resolved Vite stylesheet entry points.
     */
    public function resolveStylesheets(array $stylesheets): array
    {
        return $this->resolveAssets(
            $stylesheets,
            AssetType::Stylesheet,
        );
    }

    /**
     * Resolves logical script names into Vite entry points.
     *
     * The `resources/js` directory and `.js` extension are supplied
     * automatically. Minified scripts must be requested explicitly by
     * including `.min` in the logical asset name.
     *
     * Unresolved scripts are omitted, and duplicate entry points are removed.
     *
     * Examples:
     *
     * - blocks/application-welcome
     * - blocks/application-welcome.min
     * - pixii::blocks/ui-welcome
     *
     * @param list<string> $scripts The logical script names.
     *
     * @return list<string> The resolved Vite script entry points.
     */
    public function resolveScripts(array $scripts): array
    {
        return $this->resolveAssets(
            $scripts,
            AssetType::Script,
        );
    }

    /**
     * Resolves a logical stylesheet directory.
     *
     * The directory is resolved beneath the applicable `resources/css`
     * directory. This method is intended for server-side directory operations,
     * such as discovering available theme palettes.
     *
     * @param string $directory The logical stylesheet directory.
     *
     * @return string|null The application-root-relative directory, or null
     *                     when the directory does not exist.
     */
    public function resolveStylesheetDirectory(string $directory): ?string
    {
        return $this->resolveDirectory(
            $directory,
            AssetType::Stylesheet,
        );
    }

    /**
     * Resolves logical asset names into Vite entry points.
     *
     * @param list<string> $assets The logical asset names.
     * @param AssetType $type The asset type.
     *
     * @return list<string> The resolved Vite entry points.
     */
    protected function resolveAssets(array $assets, AssetType $type): array
    {
        $resolvedAssets = [];

        foreach ($assets as $asset) {
            $resolvedAsset = $this->resolveAsset($asset, $type);

            if (
                $resolvedAsset !== null
                && ! in_array($resolvedAsset, $resolvedAssets, true)
            ) {
                $resolvedAssets[] = $resolvedAsset;
            }
        }

        return $resolvedAssets;
    }

    /**
     * Resolves a logical asset name into a Vite entry point.
     *
     * Unqualified assets resolve beneath the Laravel application's resources
     * directory. Qualified assets resolve beneath all package resource
     * directories registered under the supplied namespace.
     *
     * @param string $asset The logical asset name.
     * @param AssetType $type The asset type.
     *
     * @return string|null The resolved Vite entry point, or null when the asset
     *                     does not exist.
     */
    protected function resolveAsset(string $asset, AssetType $type): ?string
    {
        $asset = $this->normalizePath($asset);

        if ($asset === '') {
            return null;
        }

        [$namespace, $path] = $this->parseAssetName($asset);

        $path = $this->addExtension(
            $path,
            $type->getExtension(),
        );

        $resourceDirectories = $namespace === null
            ? ['resources']
            : $this->getNamespaceDirectories($namespace);

        $matches = [];

        foreach ($resourceDirectories as $resourceDirectory) {
            $resolvedPath = implode('/', [
                $resourceDirectory,
                $type->getDirectory(),
                $path,
            ]);

            if (is_file(base_path($resolvedPath))) {
                $matches[] = $resolvedPath;
            }
        }

        if (count($matches) === 1) {
            return $matches[0];
        }

        if (count($matches) > 1) {
            throw new InvalidArgumentException(
                "Asset [{$asset}] is ambiguous because it exists in multiple " .
                'registered package resource directories: ' .
                implode(', ', $matches),
            );
        }

        logger()->warning(
            "Unable to locate {$type->value} asset [{$asset}].",
        );

        return null;
    }

    /**
     * Resolves a logical directory beneath the applicable asset-type
     * directory.
     *
     * @param string $directory The logical directory name.
     * @param AssetType $type The associated asset type.
     *
     * @return string|null The application-root-relative directory, or null
     *                     when the directory does not exist.
     */
    protected function resolveDirectory(string $directory, AssetType $type): ?string
    {
        $directory = $this->normalizePath($directory);

        if ($directory === '') {
            return null;
        }

        [$namespace, $path] = $this->parseAssetName($directory);

        $resourceDirectories = $namespace === null
            ? ['resources']
            : $this->getNamespaceDirectories($namespace);

        $matches = [];

        foreach ($resourceDirectories as $resourceDirectory) {
            $resolvedPath = implode('/', [
                $resourceDirectory,
                $type->getDirectory(),
                $path,
            ]);

            if (is_dir(base_path($resolvedPath))) {
                $matches[] = $resolvedPath;
            }
        }

        if (count($matches) === 1) {
            return $matches[0];
        }

        if (count($matches) > 1) {
            throw new InvalidArgumentException(
                "Asset directory [{$directory}] is ambiguous because it exists " .
                'in multiple registered package resource directories: ' .
                implode(', ', $matches),
            );
        }

        logger()->warning(
            "Unable to locate {$type->value} asset directory [{$directory}].",
        );

        return null;
    }

    /**
     * Splits a logical asset name into its namespace and relative path.
     *
     * @param string $asset The normalized logical asset name.
     *
     * @return array{0: string|null, 1: string}
     */
    protected function parseAssetName(string $asset): array
    {
        if (! str_contains($asset, '::')) {
            return [null, $asset];
        }

        [$namespace, $path] = explode('::', $asset, 2);

        $namespace = trim($namespace);
        $path = $this->normalizePath($path);

        if ($namespace === '' || $path === '') {
            throw new InvalidArgumentException(
                "Invalid asset name [{$asset}].",
            );
        }

        return [$namespace, $path];
    }

    /**
     * Gets the resource directories registered under an asset namespace.
     *
     * @param string $namespace The registered asset namespace.
     *
     * @return list<string> The application-root-relative resource directories.
     */
    protected function getNamespaceDirectories(string $namespace): array
    {
        return $this->namespaces[$namespace]
            ?? throw new InvalidArgumentException(
                "Asset namespace [{$namespace}] has not been registered.",
            );
    }

    /**
     * Appends the expected extension when it is not already present.
     *
     * Minified assets must be requested explicitly by including `.min` in the
     * logical asset name.
     *
     * @param string $path The asset path.
     * @param string $extension The expected extension.
     *
     * @return string The asset path with its extension.
     */
    protected function addExtension(string $path, string $extension): string
    {
        if (str_ends_with($path, ".{$extension}")) {
            return $path;
        }

        return "{$path}.{$extension}";
    }

    /**
     * Normalizes a logical or application-relative path.
     *
     * @param string $path The path to normalize.
     *
     * @return string The normalized path.
     */
    protected function normalizePath(string $path): string
    {
        return trim(
            str_replace('\\', '/', trim($path)),
            '/',
        );
    }
}
