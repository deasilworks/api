deasilworks\api\API
===============

Class CEF.

Responsible for managing configuration and
providing an EntityManager factory.


* Class name: API
* Namespace: deasilworks\api





Properties
----------


### $config

    private \deasilworks\api\APIConfig $config





* Visibility: **private**


Methods
-------


### __construct

    mixed deasilworks\api\API::__construct(\deasilworks\api\APIConfig $config)

API constructor.



* Visibility: **public**


#### Arguments
* $config **[deasilworks\api\APIConfig](deasilworks-api-APIConfig.md)**



### execute

    mixed deasilworks\api\API::execute(\deasilworks\api\model\HttpRequestModel $apiRequest)

Execute API call.



* Visibility: **public**


#### Arguments
* $apiRequest **deasilworks\api\model\HttpRequestModel**



### optionsAck

    \deasilworks\api\model\AckModel deasilworks\api\API::optionsAck(\deasilworks\api\ActionReader $actionReader, string $action)

Ack Options.



* Visibility: **private**


#### Arguments
* $actionReader **[deasilworks\api\ActionReader](deasilworks-api-ActionReader.md)**
* $action **string**



### serialize

    string deasilworks\api\API::serialize($object)

Serialize.



* Visibility: **private**


#### Arguments
* $object **mixed**



### callAction

    \deasilworks\api\model\AckModel deasilworks\api\API::callAction(\deasilworks\api\ActionReader $actionReader, \deasilworks\api\model\HttpRequestModel $apiRequest, $action, $args)

Call Action.



* Visibility: **private**


#### Arguments
* $actionReader **[deasilworks\api\ActionReader](deasilworks-api-ActionReader.md)**
* $apiRequest **deasilworks\api\model\HttpRequestModel**
* $action **mixed**
* $args **mixed**



### resolveController

    array deasilworks\api\API::resolveController($path)

Resolves controller to object and remaining args.



* Visibility: **private**


#### Arguments
* $path **mixed**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.