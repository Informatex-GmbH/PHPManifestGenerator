<?php

declare(strict_types = 1);

namespace ifmx\PHPManifestGenerator;

class ManifestGenerator {

    private ManifestFields|iterable $fields;


    /**
     * @param iterable $fields ManifestFields object or fields array
     */
    public function __construct(iterable $fields = []) {
        if (!$fields instanceof ManifestFields) {
            $fields = new ManifestFields($fields);
        }
        $this->fields = $fields;
    }


    /**
     * Generate a manifest from the specified fields.
     *
     * @param iterable $fields ManifestFields object or fields array
     *
     * @return string
     * @throws \JsonException
     */
    public function toJSON(iterable $fields = []): string {
        $this->fields = $this->fields->check($fields);

        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }


    /**
     * @param iterable $fields
     * @return array
     */
    public function getDefaultValues(iterable $fields = []): array {
        $this->fields = $this->fields->getDefaultValues($fields);

        return $this->fields;
    }


    /**
     * @return array
     */
    public function toArray(): array {
        $fields = [
            'background_color' => $this->fields->getBackgroundColor(),
            'description' => $this->fields->getDescription(),
            'dir' => $this->fields->getDir(),
            'display' => $this->fields->getDisplay(),
            'icons' => $this->fields->getIcons(),
            'id' => $this->fields->getId(),
            'lang' => $this->fields->getLang(),
            'name' => $this->fields->getName(),
            'orientation' => $this->fields->getOrientation(),
            'prefer_related_applications' => $this->fields->getPreferRelatedApplications(),
            'related_applications' => $this->fields->getRelatedApplications(),
            'scope' => $this->fields->getScope(),
            'short_name' => $this->fields->getShortName(),
            'start_url' => $this->fields->getStartUrl(),
            'theme_color' => $this->fields->getThemeColor(),
            'screenshots' => $this->fields->getScreenshots(),
        ];

        foreach ($fields as $key => $value) {
            if (!$value) {
                unset($fields[$key]);
            }
        }

        return $fields;
    }
}
