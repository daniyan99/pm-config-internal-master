<?php
    
    use Illuminate\Database\Seeder;
    
    class ProductSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run ()
        {
            Factory(App\Model\Product::class, 2)->create();
            
            $this->command->info('Created Fake Products');
        }
    }
