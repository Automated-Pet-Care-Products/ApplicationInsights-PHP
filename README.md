# Application Insights for PHP

This project extends the Application Insights API surface to support PHP.
[Application Insights](https://azure.microsoft.com/services/application-insights/) is a
service that allows developers to keep their application available, performing
and succeeding. This PHP module will allow you to send telemetry of various
kinds (event, trace, exception, etc.) to the Application Insights service where
they can be visualized in the Azure Portal.

## Status

This SDK is NOT maintained or supported by Microsoft even though we've contributed to it in the past. Note that Azure Monitor only provides support when using the [supported SDKs](https://docs.microsoft.com/en-us/azure/azure-monitor/app/platforms#unsupported-community-sdks). We’re constantly assessing opportunities to expand our support for other languages, so follow our [GitHub Announcements](https://github.com/microsoft/ApplicationInsights-Announcements/issues) page to receive the latest SDK news.

## Requirements

PHP version >= 8.2 is supported.

For opening the project in Microsoft Visual Studio,
you will need [PHP Tools for Visual Studio](https://www.devsense.com/products/php-tools).

This is not required, however. You should use PHPStorm.

## Installation

We've published a package you can find on [Packagist](https://packagist.org/packages/microsoft/application-insights). In order to use it, first, you'll need to get [Composer](https://getcomposer.org/).

Once you've set up your project to use Composer,
just add a reference to our package with whichever version you'd like to use to your composer.json file.

```json
{
  "require": {
    "whisker/application-insights": "*"
  }
}
```

Or you can use the composer command to automatically add the package to your composer.json file.

```shell
composer require whisker/application-insights
```

Make sure you add the require statement to pull in the library:

```php
require_once 'vendor/autoload.php';
```

## Usage

Once installed, you can send telemetry to Application Insights. Here are a few samples.

>**Note**: before you can send data to Azure, you will need an instrumentation key. Please see the [Getting an Application Insights Instrumentation Key](https://github.com/Microsoft/AppInsights-Home/wiki#getting-an-application-insights-instrumentation-key) section for more information.

### Initializing the client and setting the instrumentation key and other optional configurations

```php
/**
 * Use PSR-7 compliant HTTP client
 */
$httpClient = new Psr\Http\ClientInterface();
$telemetryClient = new \src\Telemetry_Client($httpClient);
$context = $telemetryClient->getContext();

// Necessary
$context->setInstrumentationKey('YOUR INSTRUMENTATION KEY');

// Optional
$context->getSessionContext()->setId(session_id());
$context->getUserContext()->setId('YOUR USER ID');
$context->getApplicationContext()->setVer('YOUR VERSION');
$context->getLocationContext()->setIp('YOUR IP');

// Start tracking
$telemetryClient->trackEvent('name of your event');
$telemetryClient->flush();
```

### Set up Operation context

For correct Application Insights reporting you need to set up Operation Context,
reference to Request

```php
$telemetryClient->getContext()->getOperationContext()->setId('XX');
$telemetryClient->getContext()->getOperationContext()->setName('GET Index');
```

### Sending a simple event telemetry item with event name

```php
$telemetryClient->trackEvent('name of your event');
$telemetryClient->flush();
```

### Sending an event telemetry item with custom properties and measurements

```php
$telemetryClient->trackEvent('name of your event', ['MyCustomProperty' => 42, 'MyCustomProperty2' => 'test'], ['duration', 42]);
$telemetryClient->flush();
```

**Sending more than one telemetry item before sending to the service is also
supported; the API will batch everything until you call flush()**

```php
$telemetryClient->trackEvent('name of your event');
$telemetryClient->trackEvent('name of your second event');
$telemetryClient->flush();
```

### Sending a simple page view telemetry item with page name and url

```php
$telemetryClient->trackPageView('myPageView', 'https://www.foo.com');
$telemetryClient->flush();
```

### Sending a page view telemetry item with duration, custom properties, and measurements

```php
$telemetryClient->trackPageView('myPageView', 'https://www.foo.com', 256, ['InlineProperty' => 'test_value'], ['duration' => 42.0]);
$telemetryClient->flush();
```

### Sending a simple metric telemetry item with metric name and value

```php
$telemetryClient->trackMetric('myMetric', 42.0);
$telemetryClient->flush();
```

### Sending a metric telemetry item with a point type, count, min, max, standard deviation, and measurements

```php
$telemetryClient->trackMetric('myMetric', 42.0, \src\Channel\Contracts\Data_Point_Type::Aggregation, 5, 0, 1, 0.2, ['InlineProperty' => 'test_value']);
$telemetryClient->flush();
```

### Sending a simple message telemetry item with a message

```php
$telemetryClient->trackMessage('myMessage', \src\Channel\Contracts\Message_Severity_Level::INFORMATION, ['InlineProperty' => 'test_value']);
$telemetryClient->flush();
```

**Sending a simple request telemetry item with request name, url and start
time**

```php
$telemetryClient->trackRequest('myRequest', 'https://foo.bar', new \DateTime());
$telemetryClient->flush();
```

### Sending a request telemetry item with duration, http status code, whether the request succeeded, custom properties and measurements

```php
$telemetryClient->trackRequest('myRequest', 'https://foo.bar', new \DateTime(), 3754, 200, true, ['InlineProperty' => 'test_value'], ['duration_inner' => 42.0]);
$telemetryClient->flush();
```

### Sending an exception telemetry, with custom properties and metrics

```php
try
{
    // Do something to throw an exception
}
catch (\Exception $ex)
{
    $telemetryClient->trackException($ex, ['InlineProperty' => 'test_value'], ['duration_inner' => 42.0]);
    $telemetryClient->flush();
}
```

### Set the Client to gzip the data before sending

```php
$telemetryClient->getChannel()->setSendGzipped(true);
```

### Registering an exception handler

```php
class Handle_Exceptions
{
    private $_telemetryClient;

    public function __construct()
    {
        $this->_telemetryClient = new \src\Telemetry_Client();
        $this->_telemetryClient->getContext()->setInstrumentationKey('YOUR INSTRUMENTATION KEY');

        set_exception_handler(array($this, 'exceptionHandler'));
    }

    function exceptionHandler(\Exception $exception)
    {
        if ($exception != NULL)
        {
            $this->_telemetryClient->trackException($exception);
            $this->_telemetryClient->flush();
        }
    }
}
```

### Sending a successful SQL dependency telemetry item

```php
$telemetryClient->trackDependency('Query table', "SQL", 'SELECT * FROM table;', new \DateTime(), 122, true);
$telemetryClient->flush();
```

### Sending a failed HTTP dependency telemetry item

```php
$telemetryClient->trackDependency('method', "HTTP", "https://example.com/api/method", new \DateTime(), 324, false, 503);
$telemetryClient->flush();
```

### Sending any other kind dependency telemetry item

```php
$telemetryClient->trackDependency('Name of operation', "service", 'Arguments', new \DateTime(), 23, true);
$telemetryClient->flush();
```

### Changing the operation id (which links actions together)

```php
$telemetryClient->trackMetric('interestingMetric', 10);
$telemetryClient->getContext()->getOperationContext()->setId(\src\Channel\Contracts\Utils::returnGuid())
$telemetryClient->trackMetric('differentOperationMetric', 11);
$telemetryClient->flush();
```

## Code of conduct

This project has adopted the [Microsoft Open Source Code of Conduct](https://opensource.microsoft.com/codeofconduct/).
For more information,
see the [Code of Conduct FAQ](https://opensource.microsoft.com/codeofconduct/faq/)
or contact [opencode@microsoft.com](mailto:opencode@microsoft.com) with any additional questions or comments.
