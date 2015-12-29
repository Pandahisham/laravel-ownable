<?php

    use Illuminate\Database\Eloquent\Model;

    /**
     * Class Owner.
     */
    class Owner extends Model
    {
        /**
         * @var array
         */
        protected $fillable = ['email'];

        /**
         * @var string
         */
        protected $primaryKey = 'idnum';
    }
