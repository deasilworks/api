deasilworks\API\Hydrator
===============

Class ControllerAction.

Responsible for taking a class based oject and
calling it's setters with matching params from a
standard object.

The purpose of the hydrator is setting properties
of models with setters. Model setters should only
contain one parameter.

Model setters can accept a scaler or type hinted
class. Values for setters without type hints are passed
as compound types or scalers.


* Class name: Hydrator
* Namespace: deasilworks\API



Constants
----------


### PREFIX_ADDER

    const PREFIX_ADDER = 'add'





### PREFIX_SETTER

    const PREFIX_SETTER = 'set'







Methods
-------


### hydrateObject

    object deasilworks\API\Hydrator::hydrateObject(object $targetObject, object|array $payload)

Hydrate Object.

Takes an object and tries to hydrate it with another.

Uses methods prefixed with "set" to set values.

If the payload is an array (hash) it will call a method
prefixed with "add". This is required in order to find
the type hint.

* Visibility: **public**


#### Arguments
* $targetObject **object**
* $payload **object|array**



### hydrateMethod

    mixed deasilworks\API\Hydrator::hydrateMethod($targetObject, $method, $value)

Hydrate Method.

Checks the method signature for a type hint, if
one is found hydrate is called and the result is
sent to the method.

If there is no type hint in the method signature
the value is used without attempting hydration.

* Visibility: **protected**


#### Arguments
* $targetObject **mixed**
* $method **mixed**
* $value **mixed**



### getParameterClassObject

    mixed deasilworks\API\Hydrator::getParameterClassObject($object, $method)

Get Parameter Class Object.

Get the Class of object a method requires.

* Visibility: **public**


#### Arguments
* $object **mixed**
* $method **mixed**



### snakeToPascal

    string deasilworks\API\Hydrator::snakeToPascal($input)

Snake to Pascal.

Converts a_snake_case_string to aPascalCaseString.

* Visibility: **public**


#### Arguments
* $input **mixed**



### prefixer

    string deasilworks\API\Hydrator::prefixer($prefix, $method)

Prefixer.



* Visibility: **private**


#### Arguments
* $prefix **mixed**
* $method **mixed**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.