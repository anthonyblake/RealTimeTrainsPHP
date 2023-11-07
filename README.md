# RealTimeTrainsPHP

PHP/HTML/JavaScript page showing the live departure board for Preston train station using the API at https://api.rtt.io/

Add a config.php with your own credentials from https://api.rtt.io/:

**config.php**

`<?php
return array(
    'apiuser' => 'username',
    'apipass' => 'password');
?>`

Modify the default desintation station (default PRE) with a CRS station code from here:

**error_log.txt**
create an empty text file called error_log.txt.

Modify the following line with the files location, or remove the line to stop logging errors from cURL:

**getDepartures.php**

`$fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');`

**CRS Station Codes**

[http://www.railwaycodes.org.uk/crs/crs0.shtm](http://www.railwaycodes.org.uk/crs/crs0.shtm)

Switch from departures to arrivals by suffixing the endpoint with /arrivals

**API Documentation**

[https://www.realtimetrains.co.uk/about/developer/pull/docs/](https://www.realtimetrains.co.uk/about/developer/pull/docs/)


## Preston Departure Board

![Alt text](/Screenshots/PrestonDepartures.PNG?raw=true "Preston Departure Board")
