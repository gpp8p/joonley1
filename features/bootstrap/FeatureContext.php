<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }
    /**
     * @BeforeSuite
     */
    public static function prepare(SuiteEvent $event)
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');

    }

    /**
     * @AfterSuite
     */
    public static function cleanup(ScenarioEvent $event)
    {
        Artisan::call('migrate:rollback');
    }
}