<?php

declare(strict_types = 1);

namespace ifmx\PHPManifestGenerator;

class ManifestProtocolHandler {

    private string $protocol = '';
    private string $url = '';


    /**
     * The protocol which the application can handle.
     *
     * @param string $protocol
     * @return void
     */
    public function setProtocol(string $protocol): void {

        if (!str_starts_with($protocol, 'web+')) {
            throw new \Exception(sprintf('Protocol must start with "web+"', $field));
        }

        $this->protocol = $protocol;
    }


    /**
     * @return string
     */
    public function getProtocol(): string {
        return $this->protocol;
    }


    /**
     * The URL at which the application sends the request to handle the protocol.
     *
     * @param string $url
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
}
