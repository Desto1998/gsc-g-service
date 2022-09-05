<?php

namespace App\Http\Controllers;

use App\Models\Commentaires;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    //
    //Ajouter un commentaire pour une facture
    public function addCommentFacture(Request $request)
    {
        $request->validate([
            'idincident' => ['required'],
            'message' => ['required'],
        ]);

        $iduser = Auth::user()->id;
        $dataID = $request->commentaire_id;
        $save = Commentaires::updateOrCreate(['commentaire_id'=>$dataID],
            [
                'idincident' => $request->idincident,
                'message' => $request->message,
                'statut_commentaire' => 1,
                'iduser' => $iduser,
                'date_commentaire' => date('Y-m-d'),
            ])
        ;
        if ($save) {
            return redirect()->back()->with('success', 'enregistrés avec succès!');
        }

        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");

    }
    //Ajouter un commentaire pour une commande
    public function updateComment(Request $request)
    {
        $request->validate([
            'commentaire_id' => ['required'],
            'message' => ['required'],
        ]);
        $dataID = $request->commentaire_id;
        $save = Commentaires::updateOrCreate(['commentaire_id'=>$dataID],
            [
                'message' => $request->message,
                'statut_commentaire' => 1,
            ])
        ;
        if ($save) {
            return redirect()->back()->with('success', 'enregistrés avec succès!');
        }

        return redirect()->back()->with('danger', "Désolé une erreur s'est produite. Veillez recommencer!");

    }
    public function deleteComment(Request $request){
        $delete = Commentaires::where('commentaire_id',$request->id)->delete();
        return Response()->json($delete);
    }
}
