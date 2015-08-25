<?php

    /**
     * Class OwnableTest
     */
    class OwnableTest extends TestBase
    {

        /**
         * @var null
         */
        protected $ownable = null;

        /**
         *
         */
        public function setUp()
        {
            parent::setUp();

            $this->createOwners();
        }

        /**
         *
         */
        protected function createOwners()
        {
            Owner::create( [ 'idnum' => 1, 'email' => 'john@doe.com' ] );
            Owner::create( [ 'idnum' => 2, 'email' => 'jane@doe.com' ] );
        }

        /**
         * @return null
         */
        protected function getOwnable()
        {
            if (is_null( $this->ownable )) {
                $this->ownable = OwnableItem::create( [ ] );
            }

            return $this->ownable;
        }

        /** @test */
        function it_returns_owner()
        {
            $ownable = OwnableItem::create( [ 'owner_id' => 1 ] );

            $this->assertEquals(
                $ownable->getOwner(),
                Owner::find( 1 )
            );
        }

        /** @test */
        function it_associates_owner()
        {
            $ownable = $this->getOwnable();

            $this->assertNull( $ownable->getOwner() );

            $john = Owner::find( 1 );

            $ownable->associateOwner( $john );

            $this->assertEquals(
                $ownable->getOwner(),
                $john
            );
        }

        /** @test */
        function it_dissociates_owner()
        {
            $ownable = OwnableItem::create( [ 'owner_id' => 1 ] );

            $this->assertEquals(
                $ownable->getOwner(),
                Owner::find( 1 )
            );

            $ownable->dissociateOwner();

            $this->assertNull( $ownable->getOwner() );
        }

        /** @test */
        function it_changes_owner()
        {
            $ownable = $this->getOwnable();
            $john    = Owner::find( 1 );
            $jane    = Owner::find( 2 );

            $this->assertNull( $ownable->getOwner() );

            $ownable->changeOwnerTo( $john );
            $this->assertEquals( $ownable->getOwner(), $john );

            $ownable->changeOwnerTo( $jane );
            $this->assertEquals( $ownable->getOwner(), $jane );
        }

        /** @test */
        function it_removes_owner()
        {
            $ownable = OwnableItem::create( [ 'owner_id' => 1 ] );

            $ownable->abandonOwner();

            $this->assertNull( $ownable->getOwner() );
        }

    }