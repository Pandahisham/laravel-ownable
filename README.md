# Ownable
Easy ownership for Eloquent Models with Laravel 5.


Ownable provides a simple solution for associating owners (most likely User models) to individual models.


## Installation
```php
composer require tshafer/laravel-ownable
   
```

## Usage
Just add the traits to the model which you want to become ownable and customize if neccessary.
```php
use Illuminate\Database\Eloquent\Model;
use Tshafer\Ownable\AutoAssociatesOwner;
use Tshafer\Ownable\Ownable;
use Tshafer\Ownable\Contract\Ownable as OwnableContract;

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
use Tshafer\Ownable\Ownable;
use Tshafer\Ownable\AutoAssociatesOwner;
use Tshafer\Ownable\Contract\Ownable as OwnableContract;

class OwnableItem extends Model implements OwnableContract {
    
    use Ownable, AutoAssociatesOwner;
    
    public function associateDefaultOwner()
    {
        // Some other logic
    }
}
```