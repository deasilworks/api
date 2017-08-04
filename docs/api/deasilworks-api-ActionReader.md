deasilworks\api\ActionReader
===============

Class ControllerAction.

Responsible resolving a controller based
on a name and returning ActionModels


* Class name: ActionReader
* Namespace: deasilworks\api





Properties
----------


### $reader

    private \Doctrine\Common\Annotations\Reader $reader





* Visibility: **private**


### $controller

    private object $controller





* Visibility: **private**


### $actionCollection

    private \deasilworks\api\model\ActionCollection $actionCollection





* Visibility: **private**


Methods
-------


### __construct

    mixed deasilworks\api\ActionReader::__construct($controller)

Resolver constructor.



* Visibility: **public**


#### Arguments
* $controller **mixed**



### getController

    object deasilworks\api\ActionReader::getController()





* Visibility: **public**




### getActionCollection

    \deasilworks\api\model\ActionCollection deasilworks\api\ActionReader::getActionCollection()





* Visibility: **public**




### resolve

    mixed deasilworks\api\ActionReader::resolve()





* Visibility: **private**




### resolveActions

    mixed deasilworks\api\ActionReader::resolveActions(\ReflectionObject $reflectionObject)





* Visibility: **private**


#### Arguments
* $reflectionObject **ReflectionObject**



### parseActionMethod

    array deasilworks\api\ActionReader::parseActionMethod($methodName)





* Visibility: **private**


#### Arguments
* $methodName **mixed**



### resolveActionParams

    \deasilworks\api\model\ParamCollection deasilworks\api\ActionReader::resolveActionParams(\ReflectionMethod $reflectionMethod)





* Visibility: **private**


#### Arguments
* $reflectionMethod **ReflectionMethod**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.