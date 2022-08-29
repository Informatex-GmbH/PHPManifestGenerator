<?php

declare(strict_types = 1);

namespace ifmx\PHPManifestGenerator;

class ManifestIcons {

    private string $src = '';
    private string $sizes = '';
    private string $type = '';


    /**
     * @param string $src The path to the image file. If src is a relative URL, the base URL will be the URL of the manifest.
     * @return void
     */
    public function setSrc(string $src): void {
        $this->src = $src;
    }


    /**
     * @return string
     */
    public function getSrc(): string {
        return $this->src;
    }


    /**
     * @param string $sizes A string containing space-separated image dimensions.
     * @return void
     */
    public function setSizes(string $sizes): void {
        $this->sizes = $sizes;
    }


    /**
     * @return string
     */
    public function getSizes(): string {
        return $this->sizes;
    }


    /**
     * A hint as to the media type of the image. The purpose of this member is to allow a user agent to quickly ignore
     * images of media types it does not support.
     *
     * @param string $type *
     * @return void
     */
    public function setType(string $type): void {
        $this->type = $type;
    }


    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }
}
