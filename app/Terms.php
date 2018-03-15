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
        $query = "select terms.id, terms.specification from terms, termstype where termstype_id = termstype.id and termstype.slug=?";
        $termsFound = DB::select($query, [$termsTypeSlug]);
        return $termsFound;
    }

    public function addTerm($specification, $termsTypeId, $productId)
    {


    }
}
