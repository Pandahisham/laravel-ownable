# Ownable
Easy ownership for Eloquent Models with Laravel 5.

---
[![Build Status](https://travis-ci.org/kenarkose/Ownable.svg?branch=master)](https://travis-ci.org/kenarkose/Ownable)
[![Total Downloads](https://poser.pugx.org/kenarkose/Ownable/downloads)](https://packagist.org/packages/kenarkose/Ownable)
[![Latest Stable Version](https://poser.pugx.org/kenarkose/Ownable/version)](https://packagist.org/packages/kenarkose/Ownable)
[![License](https://poser.pugx.org/kenarkose/Ownable/license)](https://packagist.org/packages/kenarkose/Ownable)

Ownable provides a simple solution for associating owners (most likely User models) to individual models.

## Features
- Compatible with Laravel 5.0 and 5.1
- Configurable
- Auto associating the authorized user by Laravel on creation as owner
- Changing owners
- Eloquent relationships
- A [phpunit](http://www.phpunit.de) test suite for easy development

## Installation
Installing Ownable is simple. Just pull the package in through [Composer](https://getcomposer.org).
```js
{
    "require": {
        "kenarkose/ownable": "1.1.*"
    }
}
```

## Usage
Just add the traits to the model which you want to become ownable and customize if neccessary.
```php
use Illuminate\Database\Eloquent\Model;
use Kenarkose\Ownable\AutoAssociatesOwner;
use Kenarkose\Ownable\Ownable;
use Kenarkose\Ownable\Contract\Ownable as OwnableContract;

class OwnableItem extends Model implements OwnableContract {
    
    use Ownable, AutoAssociatesOwner;
    
}

$ownable = OwnableItem::find();

// You may access owner like so:
$owner = $ownable->getOwner();

// or, you may use the Eloquent relation and dynamic property:
$owner = $ownable->owner;
$ownerRelation = $ownable->owner();


$ownable = new OwnableItem;

// You may change and remove owner and persist like so:
$ownable->changeOwnerTo($owner);
$ownable->abandonOwner();

// or, if you would like to do these without saving the model you can use:
$ownable->associateOwner($owner);
$ownable->dissociateOwner();
```
The AutoAssociatesOwner trait is optional and should be used if auto association of logged in user on model creation is desired.
In other words, if the trait is used, the model will associate the logged in user as the owner.

## Customization
You may customize individual models that use the Ownable and AutoAssocicatesOwner traits by adding relevant attributes. The default configuration are as listed below.
```php
protected $ownerModel = 'App\User';
protected $ownerKey = 'user_id';
protected $ownerParentKey = 'id';
```

All of these attributes are optional and they fallback to defaults if not set.

Finally, if you would like to change the default auto association behaviour, you may do so by overriding the `associateDefaultOwner` method.
```php
use Illuminate\Database\Eloquent\Model;
use Kenarkose\Ownable\Ownable;
use Kenarkose\Ownable\AutoAssociatesOwner;
use Kenarkose\Ownable\Contract\Ownable as OwnableContract;

class OwnableItem extends Model implements OwnableContract {
    
    use Ownable, AutoAssociatesOwner;
    
    public function associateDefaultOwner()
    {
        // Some other logic
    }
}
```

## License
Ownable is released under [MIT License](https://github.com/kenarkose/Ownable/blob/master/LICENSE).