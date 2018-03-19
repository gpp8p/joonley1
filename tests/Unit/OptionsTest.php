<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;


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
        // tests duplicate catch
        try {
            $thisOptions->addOption('huge', 'size');
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
        // tests delete
        try {
            $recordsDeleted = $thisOptions->removeOption('huge', 'size');
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $this->assertTrue($recordsDeleted>0);
        // tests bad optiontype catch
        try {
            $recordsDeleted = $thisOptions->removeOption('huge', 'baloney');
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
        $thisProductType = DB::table('producttype')->where('name','Chains')->get();
        try {
            $thisDefaultOptionId = $thisOptions->addDefaultOption($allOptions[1], $thisProductType[0]);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }




    }
}
