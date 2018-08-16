<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CombinedFeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $retailShopType = DB::table('companytype')->where('slug', 'rshop')->first();
        $medialinkReference = DB::table('medialink')->where('url','http://nomedia/nomedia.jpg')->first()->id;
//buyers
        $thisNewLocationGroupId = DB::table('locations')->insertGetId([
        'name' => 'East Coast',
        'created_at'=>\Carbon\Carbon::now(),
        'updated_at'=>\Carbon\Carbon::now(),
        ]);
        $eastCoast = $thisNewLocationGroupId;

        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Trink-Shop',
            'website'=> 'www.trinkshop.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('compcanbe')->insert([
            'ctype_id'=>$retailShopType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Bracelets Unlimited',
            'website'=> 'www.bracelets.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('compcanbe')->insert([
            'ctype_id'=>$retailShopType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Chains and Things',
            'website'=> 'www.chains.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('compcanbe')->insert([
            'ctype_id'=>$retailShopType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $thisNewLocationGroupId = DB::table('locations')->insertGetId([
            'name' => 'Virginia',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Fashionable Skirts',
            'website'=> 'www.skirts.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$eastCoast,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        DB::table('compcanbe')->insert([
            'ctype_id'=>$retailShopType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'The Little Dress Shop',
            'website'=> 'www.dressshop.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$eastCoast,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('compcanbe')->insert([
            'ctype_id'=>$retailShopType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $thisNewLocationGroupId = DB::table('locations')->insertGetId([
            'name' => 'DC Shops',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Heavy Leather',
            'website'=> 'www.heavyleather.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$eastCoast,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('compcanbe')->insert([
            'ctype_id'=>$retailShopType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Hides and Seek',
            'website'=> 'www.hides.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$eastCoast,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('compcanbe')->insert([
            'ctype_id'=>$retailShopType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
// sellers
        $containedAs = DB::table('containedas')->where('slug', 'issale')->first();
        $craftProducerType = DB::table('companytype')->where('slug', 'cprod')->first();
        $collectionType = DB::table('collectiontype')->where('slug', 'rcatalog')->first();

        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'The Trinket Factory',
            'website'=> 'www.trinkfactory.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$eastCoast,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$eastCoast,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('compcanbe')->insert([
            'ctype_id'=>$craftProducerType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Trinket Collection',
            'description'=>'Collection of trinkets from the Trinket Factory',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Main Catalog',
            'description'=>'Primary Product Catalog',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);



        $productType = DB::table('nested_category')->where('name', 'Chains')->first();
        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Gold Chain',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Solid Gold Chain',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Silver Chain',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Solid Silver Chain',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'The Bracelet Factory',
            'website'=> 'www.braceletfactory.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$eastCoast,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$eastCoast,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('compcanbe')->insert([
            'ctype_id'=>$craftProducerType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Bracelet Collection',
            'description'=>'Collection of bracelets from the Bracelet Factory',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Main Catalog',
            'description'=>'Primary Product Catalog',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $productType = DB::table('nested_category')->where('name', 'Bracelets')->first();
        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Small Bracelet',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'small bracelet',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $productType = DB::table('nested_category')->where('name', 'Silver Bracelets')->first();
        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Large Silver Bracelet',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'lafrge bracelet',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisNewLocationGroupId = DB::table('locations')->insertGetId([
            'name' => 'West Coast',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        $productType = DB::table('nested_category')->where('name', 'Rings')->first();
        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'The Ring Factory',
            'website'=> 'www.ringfactory.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('compcanbe')->insert([
            'ctype_id'=>$craftProducerType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Big Ring Collection',
            'description'=>'Collection of rings from the Ring Factory',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Main Catalog',
            'description'=>'Primary Product Catalog',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Gold Ring',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Gold Ring',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Silver Ring',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Silver Ring',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);




        $productType = DB::table('nested_category')->where('name', 'Blouses')->first();

        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Dress Makers Unlimited',
            'website'=> 'www.dressmakers.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('compcanbe')->insert([
            'ctype_id'=>$craftProducerType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Dress Collection',
            'description'=>'Collection of dresses from the Dress Factory',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Main Catalog',
            'description'=>'Primary Product Catalog',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Large Blouse',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'BVl,ouse - large',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Small Blouse',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Bloouse - small',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Tropical Dresses',
            'website'=> 'www.tropicaldresses.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('compcanbe')->insert([
            'ctype_id'=>$craftProducerType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Tropical Dress Collection',
            'description'=>'Collection of tropical dresses from Tropical Dresses',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Main Catalog',
            'description'=>'Primary Product Catalog',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Tropical Blouse with frills',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Tropical with frills',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Tropical Blouse without frills',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Tropical without frills',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Undress Inc.',
            'website'=> 'www.undress.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('compcanbe')->insert([
            'ctype_id'=>$craftProducerType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Undress Collection',
            'description'=>'Collection of dresses from Undress',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Main Catalog',
            'description'=>'Primary Product Catalog',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);



        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Work Blouses',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'work blouse',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Play Blouses',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'play blouse',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $productType = DB::table('nested_category')->where('name', 'Leather Purses')->first();

        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Leather Lather',
            'website'=> 'www.leatherlather.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('compcanbe')->insert([
            'ctype_id'=>$craftProducerType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Lather Collection',
            'description'=>'Collection of lather from Leather Lather',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'Main Catalog',
            'description'=>'Primary Product Catalog',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Large Lather',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'large lather',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Small Lather',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'small lather',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);



        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Much More Leather',
            'website'=> 'www.moreleather.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisNewLocationGroupId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisNewLocationGroupId,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('compcanbe')->insert([
            'ctype_id'=>$craftProducerType->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCollection = DB::table('collection')->insertGetId([
            'name'=>    'More Leather Collection',
            'description'=>'Collection of leather from Much More Leather',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompanyHasCollection = DB::table('hascollection')->insertGetId([
            'company_id'=>$newCompanyId,
            'collection_id'=>$thisCollection,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        
        
        
        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Large Purse',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'large purce',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisProduct = DB::table('product')->insertGetId([
            'name'=>'Small Purse',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'small purse',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('producthaslinks')->insert([
            'product_id'=>$thisProduct,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collectionhas')->insert([
            'product_id'=>$thisProduct,
            'collection_id'=>$thisCollection,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);




    }
}
