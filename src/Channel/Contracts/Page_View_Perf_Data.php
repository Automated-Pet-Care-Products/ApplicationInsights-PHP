<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
* Data contract class for type Page_View_Perf_Data. An instance of PageViewPerf represents: a page view with no performance data, a page view with performance data, or just the performance data of an earlier page request. 
*/
class Page_View_Perf_Data extends Base_Data implements Data_Interface
{
    public const TOTAL_PERFORMANCE        = 'perfTotal';
    public const DURATION_MS              = 'duration';
    public const REQUEST_SENT             = 'sentRequest';
    public const PAGE_LOAD_TIME           = 'receivedResponse';
    public const PAGE_VIEW_DOM_PROCESSING = 'domProcessing';
    public const PAGE_REFERRER             = 'referrerUri';

    /**
    * Creates a new PageViewPerfData. 
    */
    public function __construct()
    {
        parent::__construct();

        $this->_envelopeTypeName = 'Microsoft.ApplicationInsights.PageViewPerf';
        $this->_dataTypeName = 'PageViewPerfData';
        $this->_data->put('ver', 2);
        $this->_data->put('name', null);
    }

    /**
    * Gets the url field. Request URL with all query string parameters 
    */
    public function getUrl(): ?string
    {
        if ($this->_data->hasKey('url')) {
            return $this->_data->get('url');
        }
        return NULL;
    }

    /**
    * Sets the url field. Request URL with all query string parameters 
    */
    public function setUrl(string $url): void
    {
        $this->_data->put('url', $url);
    }

    /**
    * Gets the perfTotal field. Performance total in TimeSpan 'G' (general long) format: d:hh:mm:ss.fffffff 
    */
    public function getPerfTotal(): ?string
    {
        if ($this->_data->hasKey(self::TOTAL_PERFORMANCE)) {
            return $this->_data->get(self::TOTAL_PERFORMANCE);
        }
        return NULL;
    }

    /**
    * Sets the perfTotal field. Performance total in TimeSpan 'G' (general long) format: d:hh:mm:ss.fffffff 
    */
    public function setPerfTotal(string $perfTotal): void
    {
        $this->_data->put(self::TOTAL_PERFORMANCE, $perfTotal);
    }

    /**
    * Gets the duration field. Request duration in format: DD.HH:MM:SS.MMMMMM. For a page view (PageViewData), this is the duration. For a page view with performance information (PageViewPerfData), this is the page load time. Must be less than 1000 days. 
    */
    public function getDuration(): ?string
    {
        if ($this->_data->hasKey(self::DURATION_MS)) {
            return $this->_data->get(self::DURATION_MS);
        }
        return NULL;
    }

    /**
    * Sets the duration field. Request duration in format: DD.HH:MM:SS.MMMMMM. For a page view (PageViewData), this is the duration. For a page view with performance information (PageViewPerfData), this is the page load time. Must be less than 1000 days. 
    */
    public function setDuration(string $duration): void
    {
        $this->_data->put(self::DURATION_MS, $duration);
    }

    /**
    * Gets the networkConnect field. Network connection time in TimeSpan 'G' (general long) format: d:hh:mm:ss.fffffff 
    */
    public function getNetworkConnect(): ?string
    {
        if ($this->_data->hasKey('networkConnect')) {
            return $this->_data->get('networkConnect');
        }
        return NULL;
    }

    /**
    * Sets the networkConnect field. Network connection time in TimeSpan 'G' (general long) format: d:hh:mm:ss.fffffff 
    */
    public function setNetworkConnect(string $networkConnect): void
    {
        $this->_data->put('networkConnect', $networkConnect);
    }

    /**
    * Gets the sentRequest field. Sent request time in TimeSpan 'G' (general long) format: d:hh:mm:ss.fffffff 
    */
    public function getSentRequest(): ?string
    {
        if ($this->_data->hasKey(self::REQUEST_SENT)) {
            return $this->_data->get(self::REQUEST_SENT);
        }
        return NULL;
    }

    /**
    * Sets the sentRequest field. Sent request time in TimeSpan 'G' (general long) format: d:hh:mm:ss.fffffff 
    */
    public function setSentRequest(string $sentRequest): void
    {
        $this->_data->put(self::REQUEST_SENT, $sentRequest);
    }

    /**
    * Gets the receivedResponse field. Received response time in TimeSpan 'G' (general long) format: d:hh:mm:ss.fffffff 
    */
    public function getReceivedResponse(): ?string
    {
        if ($this->_data->hasKey(self::PAGE_LOAD_TIME)) {
            return $this->_data->get(self::PAGE_LOAD_TIME);
        }
        return NULL;
    }

    /**
    * Sets the receivedResponse field. Received response time in TimeSpan 'G' (general long) format: d:hh:mm:ss.fffffff 
    */
    public function setReceivedResponse(string $receivedResponse): void
    {
        $this->_data->put(self::PAGE_LOAD_TIME, $receivedResponse);
    }

    /**
    * Gets the id field. Identifier of a page view instance. Used for correlation between page view and other telemetry items. 
    */
    public function getId(): mixed
    {
        if ($this->_data->hasKey('id')) {
            return $this->_data->get('id');
        }
        return NULL;
    }

    /**
    * Sets the id field. Identifier of a page view instance. Used for correlation between page view and other telemetry items. 
    */
    public function setId(mixed $id): void
    {
        $this->_data->put('id', $id);
    }

    /**
    * Gets the domProcessing field. DOM processing time in TimeSpan 'G' (general long) format: d:hh:mm:ss.fffffff 
    */
    public function getDomProcessing(): ?string
    {
        if ($this->_data->hasKey(self::PAGE_VIEW_DOM_PROCESSING)) {
            return $this->_data->get(self::PAGE_VIEW_DOM_PROCESSING);
        }
        return NULL;
    }

    /**
    * Sets the domProcessing field. DOM processing time in TimeSpan 'G' (general long) format: d:hh:mm:ss.fffffff 
    */
    public function setDomProcessing(string $domProcessing): void
    {
        $this->_data->put(self::PAGE_VIEW_DOM_PROCESSING, $domProcessing);
    }

    /**
    * Gets the referrerUri field. Fully qualified page URI or URL of the referring page; if unknown, leave blank. 
    */
    public function getReferrerUri(): ?string
    {
        if ($this->_data->hasKey(self::PAGE_REFERRER)) {
            return $this->_data->get(self::PAGE_REFERRER);
        }
        return NULL;
    }

    /**
    * Sets the referrerUri field. Fully qualified page URI or URL of the referring page; if unknown, leave blank. 
    */
    public function setReferrerUri(string $referrerUri): void
    {
        $this->_data->put(self::PAGE_REFERRER, $referrerUri);
    }
}
