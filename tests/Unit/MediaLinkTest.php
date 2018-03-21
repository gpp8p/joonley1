<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;

class MediaLinkTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisMediaLink = new \App\MediaLink;
        $type = DB::table('mediatype')->where('slug', 'image')->first();
        try {
            $newMediaLinkId = $thisMediaLink->addMediaLink($type, 'product', 'http://newmedialink.com');
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        try {
            $linkRecordsDeleted = $thisMediaLink->removeMediaLink($newMediaLinkId);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $this->assertTrue($linkRecordsDeleted>0);
    }
}
