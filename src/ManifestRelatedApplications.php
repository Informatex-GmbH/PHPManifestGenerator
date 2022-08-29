<?php

declare(strict_types = 1);

namespace ifmx\PHPManifestGenerator;

class ManifestRelatedApplications {

    private string $platform = '';
    private string $url = '';
    private string $id = '';


    /**
     * @param string $platform The platform on which the application can be found.
     * @return void
     */
    public function setPlatform(string $platform): void {
        $this->platform = $platform;
    }


    /**
     * @return string
     */
    public function getPlatform(): string {
        return $this->platform;
    }


    /**
     * @param string $url The URL at which the application can be found.
     * @return void
     */
    public function setUrl(string $url): void {
        $this->url = $url;
    }


    /**
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }


    /**
     * @param string $id The ID used to represent the application on the specified platform.
     * @return void
     */
    public function setId(string $id): void {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }
}
