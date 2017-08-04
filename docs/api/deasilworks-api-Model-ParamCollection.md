deasilworks\API\Model\ParamCollection
===============

Class ParamCollection.

Stores a collection.


* Class name: ParamCollection
* Namespace: deasilworks\API\Model
* Parent class: [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)





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

    mixed deasilworks\API\Model\ParamCollection::addModel(\deasilworks\API\Model\ParamModel $paramModel)





* Visibility: **public**


#### Arguments
* $paramModel **[deasilworks\API\Model\ParamModel](deasilworks-API-Model-ParamModel.md)**



### getCollection

    array deasilworks\API\Model\ApiCollection::getCollection()





* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)




### setCollection

    \deasilworks\API\Model\Collection deasilworks\API\Model\ApiCollection::setCollection(array $collection)





* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)


#### Arguments
* $collection **array**



### current

    mixed deasilworks\API\Model\ApiCollection::current()

Iterator.



* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)




### next

    mixed deasilworks\API\Model\ApiCollection::next()

Iterator next.



* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)




### key

    integer deasilworks\API\Model\ApiCollection::key()

Iterator key.



* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)




### valid

    boolean deasilworks\API\Model\ApiCollection::valid()

Iterator valid.



* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)




### rewind

    mixed deasilworks\API\Model\ApiCollection::rewind()

Iterator rewind.



* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)




### offsetExists

    boolean deasilworks\API\Model\ApiCollection::offsetExists(mixed $offset)

ArrayAccess Offset Exists.



* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)


#### Arguments
* $offset **mixed**



### offsetGet

    mixed|null deasilworks\API\Model\ApiCollection::offsetGet(mixed $offset)

ArrayAccess Offset Get.



* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)


#### Arguments
* $offset **mixed**



### offsetSet

    mixed deasilworks\API\Model\ApiCollection::offsetSet(mixed $offset, \deasilworks\API\Model\ParamModel $argModel)

ArrayAccess Offset Set.



* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)


#### Arguments
* $offset **mixed**
* $argModel **[deasilworks\API\Model\ParamModel](deasilworks-API-Model-ParamModel.md)**



### offsetUnset

    mixed deasilworks\API\Model\ApiCollection::offsetUnset(mixed $offset)

ArrayAccess Offset Unset.



* Visibility: **public**
* This method is defined by [deasilworks\API\Model\ApiCollection](deasilworks-API-Model-ApiCollection.md)


#### Arguments
* $offset **mixed**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.