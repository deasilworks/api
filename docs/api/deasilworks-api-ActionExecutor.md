deasilworks\api\ActionExecutor
===============

Class ControllerAction.

Responsible resolving a controller based
on a name and returning ActionModels


* Class name: ActionExecutor
* Namespace: deasilworks\api





Properties
----------


### $actionReader

    protected \deasilworks\api\ActionReader $actionReader





* Visibility: **protected**


Methods
-------


### __construct

    mixed deasilworks\api\ActionExecutor::__construct(\deasilworks\api\ActionReader $actionReader)

Resolver constructor.



* Visibility: **public**


#### Arguments
* $actionReader **[deasilworks\api\ActionReader](deasilworks-api-ActionReader.md)**



### execute

    \deasilworks\api\$response deasilworks\api\ActionExecutor::execute(\deasilworks\api\model\HttpRequestModel $apiRequest, $action, $indexedArgs)





* Visibility: **public**


#### Arguments
* $apiRequest **deasilworks\api\model\HttpRequestModel**
* $action **mixed**
* $indexedArgs **mixed**



### contentParser

    mixed deasilworks\api\ActionExecutor::contentParser(\deasilworks\api\model\HttpRequestModel $apiRequest)





* Visibility: **private**


#### Arguments
* $apiRequest **deasilworks\api\model\HttpRequestModel**



### prepareArgs

    array deasilworks\api\ActionExecutor::prepareArgs(\deasilworks\api\Model\Action\ActionModel $targetAction, array $indexedArgs, array $searchHashedArgs)

Prepare Args.



* Visibility: **private**


#### Arguments
* $targetAction **[deasilworks\api\Model\Action\ActionModel](deasilworks-api-Model-Action-ActionModel.md)**
* $indexedArgs **array** - &lt;p&gt;indexed array of args&lt;/p&gt;
* $searchHashedArgs **array** - &lt;p&gt;array of hashes to search&lt;/p&gt;



### sanitizeArgs

    array deasilworks\api\ActionExecutor::sanitizeArgs($preparedArgs)





* Visibility: **private**


#### Arguments
* $preparedArgs **mixed**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.