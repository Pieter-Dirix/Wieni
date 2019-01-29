<?php

use Illuminate\Database\Seeder;
use App\Trainer;

class TrainerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $trainer = new Trainer(
            [
                'naam' => 'Pieter Dirix',
                'ervaring' => 'Initiator Skeeleren'
            ]
        );
        $trainer->save();

        $trainer = new Trainer(
            [
                'naam' => 'Robin Dirix',
                'ervaring' => 'Initiator Skeeleren'
            ]
        );
        $trainer->save();

        $trainer = new Trainer(
            [
                'naam' => 'Felien Crabbe',
                'ervaring' => 'Initiator Skeeleren'
            ]
        );
        $trainer->save();

        $trainer = new Trainer(
            [
                'naam' => 'Warre Debois',
                'ervaring' => 'Gevorderden'
            ]
        );
        $trainer->save();

        $trainer = new Trainer(
            [
                'naam' => 'Anne-sophie Janssens',
                'ervaring' => 'Competitie'
            ]
        );
        $trainer->save();

        $trainer = new Trainer(
            [
                'naam' => 'GEEN_TRAINER',
                'ervaring' => '________'
            ]
        );
        $trainer->save();
    }
}
