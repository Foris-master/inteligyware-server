<?php

use Illuminate\Database\Eloquent\Model;
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
        App\Helpers\FactoryHelper::clear();

        Model::unguard();
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);
        $this->call(TownsTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(PatnersTableSeeder::class);
        $this->call(UsersTableSeeder::class);


//        $this->call(DevicesTableSeeder::class);



        $this->call(MobileOperatorsTableSeeder::class);
//        $this->call(PaymentMethodsTableSeeder::class);




        $this->call(RatingsTableSeeder::class);



        $this->call(ServicesTableSeeder::class);
        $this->call(PointOfSalesTableSeeder::class);
        $this->call(PointOfSaleServicesTableSeeder::class);
        $this->call(StationsTableSeeder::class);
        $this->call(ServiceStationsTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(OffersTableSeeder::class);
        $this->call(ClientOffersTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);

        $this->call(BillsTableSeeder::class);

        $this->call(PaymentsTableSeeder::class);

//        $this->call(SubscriptionUsersTableSeeder::class);
//        $this->call(ChatsTableSeeder::class);
//        $this->call(ChatUsersTableSeeder::class);
//        $this->call(MessagesTableSeeder::class);
//        $this->call(MessageFilesTableSeeder::class);
//        $this->call(MessageAssetsTableSeeder::class);


        Model::reguard();
    }
}
