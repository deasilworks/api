deasilworks\API\ActionReader
===============

Class ControllerAction.

Responsible resolving a controller based
on a name and returning ActionModels


* Class name: ActionReader
* Namespace: deasilworks\API





Properties
----------


### $reader

    private \Doctrine\Common\Annotations\Reader $reader





* Visibility: **private**


### $controller

    private object $controller





* Visibility: **private**


### $actionCollection

    private \deasilworks\API\Model\ActionCollection $actionCollection





* Visibility: **private**


Methods
-------


### __construct

    mixed deasilworks\API\ActionReader::__construct($controller)

Resolver constructor.



* Visibility: **public**


#### Arguments
* $controller **mixed**



### getController

    object deasilworks\API\ActionReader::getController()





* Visibility: **public**




### getActionCollection

    \deasilworks\API\Model\ActionCollection deasilworks\API\ActionReader::getActionCollection()





* Visibility: **public**




### resolve

    mixed deasilworks\API\ActionReader::resolve()





* Visibility: **private**




### resolveActions

    mixed deasilworks\API\ActionReader::resolveActions(\ReflectionObject $reflectionObject)





* Visibility: **private**


#### Arguments
* $reflectionObject **ReflectionObject**



### parseActionMethod

    array deasilworks\API\ActionReader::parseActionMethod($methodName)





* Visibility: **private**


#### Arguments
* $methodName **mixed**



### resolveActionParams

    \deasilworks\API\Model\ParamCollection deasilworks\API\ActionReader::resolveActionParams(\ReflectionMethod $reflectionMethod)





* Visibility: **private**


#### Arguments
* $reflectionMethod **ReflectionMethod**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.