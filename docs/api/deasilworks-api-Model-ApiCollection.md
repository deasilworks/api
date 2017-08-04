deasilworks\API\Model\ApiCollection
===============

Class ApiCollection.

Stores a collection.


* Class name: ApiCollection
* Namespace: deasilworks\API\Model
* This class implements: Iterator, ArrayAccess




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


### getCollection

    array deasilworks\API\Model\ApiCollection::getCollection()





* Visibility: **public**




### setCollection

    \deasilworks\API\Model\Collection deasilworks\API\Model\ApiCollection::setCollection(array $collection)





* Visibility: **public**


#### Arguments
* $collection **array**



### current

    mixed deasilworks\API\Model\ApiCollection::current()

Iterator.



* Visibility: **public**




### next

    mixed deasilworks\API\Model\ApiCollection::next()

Iterator next.



* Visibility: **public**




### key

    integer deasilworks\API\Model\ApiCollection::key()

Iterator key.



* Visibility: **public**




### valid

    boolean deasilworks\API\Model\ApiCollection::valid()

Iterator valid.



* Visibility: **public**




### rewind

    mixed deasilworks\API\Model\ApiCollection::rewind()

Iterator rewind.



* Visibility: **public**




### offsetExists

    boolean deasilworks\API\Model\ApiCollection::offsetExists(mixed $offset)

ArrayAccess Offset Exists.



* Visibility: **public**


#### Arguments
* $offset **mixed**



### offsetGet

    mixed|null deasilworks\API\Model\ApiCollection::offsetGet(mixed $offset)

ArrayAccess Offset Get.



* Visibility: **public**


#### Arguments
* $offset **mixed**



### offsetSet

    mixed deasilworks\API\Model\ApiCollection::offsetSet(mixed $offset, \deasilworks\API\Model\ParamModel $argModel)

ArrayAccess Offset Set.



* Visibility: **public**


#### Arguments
* $offset **mixed**
* $argModel **[deasilworks\API\Model\ParamModel](deasilworks-API-Model-ParamModel.md)**



### offsetUnset

    mixed deasilworks\API\Model\ApiCollection::offsetUnset(mixed $offset)

ArrayAccess Offset Unset.



* Visibility: **public**


#### Arguments
* $offset **mixed**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.