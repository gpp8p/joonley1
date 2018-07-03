<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRoleSeeder::class);
//        $this->call(RolesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CompanyTypeTableSeeder::class);
        $this->call(CompanyRoleTableSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(CompanyCanBeSeeder::class);
        $this->call(CompanyUserInCompanySeeder::class);
        $this->call(CollectionTypeSeeder::class);
        $this->call(CollectionSeeder::class);
        $this->call(CompanyHasCollectionSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(NestedCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ContainedAsSeeder::class);
        $this->call(CollectionContainsSeeder::class);
        $this->call(MediaTypeSeeder::class);
        $this->call(OptionTypeSeeder::class);
        $this->call(TermsTypeSeeder::class);
        $this->call(MediaLinkSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(ShippingTypeOptionSeeder::class);
        $this->call(EventTypeSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(MessageTypeSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(MessageToSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(OrderContainsSeeder::class);
        $this->call(OrderOptionsSeeder::class);
        $this->call(TermsSeeder::class);
        $this->call(HasTermsSeeder::class);
        $this->call(OrderTermsSeeder::class);
        $this->call(BillInfoSeeder::class);
        $this->call(ShipInfoSeeder::class);
        $this->call(DefaultTermsSeeder::class);
        $this->call(HasOptionsSeeder::class);
        $this->call(DefaultOptionsSeeder::class);
        $this->call(ProductHasLinksSeeder::class);
        $this->call(CompHasLinksSeeder::class);
        $this->call(CollectHasLinksSeeder::class);
        $this->call(RegistrationsSeeder::class);
    }
}
