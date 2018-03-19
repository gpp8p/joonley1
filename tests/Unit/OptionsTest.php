<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OptionsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisOptions = new \App\Options;
        $allOptionTypes = $thisOptions->getAllOptionTypes();
        $this->assertTrue($allOptionTypes[0]->name=="Color");
        $allOptions = $thisOptions->getOptionsBySlug('size');
        $this->assertTrue($allOptions[1]->specification == 'medium');
        $allOptions = $thisOptions->getOptionsByOptionTypeId(2);
        $this->assertTrue($allOptions[1]->specification == 'medium');
        try {
            $thisOptions->addOption('huge', 'size');
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        try {
            $recordsDeleted = $thisOptions->removeOption('huge', 'size');
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $this->assertTrue($recordsDeleted>0);



    }
}
