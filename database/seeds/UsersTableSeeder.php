<?php
    
    use Illuminate\Database\Seeder;
    
    class UsersTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run ()
        {
            //
            Factory(App\User::class, 1)->create([
                'name'  => 'admin',
                'email' => 'admin@sarocreative.com',
            ]);
            
            $this->command->info('Created Admin User');
        }
    }
