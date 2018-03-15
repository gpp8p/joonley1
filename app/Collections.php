<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Collections extends Model
{
    protected $table = 'collection';

    public function getCollectionNames($collectionTypeSlug)
    {
        $query = 'select collection.id, collection.name from collection, collectiontype where collection.type_id = collectiontype.id and collectiontype.slug = ?';
        $thisCollections = DB::select($query, [$collectionTypeSlug]);
        if(count($thisCollections)==0)
        {
            throw new Exception('nothing found for that type');
        }else{
            $names = array();
            foreach($thisCollections as $tc)
            {
                $names[] = [$tc->id, $tc->name];
            }
            return $names;
        }

    }

    public function addCollection($collectionName, $collectionSlug,$collectionDescription,$collectionType,$collectionStatus, $collectionCompany)
    {
        try {
            DB::beginTransaction();
            $newCollectionId = DB::table('collection')->insertGetId([
                'name' => $collectionName,
                'slug' => $collectionSlug,
                'description' => $collectionDescription,
                'type_id' => $collectionType,
                'status' => $collectionStatus,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ]);
            DB::table('hascollection')->insert([
                'collection_id'=>$newCollectionId,
                'company_id'=>$collectionCompany,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('New collection failed');
        }
        return $newCollectionId;
    }
    public function getCollectionById($collectionId)
    {
        $thisCollection = DB::table('collection')->where('id', '=', $collectionId)->get();
        return $thisCollection;
    }


    public function removeCollection($collectionId)
    {
        try {
            DB::beginTransaction();
            $nrd = DB::table('collection')->where('id', '=', $collectionId)->delete();
            if ($nrd == 0) {
                throw new Exception('Nothing deleted');
            } else {
                $nrd = DB::table('hascollection')->where('collection_id', '=', $collectionId)->delete();
                if ($nrd == 0) {
                    throw new Exception('No company link records deleted');
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Remove collection failed');
        }
    }

    public function getCollectionsByCompanyId($companyId)
    {
        $query = 'select collection.name as collection, collection.id as collection_id, collection.description as description, collection.status as status '.
                'from company, hascollection, collection '.
                'where hascollection.company_id = company.id '.
                'and hascollection.collection_id = collection.id '.
                'and company.id = ? ';



        $theseCollections = DB::select($query, [$companyId]);
        return $theseCollections;
    }
    public function editCollection($collectionId,$collectionName, $collectionSlug,$collectionDescription,$collectionType,$collectionStatus, $collectionCompanys)
    {

        try {
            DB::beginTransaction();
            try {
                $thisCollection = DB::table('collection')->where('id', '=', $collectionId)->get();
            } catch (Exception $e) {
                throw new Exception("Collection with Id = " . $collectionId . "not found");
            }
            if ($thisCollection[0]->name != $collectionName) {
                $newCollectionName = $collectionName;
            } else {
                $newCollectionName = $thisCollection[0]->name;
            }
            if ($thisCollection[0]->slug != $collectionSlug) {
                $newCollectionSlug = $collectionSlug;
            } else {
                $newCollectionSlug = $thisCollection[0]->slug;
            }
            if ($thisCollection[0]->description != $collectionDescription) {
                $newCollectionDescription = $collectionDescription;
            } else {
                $newCollectionDescription = $thisCollection[0]->description;
            }
            if ($thisCollection[0]->name != $collectionName) {
                $newCollectionName = $collectionName;
            } else {
                $newCollectionName = $thisCollection[0]->name;
            }
            if ($thisCollection[0]->type_id != $collectionType) {
                $newCollectionType = $collectionType;
            } else {
                $newCollectionType = $thisCollection[0]->type_id;
            }
            if ($thisCollection[0]->status != $collectionStatus) {
                $newCollectionStatus = $collectionStatus;
            } else {
                $newCollectionStatus = $thisCollection[0]->status;
            }
            DB::table('collection')->where('id', $collectionId)->update([
                'name' => $newCollectionName,
                'slug' => $newCollectionSlug,
                'description' => $newCollectionDescription,
                'type_id' => $newCollectionType,
                'status' => $newCollectionStatus,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            $hasCollectionQuery = "select company_id from hascollection where collection_id = ?";
            $cls = DB::select($hasCollectionQuery, [$collectionId]);

            $existingCompanyIds = array();
            foreach ($cls as $cl) {
                $thisCompanyId = $cl->company_id;
                $existingCompanyIds[] = $thisCompanyId;
            }
            foreach ($collectionCompanys as $cm) {
                if (!in_array($cm, $existingCompanyIds)) {
                    DB::table('hascollection')->insert([
                        'company_id' => $cm,
                        'collection_id' => $collectionId,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                }
            }
            foreach ($existingCompanyIds as $ec) {
                if (!in_array($ec, $collectionCompanys)) {
                    DB::table('hascollection')->where([
                        ['company_id', '=', $ec],
                        ['collection_id', '=', $collectionId],
                    ])->delete();
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }






    }



}
