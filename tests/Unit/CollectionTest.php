<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Exception;

class CollectionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisCollection = new \App\Collections;
        try {
            $collectionNames = $thisCollection->getCollectionNames('rcatalog');
            $this->assertTrue(count($thisCollection)>0);
        } catch (Exception $e) {
            echo($e);
            $this->assertTrue(false);
        }
        $this->assertTrue($collectionNames[1][1]=='Spring Catalog');
        try {
            $collectionId = $thisCollection->addCollection('Fake Glory', 'fglory', 'Zirconimu rings for sale', 1, 'open', 2);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $newCollection = $thisCollection->getCollectionById($collectionId);
        $this->assertTrue(count($newCollection)>0);
        try {
            $thisCollection->removeCollection($collectionId);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $newCollection = $thisCollection->getCollectionById($collectionId);
        $this->assertTrue(count($newCollection)==0);
        $companyCollections = $thisCollection->getCollectionsByCompanyId(2);
        $this->assertTrue(count($companyCollections)>0);
        try {
            $thisCollection->editCollection(3, 'Laurel\'s Spring Collection', 'lscollect', 'Spring accesories from Laurel Denise', 1, 'open', [2]);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }

    }
}
