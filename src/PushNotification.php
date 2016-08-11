<?php declare(strict_types = 1);

namespace Cmnty\Push;

interface PushNotification
{
    /**
     * Convert the push notification into a json string.
     *
     * @return string
     */
    public function __toString();

    /**
     * Convert the push notification into a json string.
     *
     * @return string
     */
    public function json();

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get the body.
     *
     * @return string
     */
    public function getBody();

    /**
     * Get the body.
     *
     * @return string|null
     */
    public function getUrl();

    /**
     * Get the icon.
     *
     * @return string|null
     */
    public function getIcon();
}
