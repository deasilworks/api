deasilworks\API\ActionExecutor
===============

Class ControllerAction.

Responsible resolving a controller based
on a name and returning ActionModels


* Class name: ActionExecutor
* Namespace: deasilworks\API





Properties
----------


### $actionReader

    protected \deasilworks\API\ActionReader $actionReader





* Visibility: **protected**


Methods
-------


### __construct

    mixed deasilworks\API\ActionExecutor::__construct(\deasilworks\API\ActionReader $actionReader)

Resolver constructor.



* Visibility: **public**


#### Arguments
* $actionReader **[deasilworks\API\ActionReader](deasilworks-API-ActionReader.md)**



### execute

    \deasilworks\API\$response deasilworks\API\ActionExecutor::execute(\deasilworks\API\Model\RestRequestModel $apiRequest, $action, $indexedArgs)





* Visibility: **public**


#### Arguments
* $apiRequest **[deasilworks\API\Model\RestRequestModel](deasilworks-API-Model-RestRequestModel.md)**
* $action **mixed**
* $indexedArgs **mixed**



### contentParser

    mixed deasilworks\API\ActionExecutor::contentParser(\deasilworks\API\Model\RestRequestModel $apiRequest)





* Visibility: **private**


#### Arguments
* $apiRequest **[deasilworks\API\Model\RestRequestModel](deasilworks-API-Model-RestRequestModel.md)**



### prepareArgs

    array deasilworks\API\ActionExecutor::prepareArgs(\deasilworks\API\Model\Action\ActionModel $targetAction, array $indexedArgs, array $searchHashedArgs)

Prepare Args.



* Visibility: **private**


#### Arguments
* $targetAction **[deasilworks\API\Model\Action\ActionModel](deasilworks-API-Model-Action-ActionModel.md)**
* $indexedArgs **array** - &lt;p&gt;indexed array of args&lt;/p&gt;
* $searchHashedArgs **array** - &lt;p&gt;array of hashes to search&lt;/p&gt;



### sanitizeArgs

    array deasilworks\API\ActionExecutor::sanitizeArgs($preparedArgs)





* Visibility: **private**


#### Arguments
* $preparedArgs **mixed**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.