<?php

    use Orchestra\Testbench\TestCase;

    /**
     * Class TestBase.
     */
    class TestBase extends TestCase
    {
        /**
         *
         */
        public function setUp()
        {
            parent::setUp();

            $this->resetDatabase();
        }

        /**
         * @param $app
         */
        protected function getEnvironmentSetUp($app)
        {
            $app[ 'path.base' ] = __DIR__.'/..';

            $app[ 'config' ]->set('database.default', 'sqlite');
            $app[ 'config' ]->set('database.connections.sqlite', [
                'driver'   => 'sqlite',
                'database' => ':memory:',
                'prefix'   => '',
            ]);

            $app[ 'config' ]->set('auth.model', 'User');
        }

        /**
         *
         */
        protected function resetDatabase()
        {
            // Relative to the testbench app folder: vendors/orchestra/testbench/src/fixture
            $migrationsPath = 'tests/migrations';
            $artisan = $this->app->make('Illuminate\Contracts\Console\Kernel');

            // Migrate
            $artisan->call('migrate', [
                '--database' => 'sqlite',
                '--path'     => $migrationsPath,
            ]);
        }
    }
