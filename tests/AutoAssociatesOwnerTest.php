<?php

    use Illuminate\Support\Facades\Auth;

    /**
     * Class AutoAssociatesOwnerTest
     */
    class AutoAssociatesOwnerTest extends TestBase
    {

        /**
         *
         */
        public function setUp()
        {
            parent::setUp();

            $this->createUsers();
        }

        /**
         *
         */
        protected function createUsers()
        {
            User::create( [ 'id' => 1, 'email' => 'john@doe.com' ] );
        }

        /** @test */
        function it_associates_logged_in_user_on_create()
        {
            // Log a user in
            $user = User::find( 1 );
            Auth::login( $user );

            $associatable2 = AssociatableItem::create( [ ] );
            $this->assertEquals( $associatable2->owner, $user );
        }

    }