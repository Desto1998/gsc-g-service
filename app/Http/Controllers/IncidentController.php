<?php

namespace App\Http\Controllers;
use App\Models\appareils;
use App\Models\Client;
use App\Models\Commentaires;
use App\Models\incidents;
use App\Models\Produit_Factures;
use App\Models\User;
use PDF;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    //
    public function add(){
        $clients = Client::all();
        return view('incident.create',compact('clients'));

    }
    public function index (){
        $data = incidents::join('clients','clients.client_id','incidents.idclient')->get();
        $users = User::all();
        return view('incident.index',compact('data','users'));
    }

    public function show ($id){
        $commentaires = Commentaires::join('users', 'users.id', 'commentaires.iduser')->where('idfacture', $id)->get();
        $data = incidents::where('incident_id',$id)->join('clients','clients.client_id','incidents.idclient')->get();
        $users = User::all();
        $pocedes = appareils::where('idincident', $id)->get();
        return view('incident.detail.detail',compact('data','users','commentaires','pocedes'));
    }
    public function store(Request $request){

        $request->validate([
            'objet'=>['required'],
            'date'=>['required'],
            'date_debut'=>['required'],
            'heure'=>['required'],
            'num'=>['required'],
            'marque'=>['required'],
            'idclient'=>['required'],
        ]);
//        dd($request);
        $lastNum = incidents::whereYear('created_at', date('Y'))
            ->whereRaw('incident_id = (select max(`incident_id`) from incidents)')
            ->get();

        $iduser = Auth::user()->id;
//        $date = new DateTime($request->date);
////        $date->sub(new DateInterval('P1D'));
//        $nbjour = $request->validite * 7;
//        $date->add(new DateInterval("P{$nbjour}D"));
//        $date = date("Y-m-d", strtotime($date->format('Y-m-d')));

        /** @var 'on' genere la  $reference */
        $reference = 'BI' . date('Y');
        if (count($lastNum) > 0) {
            $lastNum = $lastNum[0]->reference;
            $actual = 0;
            for ($j = 0; $j < strlen($lastNum); $j++) {
                if ($j > 5) {
                    $actual .= $lastNum[$j];
                }
            }
            $num = (int)$actual;
            $num += 1;
            $actual = str_pad($num, 3, "0", STR_PAD_LEFT);
            $reference .= $actual;
        } else {
            $num = 1;
            $actual = str_pad($num, 3, "0", STR_PAD_LEFT);
            $reference .= $actual;
        }
//        dd($reference);
        $save = incidents::create([
            'reference' => $reference,
            'objet' => $request->objet,
            'date_incident' => $request->date,
            'statut' => 0,
            'idclient' => $request->idclient,
            'commentaire' => $request->description_probleme,
            'date_debut' => $request->date_debut,
//            'date_fin' => $request->heure,
//            'heure_fin' => $request->heure,
            'heure_debut' => $request->heure,
            'type' => $request->type,
            'iduser' => $iduser,
        ]);
        if (isset($request->marque)) {
            for ($i = 0; $i < count($request->num); $i++) {

                appareils::create([
                    'num_serie' => $request->num[$i],
                    'probleme' => $request->description[$i] ?? '',
                    'montant' => $request->prix[$i] ?? '',
                    'accessoirs' => $request->acce[$i],
                    'etat' => $request->etat[$i],
                    'modele' => $request->model[$i],
                    'marque' => $request->marque[$i] ?? '',
                    'iduser' => $iduser,
                    'idincident' => $save->incident_id,
                ]);
            }
        }

        if ($save) {
            return redirect()->route('incident.all')->with('success','Enregistré avec succès!');

        }
        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");

    }

    public function done ($id){
        $save = incidents::where('incident_id',$id)->update(['statut'=>2]);
        if ($save) {
            return redirect()->route('incident.all')->with('success','Enregistré avec succès!');

        }
        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");

    }
    public function detail($id){
        $commentaires = Commentaires::join('users', 'users.id', 'commentaires.iduser')->where('idincident', $id)->get();
        $data = incidents::where('incident_id',$id)->join('clients','clients.client_id','incidents.idclient')->get();
        $users = User::all();
        $pocedes = appareils::where('idincident', $id)->get();
        return view('incident.detail.detail',compact('data','users','commentaires','pocedes'));
    }
    public function Encours($id){
        $save = incidents::where('incident_id',$id)->update(['statut'=>1]);
        if ($save) {
            return redirect()->route('incident.all')->with('success','Enregistré avec succès!');

        }
        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");

    }

    public function showEditForm($id){
        return view('incident.index');
    }
    public function update(Request $request){
        return view('incident.index');
    }
    public function delete(Request $request){
        $delete = incidents::where('incident_id',$request->id)->delete();
        return Response()->json($delete);
    }

    public function print(Request $request){
//        dd($request);
        $data = incidents::join('clients','clients.client_id','incidents.idclient')
            ->join('users','users.id','incidents.iduser')
            ->where('incident_id',$request->incident_id)->get();
        $pocedes = appareils::where('idincident',$request->incident_id)->get();

        if ($request->type==1) {
            $pdf = PDF::loadView('incident.print_devis', compact('data', 'pocedes','request'))->setPaper('a4')->setWarnings(false);
            // dd($pdf);
            return $pdf->stream($data[0]->reference . '_' .date("d-m-Y H:i:s") . '.pdf');
        }else{
            $pdf = PDF::loadView('incident.print_in', compact('data', 'pocedes','request'))->setPaper('a4')->setWarnings(false);
            // dd($pdf);
            return $pdf->stream($data[0]->reference . '_' .date("d-m-Y H:i:s") . '.pdf');
        }
    }

}
