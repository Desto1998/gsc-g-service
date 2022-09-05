@extends('layouts.app')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/vendor/select2/css/select2.min.css')}}">

    <style>
        .hidden {
            display: none;
        }

        .enterprisehide {
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Ajouter un incident</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">incidents</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Ajouter</a></li>
                </ol>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <form action="{{ route('incident.store') }}" method="post" id="incident-form">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="date">Date : </label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                </div>
                                <div class="col-md-7 float-right d-flex" id="client-block">
                                    <div class="form-group col-md-6">
                                        <label for="echeance">Client <span class="text-danger"> *</span> </label>
                                        <select name="idclient" id="single-select" class="form-control" required>
                                            <option selected="selected" disabled>Sélectionez un client</option>
                                            @foreach($clients as $cl)
                                                <option
                                                    value="{{ $cl->client_id }}">{{ $cl->nom_client }} {{ $cl->prenom_client }}{{ $cl->raison_s_client }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="client-block">
                                        <label class="text-center pl-3">Coordonnées du client
                                            &nbsp;&nbsp;
                                            {{--                                            <button type="button" class="btn btn-primary btn-sm float-right"--}}
                                            {{--                                                    data-toggle="modal"--}}
                                            {{--                                                    title="Ajouter un client"--}}
                                            {{--                                                    data-target="#clientsModal"><i class="fa fa-plus">&nbsp;</i>--}}
                                            {{--                                            </button>--}}
                                        </label>
                                        @foreach($clients as $cl)
                                            <div class="hidden infos_client pl-3" id="infos_client{{ $cl->client_id }}">
                                                <label
                                                    class="h5 font-weight-bold mt-1">{{ $cl->nom_client }} {{ $cl->prenom_client }}{{ $cl->raison_s_client }}</label><br>
                                                <label
                                                    class="h5 font-weight-bold mt-1">Tel: {{ $cl->phone_1_client }}  {{ $cl->phone_client }}</label><br>
                                                <label
                                                    class="h5 font-weight-bold mt-1">Bp: {{ $cl->postale }}</label><br>
                                                {{--                                                <label class="h5 font-weight-bold mt-1"> {{ $cl->rcm }}</label><br>--}}
                                                {{--                                                <label class="h5 font-weight-bold mt-1">NC: {{ $cl->contribuabe }}</label><br>--}}
                                            </div>

                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="objet">Objet: </label>
                                <input type="text" name="objet" id="objet" class="form-control" required>
                            </div>

                            <div class="col-md-4 mt-4 float-right text-end justify-content-end">
                                <button type="button" class="btn btn-sm btn-primary" id="add-row-produit"
                                        data-toggle="modal"
                                        data-target="#facture-modal"><i
                                        class="fa fa-plus"></i> Ajouter une ligne &nbsp;&nbsp;
                                </button>
                            </div>
                            <div class="for-produit table-responsive" style="max-height: 300px; overflow: auto">
                                <label class="nav-label">incidents</label>
                                <table class="w-100 table table-striped table-bordered table-active"
                                       id="validated-element">
                                    <thead class="bg-primary text-white text-center">
                                    <tr>
                                        <th>Num serie</th>
                                        <th>Marque</th>
                                        <th>Modèle</th>
                                        <th>Panne</th>
                                        <th>Montant</th>
                                        <th title="Action"><i class="fa fa-trash"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--                                    <tr>--}}
                                    {{--                                        <td><input type="text"name="numero serie"required  class="form-control"></td>--}}
                                    {{--                                        <td><input type="text"name="marque"required class="form-control"></td>--}}
                                    {{--                                        <td><input type="text"name="modele"required class="form-control"></td>--}}
                                    {{--                                        <td><input type="text"name="panne"required  class="form-control"></td>--}}
                                    {{--                                        <td><input type="number"name="prix"required  class="form-control"></td>--}}
                                    {{--                                    </tr>--}}
                                    </tbody>

                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="row mt-2">
                                    <div class="form-group col-md-4">
                                        <label for="date debut">date debut<span class="text-danger"> *</span></label>
                                        <input type="date" required name="date_debut"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="heure">heure<span class="text-danger"> *</span></label>
                                        <input type="time" required name="heure"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="">Type<span class="text-danger"> *</span></label>
                                        <select class="form-control" name="type">
                                            <option class="form-control" name="type">Externe</option>
                                            <option class="form-control" name="type">Interne</option>
                                            <option class="form-control" name="type">Intervention chez le client
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="description_probleme">Description commentaire <strong>GSC</strong>
                                    </label>
                                    <textarea name="description_probleme" id="description_probleme"
                                              placeholder="Description probleme"
                                              class="form-control"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('client.modal')
    @include('incident.modal')
@endsection
@section('script')
    @include('incident.script')
    <!-- Datatable -->
    <script src="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <!-- Selet search -->
    <script src="{{asset('template/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('template/js/plugins-init/select2-init.js')}}"></script>
@endsection
