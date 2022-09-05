@extends('layouts.app')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Enregistre un appareil</h4>
                    {{--                    <p class="mb-0">Your business dashboard template</p>--}}
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">appareil</a></li>
                </ol>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card px-3">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <h4 class="w-50">ajouter un appareil</h4>
                        <div class="row">
                            <div class="form-group col-md-6 clienthide">
                                <label for="nom_client">Nom du client<span class="text-danger">*</span></label>
                                <input type="text"  name="nom_client" id="nom_client" required placeholder="Nom client" class="form-control">
                            </div>
    
                            <div class="form-group col-md-6 clienthide">
                                <label for="prenom_client">telephone</label>
                                <input type="text" name="prenom_client" id="prenom_client" placeholder="telephone" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-6 clienthide">
                                <label for="prenom_client">marque</label>
                                <input type="text" name="prenom_client" id="prenom_client" placeholder="marque" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-6 clienthide">
                                <label for="prenom_client">numero de serie</label>
                                <input type="text" name="prenom_client" id="prenom_client" placeholder="numero serie" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-6 clienthide">
                                <label for="prenom_client">libelle</label>
                                <input type="text" name="prenom_client" id="prenom_client" placeholder="nom appareil" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-6 clienthide">
                                <label for="prenom_client">probleme</label>
                                <input type="text" name="prenom_client" id="prenom_client" placeholder="decrire probleme" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-6 clienthide">
                                <label for="prenom_client">accessoirs</label>
                                <input type="text" name="prenom_client" id="prenom_client" placeholder="accessoirs" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection