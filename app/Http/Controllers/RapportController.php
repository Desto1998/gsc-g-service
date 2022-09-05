<?php

namespace App\Http\Controllers;

use App\Models\Charges;
use App\Models\Clients;
use App\Models\Factures;
use App\Models\Taches;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use App\Models\Month;

class RapportController extends Controller
{
    //Show charge form
    protected function showChargeForm(){
        $taches = taches::all();
        return view('rapport.charge_form',compact('taches'));
    }
    //Show vente form
    protected function showVenteForm(){

        return view('rapport.vente_form');
    }

    // Make pdf for charge
    protected function printCharge(Request $request){
        $request->validate([
           'debut'=>['required'],
           'fin'=>['required'],
//           'charge'=>['required']
        ]);
        $titre = $request->titre;
        $debut = $request->debut;
        $fin = $request->fin;
        if ($request->charge==0) {
            $data = Taches::where('date_debut','<=',$request->fin)
                ->where('date_debut','>=',$request->debut)
                ->orderBy('taches.date_ajout','desc' )
                ->get()
            ;
        }else{
            $data = Taches::where('date_debut','<=',$request->fin)
                ->where('date_debut','>=',$request->debut)
                ->where('tache_id',$request->charge)
                ->orderBy('taches.date_ajout','desc' )
                ->get();
            ;
        }
        $taches = taches::all();
        $users= User::all();
        $mois = (new \App\Models\Month)->getFrenshMonth((int)date('m'));
        $pdf = PDF::loadView('rapport.print_charge',
            compact('users','titre','data','debut','mois','fin'))->setPaper('a4', 'landscape')->setWarnings(false);

//                $pdf->download('Rapport_des_charge_du'.$request->jour);

        return $pdf->stream('Rapport_des_charges_du' . $request->debut . '_au_' . $request->fin . '.pdf');
    }

}
