<?php

    use Illuminate\Auth\Authenticatable;
    use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
    use Illuminate\Database\Eloquent\Model;

    /**
     * Class User.
     */
    class User extends Model implements AuthenticatableContract
    {
        use Authenticatable;

        /**
         * @var array
         */
        protected $fillable = ['email'];
    }
