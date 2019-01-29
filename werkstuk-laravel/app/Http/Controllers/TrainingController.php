<?php

namespace App\Http\Controllers;
use App\Trainer;
use App\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingController extends Controller
{
    //geeft de index terug met alle trainingen die vandaag of later plaats vinden
    public function getIndex() {
        $d = Carbon::today();
        $today = date('Y-m-d', strtotime($d . '-1 day') );
        //$trainings = DB::table('trainings')->whereDate('datum', '>', $today->format('Y-m-d'))->get();
        $temp = Training::orderBy('datum', 'asc')->get();
        $trainings = [];
        foreach ($temp as $training) {
            if($training->datum >= $today) {
                array_push($trainings, $training);
            }
        }
        return view('content.index', ['trainings' => $trainings]);
    }
    //geeft de voorbije training view terug met alle trainingen eerder dan vandaag
    public function getOudeTrainingen() {
        $d = Carbon::today();
        $today = date('Y-m-d', strtotime($d . '-1 day') );
        //$trainings = DB::table('trainings')->whereDate('datum', '>', $today->format('Y-m-d'))->get();
        $temp = Training::orderBy('datum', 'desc')->get();
        $trainings = [];
        foreach ($temp as $training) {
            if($training->datum <= $today) {
                array_push($trainings, $training);
            }
        }
        return view('content.oudetraining', ['trainings' => $trainings]);
    }
    //training detail view met $id terug
    public function getTraining($id) {

        $training = Training::where('id', $id)->first();
        return view('content.training', ['training' => $training]);
    }
    //post een nieuwe training naar de database en returned terug naar de admin index
    public function postCreateTraining(Request $request) {

        $this->validate($request, [
            'datum' => 'required',
            'beschrijving' => 'required|max:300',
            'beginEindUur' => 'required|max:50',
            'groeps'=> 'required',
            'trainers' => 'required']);
        //datum formatten
        $date = $date = date('Y-m-d', strtotime($request->input('datum')));

        $training = new Training([
            'datum' => $date,
            'beschrijving' => $request->input('beschrijving'),
            'beginEindUur' => $request->input('beginEindUur'),
        ]);

        $training->save();

        $training->groeps()->sync(
            $request->input('groeps')=== null
                ? ''
                : $request->input('groeps'));

       /* $training->trainer()->associate(
            $request->input('trainers') === null
                ? ''
                : $request->input('trainers')[0]);*/
        $trainer = Trainer::where('id', $request->input('trainers')[0])->first();
        $trainer->trainings()->save($training);



        return redirect()->route('admin.index');

    }

    //edit een bestaande training in de database en returned terug naar de admin index
    public function postEditTraining(Request $request) {
        $this->validate($request, [
            'datum' => 'required',
            'beschrijving' => 'required|max:300',
            'beginEindUur' => 'required|max:50',
            'groeps'=> 'required',
            'trainers' => 'required']);
        //datum formatten
        $date = date('Y-m-d', strtotime($request->input('datum')));

        $training = Training::find($request->input('id'));

        $training->datum = $date;
        $training->beschrijving = $request->input('beschrijving');
        $training->beginEindUur = $request->input('beginEindUur');

        $training->save();
        //tags
        $training->groeps()->sync(
            $request->input('groeps')=== null
                ? ''
                : $request->input('groeps'));


        $trainer = Trainer::where('id', $request->input('trainers')[0])->first();
        $trainer->trainings()->save($training);



        return redirect()->route('admin.index');
    }
}
