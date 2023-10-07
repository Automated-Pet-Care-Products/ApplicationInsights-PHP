<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
* Data contract class for type Page_View_Data. An instance of PageView represents a generic action on a page like a button click. It is also the base type for PageView. 
*/
class Page_View_Data extends Base_Data implements Data_Interface
{
    public const URL          = 'url';
    public const DURATION     = 'duration';
    public const ID           = 'id';
    public const REFERRER_URI = 'referrerUri';

    /**
     * Creates a new PageViewData.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_envelopeTypeName = 'Microsoft.ApplicationInsights.PageView';
        $this->_dataTypeName     = 'PageViewData';
        $this->_data->put('ver', 2);
        $this->_data->put('name', null);
    }

    /**
     * Gets the url field. Request URL with all query string parameters
     */
    public function getUrl(): ?string
    {
        if ($this->_data->hasKey(self::URL)) {
            return $this->_data->get(self::URL);
        }
        return null;
    }

    /**
     * Sets the url field. Request URL with all query string parameters
     */
    public function setUrl(string $url): void
    {
        $this->_data->put(self::URL, $url);
    }

    /**
     * Gets the duration field.
     * Request duration in format: DD.HH:MM:SS.MMMMMM.
     * For a page view (PageViewData), this is the duration.
     * For a page view with performance information (PageViewPerfData), this is the page load time.
     * Must be less than 1000 days.
     */
    public function getDuration(): ?string
    {
        if ($this->_data->hasKey(self::DURATION)) {
            return $this->_data->get(self::DURATION);
        }
        return null;
    }

    /**
     * Sets the duration field.
     * Request duration in format: DD.HH:MM:SS.MMMMMM.
     * For a page view (PageViewData), this is the duration.
     * For a page view with performance information (PageViewPerfData), this is the page load time.
     * Must be less than 1000 days.
     */
    public function setDuration(string $duration): void
    {
        $this->_data->put(self::DURATION, $duration);
    }

    /**
     * Gets the id field.
     * Identifier of a page view instance.
     * Used for correlation between page view and other telemetry items.
     */
    public function getId(): mixed
    {
        if ($this->_data->hasKey(self::ID)) {
            return $this->_data->get(self::ID);
        }
        return null;
    }

    /**
     * Sets the id field.
     * Identifier of a page view instance.
     * Used for correlation between page view and other telemetry items.
     */
    public function setId(mixed $id): void
    {
        $this->_data->put(self::ID, $id);
    }

    /**
     * Gets the referrerUri field. Fully qualified page URI or URL of the referring page; if unknown, leave blank.
     */
    public function getReferrerUri(): ?string
    {
        if ($this->_data->hasKey(self::REFERRER_URI)) {
            return $this->_data->get(self::REFERRER_URI);
        }
        return null;
    }

    /**
     * Sets the referrerUri field. Fully qualified page URI or URL of the referring page; if unknown, leave blank.
     */
    public function setReferrerUri(?string $referrerUri): void
    {
        $this->_data->put(self::REFERRER_URI, $referrerUri);
    }
}
