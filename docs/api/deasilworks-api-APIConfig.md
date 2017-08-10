deasilworks\API\APIConfig
===============

Class APIConfig.




* Class name: APIConfig
* Namespace: deasilworks\API





Properties
----------


### $routes

    private array $routes





* Visibility: **private**


### $controllerFactory

    private callable $controllerFactory





* Visibility: **private**


### $serializer

    private callable $serializer





* Visibility: **private**


Methods
-------


### getRoutes

    array deasilworks\API\APIConfig::getRoutes()





* Visibility: **public**




### setRoutes

    \deasilworks\API\APIConfig deasilworks\API\APIConfig::setRoutes(array $routes)





* Visibility: **public**


#### Arguments
* $routes **array**



### setRoute

    array deasilworks\API\APIConfig::setRoute(array $route, $config)

Add or set a route.



* Visibility: **public**


#### Arguments
* $route **array**
* $config **mixed**



### getClassPath

    string deasilworks\API\APIConfig::getClassPath(string $route)





* Visibility: **public**


#### Arguments
* $route **string**



### getAliases

    array deasilworks\API\APIConfig::getAliases(string $route)





* Visibility: **public**


#### Arguments
* $route **string**



### getControllerFactory

    callable deasilworks\API\APIConfig::getControllerFactory()





* Visibility: **public**




### setControllerFactory

    \deasilworks\API\APIConfig deasilworks\API\APIConfig::setControllerFactory(callable $controllerFactory)





* Visibility: **public**


#### Arguments
* $controllerFactory **callable**



### getSerializer

    callable deasilworks\API\APIConfig::getSerializer()





* Visibility: **public**




### setSerializer

    \deasilworks\API\APIConfig deasilworks\API\APIConfig::setSerializer(callable $serializer)





* Visibility: **public**


#### Arguments
* $serializer **callable**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.