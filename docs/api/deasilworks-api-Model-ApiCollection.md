deasilworks\api\Model\ApiCollection
===============

Class ApiCollection.

Stores a collection.


* Class name: ApiCollection
* Namespace: deasilworks\api\Model
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

    array deasilworks\api\Model\ApiCollection::getCollection()





* Visibility: **public**




### setCollection

    \deasilworks\api\Model\Collection deasilworks\api\Model\ApiCollection::setCollection(array $collection)





* Visibility: **public**


#### Arguments
* $collection **array**



### current

    mixed deasilworks\api\Model\ApiCollection::current()

Iterator.



* Visibility: **public**




### next

    mixed deasilworks\api\Model\ApiCollection::next()

Iterator next.



* Visibility: **public**




### key

    integer deasilworks\api\Model\ApiCollection::key()

Iterator key.



* Visibility: **public**




### valid

    boolean deasilworks\api\Model\ApiCollection::valid()

Iterator valid.



* Visibility: **public**




### rewind

    mixed deasilworks\api\Model\ApiCollection::rewind()

Iterator rewind.



* Visibility: **public**




### offsetExists

    boolean deasilworks\api\Model\ApiCollection::offsetExists(mixed $offset)

ArrayAccess Offset Exists.



* Visibility: **public**


#### Arguments
* $offset **mixed**



### offsetGet

    mixed|null deasilworks\api\Model\ApiCollection::offsetGet(mixed $offset)

ArrayAccess Offset Get.



* Visibility: **public**


#### Arguments
* $offset **mixed**



### offsetSet

    mixed deasilworks\api\Model\ApiCollection::offsetSet(mixed $offset, \deasilworks\api\Model\ParamModel $argModel)

ArrayAccess Offset Set.



* Visibility: **public**


#### Arguments
* $offset **mixed**
* $argModel **[deasilworks\api\Model\ParamModel](deasilworks-api-Model-ParamModel.md)**



### offsetUnset

    mixed deasilworks\api\Model\ApiCollection::offsetUnset(mixed $offset)

ArrayAccess Offset Unset.



* Visibility: **public**


#### Arguments
* $offset **mixed**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.