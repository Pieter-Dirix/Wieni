<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User(
          [
              'name' => 'admin',
              'email' => 'admin@mail.com',
              'password' => \Illuminate\Support\Facades\Hash::make('12345'),
              'created_at' => Carbon::now()->format('Y-m-d H:i:s') //https://laracasts.com/discuss/channels/laravel/how-to-seed-timestamps-field
          ]
        );
        $user->save();

        $user = new User(
          [
              'name' => 'gebruiker',
              'email' => 'gebruiker@mail.com',
              'password' => \Illuminate\Support\Facades\Hash::make('67890'),
              'created_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
        );
        $user->save();
    }
}
