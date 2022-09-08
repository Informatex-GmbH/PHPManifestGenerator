<?php

declare(strict_types = 1);

namespace ifmx\PHPManifestGenerator;

class ManifestFields implements \IteratorAggregate {

    private string $backgroundColor           = '';
    private string $description               = '';
    private string $dir                       = '';
    private array  $dirValues                 = [
        'ltr',
        'rtl',
        'auto',
    ];
    private string $display                   = '';
    private array  $displayValues             = [
        'standalone',
        'fullscreen',
        'minimal-ui',
        'browser'
    ];
    private string $id                        = '';
    private array  $icons                     = [];
    private string $lang                      = '';
    private string $name                      = '';
    private string $orientation               = 'portrait';
    private array  $orientationValues         = [
        'any',
        'natural',
        'landscape',
        'landscape-primary',
        'landscape-secondary',
        'portrait',
        'portrait-primary',
        'portrait-secondary'
    ];
    private bool   $preferRelatedApplications = false;
    private array  $relatedApplications       = [];
    private string $scope                     = '';
    private string $shortName                 = '';
    private string $startUrl                  = '';
    private string $themeColor                = '';
    private array  $setFields                 = [];


    /**
     * @param iterable $fields See the setter methods for available fields
     */
    public function __construct(iterable $fields = []) {
        foreach ($fields as $field => $value) {
            $this->assertFieldsName($field);
            $this->{'set' . ucfirst($field)}($value);
        }
    }


    /**
     * Get an iterator for all fields that have been explicitly set.
     *
     * @return \Traversable
     */
    public function getIterator(): \Traversable {
        $fields = [];
        foreach ($this->setFields as $field => $value) {
            $fields[$field] = $this->{'get' . ucfirst($field)}();
        }

        return new \ArrayIterator($fields);
    }


    /**
     * @param string $field
     */
    private function assertFieldsName(string $field): void {
        static $validFields = [
            'backgroundColor',
            'description',
            'dir',
            'display',
            'id',
            'icons',
            'lang',
            'name',
            'orientation',
            'preferRelatedApplications',
            'relatedApplications',
            'scope',
            'shortName',
            'startUrl',
            'themeColor',
        ];
        if (!in_array($field, $validFields, true)) {
            throw new \InvalidArgumentException(sprintf('Unknown field "%s"', $field));
        }
    }


    /**
     * Get default values and merge existing fields with and return a new fields object.
     *
     * @param iterable $fields ManifestFields object or fields array
     * @return static
     */
    public function getDefaultValues(iterable $fields): self {
        $merged = clone $this;

        foreach ($fields as $field => $value) {
            $this->assertFieldsName($this->matchToUpper($field));
            $merged->{'set' . ucfirst($this->matchToUpper($field))}($value);
        }

        return $merged;
    }


    /**
     * Check the fields with default values and return a new fields object.
     *
     * @param iterable $fields ManifestFields object or fields array
     * @return static
     */
    public function check(iterable $fields): self {
        $check = clone $this;

        foreach ($fields as $field => $value) {
            $this->assertFieldsName($this->matchToUpper($field));
            $check->{'set' . ucfirst($this->matchToUpper($field))}($value);
        }

        return $check;
    }


    /**
     * Capitalize each word that follows an underscore
     *
     * @param string $str Field name
     * @return string
     */
    public function matchToUpper(string $str): string {
        $str = implode('', array_map('ucfirst', explode('_', $str)));

        return lcfirst($str);
    }


    /**
     * Get all fields.
     *
     * @return array Array of fields
     */
    public function getFields(): array {
        return (array)$this;
    }


    /**
     * Defines the expected “background color” for the website. This value repeats what is already available in the site’s CSS,
     * but can be used by browsers to draw the background color of a shortcut when the manifest is available before the stylesheet
     * has loaded. This creates a smooth transition between launching the web application and loading the site's content.
     *
     * @param string $backgroundColor
     * @return static
     */
    public function setBackgroundColor(string $backgroundColor): self {
        $this->backgroundColor = str_contains($backgroundColor, '#') ? $backgroundColor : '#' . $backgroundColor;
        $this->setFields['backgroundColor'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getBackgroundColor(): string {
        return $this->backgroundColor;
    }


    /**
     * @param string $description Provides a general description of what the pinned website does.
     * @return static
     */
    public function setDescription(string $description): self {
        $this->description = $description;
        $this->setFields['description'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }


    /**
     * Specifies the primary text direction for the name, short_name, and description members. Together with the lang
     * member, it helps the correct display of right-to-left languages.
     *
     * @param string $dir
     * @return static
     */
    public function setDir(string $dir): self {
        $this->dir = $dir;
        $this->setFields['dir'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getDir(): string {
        return $this->dir;
    }


    /**
     * @param string $display Defines the developers’ preferred display mode for the website.
     * @return static
     */
    public function setDisplay(string $display): self {
        $this->display = $display;
        $this->setFields['display'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getDisplay(): string {
        return $this->display;
    }


    /**
     * The id property represents the identity of the PWA to the browser.
     * When the browser sees a manifest that does not have an identity that matches an already installed PWA,
     * it will treat it as a new PWA, even if it is served from the same URL as another PWA.
     * But if it sees a manifest with an identity that matches the already installed PWA,
     * it will treat that as the installed PWA.
     *
     * @param string $id
     * @return static
     */
    public function setId(string $id): self {
        $this->id = $id;
        $this->setFields['id'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }


    /**
     * Specifies an array of image files that can serve as application icons, depending on context. For example, they
     * can be used to represent the web application amongst a list of other applications, or to integrate the web
     * application with an OS's task switcher and/or system preferences.
     *
     * @param array $icons
     * @return static
     */
    public function setIcons(array $icons): self {
        $this->icons = $icons;
        $this->setFields['icons'] = null;

        return $this;
    }


    /**
     * @return array
     */
    public function getIcons(): array {
        return $this->icons;
    }


    /**
     * Specifies the primary language for the values in the name and short_name members. This value is a string containing
     * a single language tag.
     *
     * @param string $lang
     * @return static
     */
    public function setLang(string $lang): self {
        $this->lang = $lang;
        $this->setFields['lang'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getLang(): string {
        return $this->lang;
    }


    /**
     * @param string $name Provides a human-readable name for the site when displayed to the user.
     * @return static
     */
    public function setName(string $name): self {
        $this->name = $name;
        $this->setFields['name'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }


    /**
     * @param string $orientation Defines the default orientation for all the website's top level browsing contexts.
     * @return static
     */
    public function setOrientation(string $orientation): self {
        $this->orientation = $orientation;
        $this->setFields['orientation'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getOrientation(): string {
        return $this->orientation;
    }


    /**
     *
     * Specifies a boolean value that hints for the user agent to indicate to the user that the specified native
     * applications (see below) are recommended over the website. This should only be used if the related native apps
     * really do offer something that the website can't.
     *
     * @param bool $preferRelatedApplications
     * @return static
     */
    public function setPreferRelatedApplications(bool $preferRelatedApplications): self {
        $this->preferRelatedApplications = $preferRelatedApplications;
        $this->setFields['preferRelatedApplications'] = null;

        return $this;
    }


    /**
     * @return bool
     */
    public function getPreferRelatedApplications(): bool {
        return $this->preferRelatedApplications;
    }


    /**
     * An array of native applications that are installable by, or accessible to, the underlying platform — for example,
     * a native Android application obtainable through the Google Play Store. Such applications are intended to be
     * alternatives to the website that provides similar/equivalent functionality — like the native app version of the
     * website.
     *
     * @param array $relatedApplications
     * @return static
     */
    public function setRelatedApplications(array $relatedApplications): self {
        $this->relatedApplications = $relatedApplications;
        $this->setFields['relatedApplications'] = null;

        return $this;
    }


    /**
     * @return array
     */
    public function getRelatedApplications(): array {
        return $this->relatedApplications;
    }


    /**
     * Provides a short human-readable name for the application. This is intended for when there is insufficient space to
     * display the full name of the web application, like device homescreens.
     *
     * @param string $scope
     * @return static
     */
    public function setScope(string $scope): self {
        $this->scope = $scope;
        $this->setFields['scope'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getScope(): string {
        return $this->scope ?: '';
    }


    /**
     * Provides a short human-readable name for the application. This is intended for when there is insufficient space to
     * display the full name of the web application, like device homescreens.
     *
     * @param string $shortName
     * @return static
     */
    public function setShortName(string $shortName): self {
        $this->shortName = $shortName;
        $this->setFields['shortName'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getShortName(): string {
        return $this->shortName;
    }


    /**
     * The URL that loads when a user launches the application (e.g. when added to home screen), typically the index.
     * Note that this has to be a relative URL, relative to the manifest url.
     *
     * @param string $startUrl
     * @return static
     */
    public function setStartUrl(string $startUrl): self {
        $this->startUrl = $startUrl;
        $this->setFields['startUrl'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getStartUrl(): string {
        return $this->startUrl;
    }


    /**
     * Defines the default theme color for an application. This sometimes affects how the OS displays the site (e.g.,
     * on Android's task switcher, the theme color surrounds the site).
     *
     * @param string $themeColor
     * @return static
     */
    public function setThemeColor(string $themeColor): self {
        $this->themeColor = str_contains($themeColor, '#') ? $themeColor : '#' . $themeColor;
        $this->setFields['themeColor'] = null;

        return $this;
    }


    /**
     * @return string
     */
    public function getThemeColor(): string {
        return $this->themeColor;
    }
}
