<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|
|-------------------------------------------------------------------------
| Initialize proper settings for Codeception acceptance tests
|-------------------------------------------------------------------------
|
| We point the application to the proper .env file, in case the request comes
| from an acceptance test. Log in a user if necessary.
|
*/

// create test helper instance
$testHelper = new \App\Tests\TestHelper($app->basePath('tests'));

// register test helper as singleton
$app->instance(\App\Tests\TestHelper::class, $testHelper);

// set environment
if ($testHelper->isRunner()) {
    $app->loadEnvironmentFrom('.env.testing');
} elseif ($testHelper->isSeleniumRequest()) {
    $app->loadEnvironmentFrom('.env.testingserver');
}

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
