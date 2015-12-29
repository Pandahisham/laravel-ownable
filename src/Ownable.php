<?php

namespace Tshafer\Ownable;

use Illuminate\Database\Eloquent\Model;

    /**
     * Class Ownable.
     */
    trait Ownable
    {
        /**
         * Owner of the model.
         *
         * @return mixed
         */
        public function owner()
        {
            return $this->belongsTo(
                $this->getOwnerModelName(),
                $this->getOwnerKey(),
                $this->getOwnerParentKey()
            );
        }

        /**
         * Getter for owner.
         *
         * @return mixed
         */
        public function getOwner()
        {
            return $this->owner;
        }

        /**
         * Returns the name for owner model.
         *
         * @return string
         */
        protected function getOwnerModelName()
        {
            return $this->ownerModel ?: config('auth.model');
        }

        /**
         * Returns the owner key.
         *
         * @return string
         */
        protected function getOwnerKey()
        {
            return $this->ownerKey ?: 'user_id';
        }

        /**
         * Returns the owner key.
         *
         * @return string
         */
        protected function getOwnerParentKey()
        {
            return $this->ownerParentKey ?: 'id';
        }

        /**
         * Changes owner of the model.
         *
         * @param Model $owner
         */
        public function changeOwnerTo(Model $owner)
        {
            $this->associateOwner($owner);

            $this->save();
        }

        /**
         * Abandons owner of the model.
         */
        public function abandonOwner()
        {
            $this->dissociateOwner();

            $this->save();
        }

        /**
         * Associates owner.
         *
         * @param Model $owner
         *
         * @return Model
         */
        public function associateOwner(Model $owner)
        {
            return $this->owner()->associate($owner);
        }

        /**
         * Dissociates owner.
         *
         * @return Model
         */
        public function dissociateOwner()
        {
            return $this->owner()->dissociate();
        }
    }
