<?php

    use Illuminate\Database\Eloquent\Model;
    use Tshafer\Ownable\AutoAssociatesOwner;
    use Tshafer\Ownable\Contract\Ownable as OwnableContract;
    use Tshafer\Ownable\Ownable;

    /**
     * Class AssociatableItem
     */
    class AssociatableItem extends Model implements OwnableContract
    {

        use Ownable, AutoAssociatesOwner;
    }