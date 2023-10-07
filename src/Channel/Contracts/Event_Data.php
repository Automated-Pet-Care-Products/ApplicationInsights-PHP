<?php

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
* Data contract class for type Event_Data. Instances of Event represent structured event records that can be grouped and searched by their properties. Event data item also creates a metric of event count by name. 
*/
class Event_Data extends Base_Data implements Data_Interface
{

    /**
     * Creates a new EventData.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_envelopeTypeName = 'Microsoft.ApplicationInsights.Event';
        $this->_dataTypeName = 'EventData';
        $this->_data['ver'] = 2;
        $this->_data->put('name', null);
    }
}
