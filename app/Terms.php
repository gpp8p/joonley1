<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;


class Terms extends Model
{
    public function getTermsTypes()
    {
        $query = "select id, name from termstype";

        $typesFound = DB::select($query);
        return $typesFound;
    }

    public function getTerms($termsTypeSlug)
    {
        $query = "select terms.id, terms.specification, terms.slug from terms, termstype where termstype_id = termstype.id and termstype.slug=?";
        $termsFound = DB::select($query, [$termsTypeSlug]);
        return $termsFound;
    }

    public function addTerm($specification, $termsTypeId, $slug)
    {
        try {
            $newTermId = DB::table('terms')->insertGetId([
                'specification' => $specification,
                'termstype_id' => $termsTypeId,
                'slug'=>$slug,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } catch (Exception $e) {
            throw new Exception('Term insert failed because'.$e->getMessage());
        }
        return $newTermId;
    }

    public function removeTerm($termId)
    {
        $termToDelete = DB::table('terms')->where('id', $termId)->first();
        if(DB::table('defaultterms')->where('terms_id', $termToDelete->id)->exists())
        {
            throw new Exception($termToDelete->specification.' has existing default associations - cannopt be deleted');
        }
        if(DB::table('hasterms')->where('terms_id', $termToDelete->id)->exists())
        {
            throw new Exception($termToDelete->specification.' has existing product associations - cannopt be deleted');
        }
        if(DB::table('orderterms')->where('terms_id', $termToDelete->id)->exists())
        {
            throw new Exception($termToDelete->specification.' has existing order associations - cannopt be deleted');
        }
        $nrd = DB::table('terms')->where('id', '=', $termId)->delete();
        return $nrd;


    }

    public function addDefaultTerms($companyId, $termsId)
    {
        if(DB::table('defaultterms')
            ->where('terms_id', $termsId)
            ->where('company_id', $companyId)->exists())
        {
            throw new Exception('That default term already exists'.$companyId.'-'. $termsId);
        }
        try {
            $newDefaultTerms = DB::table('defaultterms')->insertGetId([
                'terms_id' => $termsId,
                'company_id' => $companyId,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } catch (Exception $e) {
            throw new Exception('New default terms failed because: '.$e->getMessage());
        }
    }

    public function removeDefaultTerms($companyId, $termsId)
    {
        if(!DB::table('defaultterms')
            ->where('terms_id', $termsId)
            ->where('company_id', $companyId)->exists())
        {
            throw new Exception('That default terms does not exist:'.$companyId.'-'. $termsId);
        }
        try {
            $nrd = DB::table('defaultterms')
                ->where('terms_id', $termsId)
                ->where('company_id', $companyId)->delete();
        } catch (Exception $e) {
            throw new Exception('Default terms record could not be deleted because:'.$e->getMessage());
        }
        return $nrd;
    }

    public function addHasTerms($productId, $termsId)
    {
        if(DB::table('hasterms')
            ->where('terms_id', $termsId)
            ->where('product_id', $productId)->exists())
        {
            throw new Exception('That product term already exists'.$productId.'-'. $termsId);
        }
        try {
            $newDefaultTerms = DB::table('hasterms')->insertGetId([
                'terms_id' => $termsId,
                'product_id' => $productId,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } catch (Exception $e) {
            throw new Exception('New product terms failed because: '.$e->getMessage());
        }
        return $newDefaultTerms;
    }

    public function removeHasTerms($productId, $termsId)
    {
        if(!DB::table('hasterms')
            ->where('terms_id', $termsId)
            ->where('product_id', $productId)->exists())
        {
            throw new Exception('That product terms does not exist:'.$productId.'-'. $termsId);
        }
        try {
            $nrd = DB::table('hasterms')
                ->where('terms_id', $termsId)
                ->where('product_id', $productId)->delete();
        } catch (Exception $e) {
            throw new Exception('Product terms record could not be deleted because:'.$e->getMessage());
        }
        return $nrd;
    }
    public function getTermsForProductId($productId)
    {
        $query ='select terms.specification as specification, terms.slug as slug, termstype.name as type from terms, hasterms, termstype '.
        'where terms.id = hasterms.terms_id '.
        'and terms.termstype_id = termstype.id '.
        'and hasterms.product_id = ?';

        $termsFound = DB::select($query, [$productId]);
        return $termsFound;

    }

    public function addDefaultTermsToProduct($companyId, $productId)
    {
        $termsToAdd = DB::table('defaultterms')
            ->where('company_id', $companyId)->get();
        DB::beginTransaction();
        $numberOfTermsAdded=0;
        try {
            foreach ($termsToAdd as $thisTermToAdd) {
                $this->addHasTerms($productId, $thisTermToAdd->terms_id);
                $numberOfTermsAdded++;
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Adding of default terms to product failed:'.$e->getMessage());
        }
        DB::commit();
        return $numberOfTermsAdded;
    }

}
