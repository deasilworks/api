deasilworks\API\API
===============

Class CEF.

Responsible for managing configuration and
providing an EntityManager factory.


* Class name: API
* Namespace: deasilworks\API





Properties
----------


### $config

    private \deasilworks\API\APIConfig $config





* Visibility: **private**


Methods
-------


### __construct

    mixed deasilworks\API\API::__construct(\deasilworks\API\APIConfig $config)

API constructor.



* Visibility: **public**


#### Arguments
* $config **[deasilworks\API\APIConfig](deasilworks-API-APIConfig.md)**



### execute

    mixed deasilworks\API\API::execute(\deasilworks\API\Model\RestRequestModel $apiRequest)

Execute API call.



* Visibility: **public**


#### Arguments
* $apiRequest **[deasilworks\API\Model\RestRequestModel](deasilworks-API-Model-RestRequestModel.md)**



### optionsAck

    \deasilworks\API\Model\AckModel deasilworks\API\API::optionsAck(\deasilworks\API\ActionReader $actionReader, string $action)

Ack Options.



* Visibility: **private**


#### Arguments
* $actionReader **[deasilworks\API\ActionReader](deasilworks-API-ActionReader.md)**
* $action **string**



### serialize

    string deasilworks\API\API::serialize($object)

Serialize.



* Visibility: **private**


#### Arguments
* $object **mixed**



### callAction

    \deasilworks\API\Model\AckModel deasilworks\API\API::callAction(\deasilworks\API\ActionReader $actionReader, \deasilworks\API\Model\RestRequestModel $apiRequest, $action, $args)

Call Action.



* Visibility: **private**


#### Arguments
* $actionReader **[deasilworks\API\ActionReader](deasilworks-API-ActionReader.md)**
* $apiRequest **[deasilworks\API\Model\RestRequestModel](deasilworks-API-Model-RestRequestModel.md)**
* $action **mixed**
* $args **mixed**



### resolveController

    array deasilworks\API\API::resolveController(string $route, string $path)

Resolves controller to object and remaining args.



* Visibility: **private**


#### Arguments
* $route **string**
* $path **string**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.