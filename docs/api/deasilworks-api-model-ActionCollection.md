deasilworks\api\Model\ActionCollection
===============

Class ActionCollection.

Stores a collection.


* Class name: ActionCollection
* Namespace: deasilworks\api\Model
* Parent class: [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)





Properties
----------


### $position

    private integer $position





* Visibility: **private**


### $indexedContainer

    protected array $indexedContainer = array()





* Visibility: **protected**


### $hashedContainer

    protected array $hashedContainer = array()





* Visibility: **protected**


Methods
-------


### addModel

    mixed deasilworks\api\Model\ActionCollection::addModel(\deasilworks\api\Model\Action\ActionModel $actionModel)





* Visibility: **public**


#### Arguments
* $actionModel **[deasilworks\api\Model\Action\ActionModel](deasilworks-api-Model-Action-ActionModel.md)**



### getCollection

    array deasilworks\api\Model\ApiCollection::getCollection()





* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)




### setCollection

    \deasilworks\api\Model\Collection deasilworks\api\Model\ApiCollection::setCollection(array $collection)





* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)


#### Arguments
* $collection **array**



### current

    mixed deasilworks\api\Model\ApiCollection::current()

Iterator.



* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)




### next

    mixed deasilworks\api\Model\ApiCollection::next()

Iterator next.



* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)




### key

    integer deasilworks\api\Model\ApiCollection::key()

Iterator key.



* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)




### valid

    boolean deasilworks\api\Model\ApiCollection::valid()

Iterator valid.



* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)




### rewind

    mixed deasilworks\api\Model\ApiCollection::rewind()

Iterator rewind.



* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)




### offsetExists

    boolean deasilworks\api\Model\ApiCollection::offsetExists(mixed $offset)

ArrayAccess Offset Exists.



* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)


#### Arguments
* $offset **mixed**



### offsetGet

    mixed|null deasilworks\api\Model\ApiCollection::offsetGet(mixed $offset)

ArrayAccess Offset Get.



* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)


#### Arguments
* $offset **mixed**



### offsetSet

    mixed deasilworks\api\Model\ApiCollection::offsetSet(mixed $offset, \deasilworks\api\Model\ParamModel $argModel)

ArrayAccess Offset Set.



* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)


#### Arguments
* $offset **mixed**
* $argModel **[deasilworks\api\Model\ParamModel](deasilworks-api-Model-ParamModel.md)**



### offsetUnset

    mixed deasilworks\api\Model\ApiCollection::offsetUnset(mixed $offset)

ArrayAccess Offset Unset.



* Visibility: **public**
* This method is defined by [deasilworks\api\Model\ApiCollection](deasilworks-api-Model-ApiCollection.md)


#### Arguments
* $offset **mixed**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.