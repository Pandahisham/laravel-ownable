<?php

    namespace Tshafer\Ownable\Contract;

    use Illuminate\Database\Eloquent\Model;

    interface Ownable
    {

        /**
         * Getter for owner
         *
         * @return mixed
         */
        public function getOwner();

        /**
         * Changes owner of the model
         *
         * @param Model $owner
         */
        public function changeOwnerTo( Model $owner );

        /**
         * Associates owner
         *
         * @param mixed $owner
         *
         * @return mixed
         */
        public function associateOwner( Model $owner );

        /**
         * Dissociates owner
         *
         * @return mixed
         */
        public function dissociateOwner();

    }