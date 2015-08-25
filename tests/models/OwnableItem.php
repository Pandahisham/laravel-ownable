<?php

    use Illuminate\Database\Eloquent\Model;
    use Kenarkose\Ownable\Contract\Ownable as OwnableContract;
    use Kenarkose\Ownable\Ownable;

    /**
     * Class OwnableItem
     */
    class OwnableItem extends Model implements OwnableContract
    {

        use Ownable;

        /**
         * @var string
         */
        protected $ownerModel = 'Owner';
        /**
         * @var string
         */
        protected $ownerKey = 'owner_id';
        /**
         * @var string
         */
        protected $ownerParentKey = 'idnum';

        /**
         * @var array
         */
        protected $fillable = [ 'owner_id' ];

    }