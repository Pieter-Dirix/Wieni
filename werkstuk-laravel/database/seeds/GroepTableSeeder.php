<?php
use App\Groep;
use Illuminate\Database\Seeder;

class GroepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $groep = new Groep([
            'naam' => 'Beginners 1',
            'beschrijving' => 'De kleinste en minst geavanceerde groep, meestal van 18u tot 19u'
        ]);
        $groep->save();

        $groep = new Groep([
            'naam' => 'Beginners 2',
            'beschrijving' => 'Al geavanceerder (overstappen, achteruit, etc), meestal zelfde uur als B1'
        ]);
        $groep->save();

        $groep = new Groep([
            'naam' => 'Gevorderden',
            'beschrijving' => 'Normaal gezien beheert de meerderheid de basis en geavanceerder technieken. Meestal 19u tot 20u'
        ]);
        $groep->save();

        $groep = new Groep([
            'naam' => 'Volwassenen',
            'beschrijving' => 'Kinderen te oud/goed voor gevorderden en (jong)volwassenen. Kan zeer gevarieerd zijn van niveau'
        ]);
        $groep->save();
    }
}
