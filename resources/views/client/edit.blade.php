@extends('layouts.app')
@section('css_before')
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/vendor/select2/css/select2.min.css')}}">
    <style>
        .enterprisehide{
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 class="text-uppercase">Modifié un client</h4>
                    {{--                    <p class="mb-0">Your business dashboard template</p>--}}
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Clients</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Update</a></li>
                </ol>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <span class="h4 float-left">Modifié de client</span><br>
                    
                        <form action="{{ route('client.store') }}" method="post" id="client-form">
                            @csrf
                            <input type="hidden" value="{{ $client->client_id }}" name="client_id">
                            <input type="hidden" value="{{ $client->date_ajout }}" name="date_ajout">
                            <div class="form-group">
                                <label for="type_client">Sélectionner le type du client</label>
                                <select class="form-control" onchange="filterFormInput()" required name="type_client" id="type_client">
                                    <option {{ $client->type_client=="0"?'selected':'' }} value="0">Personne physique</option>
                                    <option {{ $client->type_client=="1"?'selected':'' }} value="1">Entreprise</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 clienthide">
                                    <label for="nom_client">Nom<span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $client->nom_client }}" name="nom_client" id="nom_client" required placeholder="Nom" class="form-control">
                                </div>

                                <div class="form-group col-md-6 clienthide">
                                    <label for="prenom_client">prenom</label>
                                    <input type="text" value="{{ $client->prenom_client }}" name="prenom_client" id="prenom_client" placeholder="Prénom" class="form-control">
                                </div>
                            </div>

                  

                            <div class="form-group">
                                <label for="email_client">Email<span class="text-danger">*</span></label>
                                <input type="email" value="{{ $client->email_client }}"name="email_client" id="email_client" required placeholder="Email" class="form-control">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="phone_1">Téléphone 1<span class="text-danger">*</span></label>
                                    <input type="tel" value="{{ $client->phone_1_client }}" name="phone_1" id="phone_1" required placeholder="Téléphone" class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone_2">Téléphone 2</label>
                                    <input type="tel" value="{{ $client->phone_2_client }}" name="phone_2" id="phone_2" placeholder="Téléphone" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ville_client">Ville<span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $client->ville_client }}" name="ville_client" required id="ville_client" placeholder="Ville" class="form-control">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="adresse_client">Adresse</label>
                                <input type="text" value="{{ $client->adresse_client }}" name="adresse_client" id="adresse_client" placeholder="Adresse" class="form-control">
                            </div>
                          
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
    @endsection