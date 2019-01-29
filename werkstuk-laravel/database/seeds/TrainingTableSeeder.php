<?php

use Illuminate\Database\Seeder;
use App\Training;

class TrainingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $training = new Training(
            [
                'datum' => '2019-01-06',
                'beschrijving' => 'Op één been rijden en overstappen',
                'beginEindUur' => '18u tem 19u',
                'trainer_id' => 1
            ]
        );
        $training->save();

        $training = new Training(
            [
                'datum' => '2019-01-07',
                'beschrijving' => 'Visjes voorwaarts en achteruit',
                'beginEindUur' => '19u tem 20u',
                'trainer_id' => 1
            ]
        );
        $training->save();

        $training = new Training(
            [
                'datum' => '2019-01-09',
                'beschrijving' => 'Op één been rijden en overstappen',
                'beginEindUur' => '18u tem 19u',
                'trainer_id' => 1
            ]
        );
        $training->save();
    }
}
