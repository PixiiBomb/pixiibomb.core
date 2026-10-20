<?php

namespace PixiiBomb\Core\Data;

/**
 * Represents metadata associated with a rendered PixiiBomb page.
 *
 * Provides values commonly rendered within the document <head>:
 *  - Title
 *  - Description
 *  - Keywords
 *  - Author
 *
 * Default values may be resolved from the application's meta configuration.
 */
class Meta
{
    /**
     * Configuration key for the page title.
     */
    private const string TITLE = 'title';

    /**
     * Configuration key for the page description.
     */
    private const string DESCRIPTION = 'description';

    /**
     * Configuration key for the page keywords.
     */
    private const string KEYWORDS = 'keywords';

    /**
     * Configuration key for the page author.
     */
    private const string AUTHOR = 'author';

    /**
     * Create a new Meta object.
     *
     * @param string|null $title The document title.
     * @param string|null $description The meta description value.
     * @param string|null $keywords The meta keywords value.
     * @param string|null $author The meta author value.
     */
    public function __construct(protected ?string $title = null, protected ?string $description = null, protected ?string $keywords = null, protected ?string $author = null
    ) {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setKeywords($keywords);
        $this->setAuthor($author);
    }

    /**
     * Get the document title.
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Get the meta-description value.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Get the meta-keywords value.
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * Get the meta-author value.
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * Set the document title.
     *
     * Optionally appends the configured application name
     * depending on the application configuration.
     */
    public function setTitle(?string $title): Meta
    {
        $siteName = config('app.name');
        $pageTitle = $title ?? $this->getMeta(self::TITLE);
        $useSiteName = config('pixii.core.settings.include-site-name-in-title');

        if ($siteName == $pageTitle && $useSiteName) {
            $this->title = $siteName;
        } else {
            $this->title = $useSiteName
                ? "$pageTitle | $siteName"
                : $pageTitle;
        }

        return $this;
    }

    /**
     * Set the meta-description value.
     */
    public function setDescription(?string $description): Meta
    {
        $this->description = $description ?? $this->getMeta(self::DESCRIPTION);

        return $this;
    }

    /**
     * Set the meta-author value.
     */
    public function setAuthor(?string $author): Meta
    {
        $this->author = $author ?? $this->getMeta(self::AUTHOR);

        return $this;
    }

    /**
     * Set the meta-keywords value.
     */
    public function setKeywords(?string $keywords): Meta
    {
        $this->keywords = $keywords ?? $this->getMeta(self::KEYWORDS);

        return $this;
    }

    /**
     * Resolve a metadata fallback value from the configuration.
     */
    private function getMeta(string $key): string
    {
        return config("pixii.core.meta.$key") ?? '';
    }
}
