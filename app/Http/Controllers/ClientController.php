<?php
  
namespace App\Http\Controllers;
use App\Models\client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
  
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
   
    public function index(){
      $data = Client::join('users','users.id','clients.iduser')->orderBy('date_ajout','desc')->get();
    //     $pays = Pays::all();
        return view('client.index',compact('data'));
    }
    public function store(Request $request){
        $request->validate([
            'phone_1'=>['required']
        ]);
        $nom = '';
        $raison = '';
        $prenom = '';
        $rcm = '';
        $contribuabe = '';

        if ($request->type_client==0) {
            $request->validate([
                'nom_client'=>['required']
            ]);
            $nom=$request->nom_client;
            $prenom = $request->prenom_client;
        }else{
            $request->validate([
                'raison_s_client'=>['required']
            ]);
            $rcm = $request->rcm;
            $contribuabe = $request->contribuabe;
            $raison = $request->raison_s_client;
        }
        $iduser = Auth::user()->id;
        $dataId = $request->client_id;
        $date=date('Y-m-d');
        if ($dataId) {
            $date = $request->date_ajout;
        }
        $save  = Client::updateOrCreate(
            ['client_id' => $dataId],
            [
                'nom_client' => $nom,
                'prenom_client' => $prenom,
                'raison_s_client' => $raison,
                'phone_1_client' => $request->phone_1,
                'phone_2_client' => $request->phone_2,
                'email_client' => $request->email_client,
                'contribuable' => $contribuabe,
                'rcm' => $rcm,
                'iduser' => $iduser,
                'ville_client' => $request->ville_client,
                'adresse_client' => $request->adresse_client,
                'postale' => $request->postale,
                'type_client' => $request->type_client,
                'date_ajout' => $date,

            ])
        ;
      //  return Response()->json($save);
       if ($save) {
           return redirect()->route('client.all')->with('success','Enregistré avec succès!');

       }
       return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");
    }

    public function showEditForm($id){
        $client = Client::find($id);
    
        return view('client.edit',compact('client'));
    }


    public function update(Request $request){
        $request->validate([
            'phone_1'=>['required']
        ]);
        $nom = '';
        $prenom = '';

        if ($request->type_client==0) {
            $request->validate([
                'nom_client'=>['required']
            ]);
            $nom=$request->nom_client;
            $prenom = $request->prenom_client;
        }else{
            $request->validate([
                'phone_1_client'=>['required']
            ]);
        }
        $iduser = Auth::user()->id;
        $dataId = $request->client_id;
        $date=date('Y-m-d');
        if ($dataId) {
            $date = $request->date_ajout;
        }
        $save  = Client::updateOrCreate(
            ['client_id' => $dataId],
            [
                'nom_client' => $nom,
                'prenom_client' => $prenom,
                'phone_1_client' => $request->phone_1,
                'phone_2_client' => $request->phone_2,
                'email_client' => $request->email_client,
                'iduser' => $iduser,
                'ville_client' => $request->ville_client,
                'adresse_client' => $request->adresse_client,
                'date_ajout' => $date,

            ])
        ;
//        return Response()->json($save);
        if ($save) {
            return redirect()->route('client.all')->with('success','Enregistré avec succès!');

        }
        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");
    }

    
    public function delete(Request $request){
        $delete = Client::where('client_id',$request->id)->delete();
        return Response()->json($delete);
    }
   
}
