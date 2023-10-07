<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Metric_Data.
 * An instance of the Metric item is a list of measurements (single data points) and/or aggregations.
 */
class Metric_Data extends Base_Data implements Data_Interface
{
    public const METRICS = 'metrics';

    /**
     * Creates a new MetricData.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_envelopeTypeName = 'Microsoft.ApplicationInsights.Metric';
        $this->_dataTypeName = 'MetricData';

        $this->setVer(2);

        $this->_data->put(self::METRICS, []);
    }

    /**
     * Gets the metrics field.
     * List of metrics.
     * Only one metric in the list is currently supported by Application Insights storage.
     * If multiple data points were sent, only the first one will be used.
     */
    public function getMetrics(): ?array
    {
        if ($this->_data->hasKey(self::METRICS)) {
            return $this->_data->get(self::METRICS);
        }
        return null;
    }

    /**
     * Sets the metrics field.
     * List of metrics.
     * Only one metric in the list is currently supported by Application Insights storage.
     * If multiple data points were sent, only the first one will be used.
     */
    public function setMetrics(?array $metrics): void
    {
        $this->_data->put(self::METRICS, $metrics);
    }
}
