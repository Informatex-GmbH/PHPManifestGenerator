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

        return json_encode($this->toArray(), JSON_THROW_ON_ERROR|JSON_PRETTY_PRINT);
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
        $fields = [];
        foreach ($this->fields->getValidFieldNames() as $fieldName) {
            $name = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $fieldName));
            $fields[$name] = $this->fields->{'get' . ucfirst($fieldName)}();
        }

        foreach ($fields as $key => $value) {
            if (!$value) {
                unset($fields[$key]);
            }
        }

        return $fields;
    }
}
