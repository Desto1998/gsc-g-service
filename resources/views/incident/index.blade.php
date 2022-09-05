@extends('layouts.app')
@section('css_before')
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/vendor/select2/css/select2.min.css')}}">
    <style>
        table thead tr th{
            color: white!important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>GESTION DES INCIDENTS</h4>
                    {{--                    <p class="mb-0">Your business dashboard template</p>--}}
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Incidents</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Index</a></li>
                </ol>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <span class="float-left h4">Listes des incidents</span>
                        <a href="{{ route('incident.add') }}" class="btn btn-primary float-right mb-3"
                                ><i class="fa fa-plus">&nbsp; Ajouter</i></a>

                        <div class="table-responsive">
                            <table id="example" class="display text-center" style="min-width: 845px">
                                <thead class="bg-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Reference</th>
                                    <th>Client</th>
                                    <th>Objet</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Statut</th>
                                    <th>Par</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key=>$value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->raison_client }} {{ $value->nom_client }} {{ $value->prenom_client }}</td>
                                        <td>{{ $value->reference }}</td>
                                        <td>{{ $value->objet }}</td>
                                        <td><small>{{ $value->commentaire }}</small></td>
                                        <td>{{ $value->date_debut }}</td>
                                        <td>{{ $value->type }}</td>
                                        <td>
                                            @if ($value->statut==0)
                                                <span class="text-danger">Non terminé</span>
                                            @elseif($value->statut==1)
                                                <span class="text-primary">En cours</span>
                                            @else
                                                <span class="text-success">Terminé</span>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach($users as $u)
                                                @if ($u->id==$value->iduser)
                                                    {{ $u->firstname }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex">
                                                <a class="btn btn-sm btn-success mx-1" href="{{ route('incident.detail',['id'=>$value->incident_id]) }}" title="Voir les details"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-sm btn-warning mx-1" href="{{ route('incident.edit',['id'=>$value->incident_id]) }}" title="Editer"><i class="fa fa-edit"></i></a>
                                                <a class="btn  btn-smbtn-light mx-1" data-toggle="modal" data-target="#print-modal{{ $value->incident_id }}" href="javascript:void(0);" title="Imprimer"><i class="fa fa-file-pdf-o"></i></a>
                                            </div>
                                            <div class="d-flex mt-2">
                                                <a class="btn btn-sm btn-danger mx-1" onclick="deleteFun({{ $value->incident_id }})" href="javascript:void(0)" title="Supprimer"><i class="fa fa-trash-o"></i></a>
                                                @if ($value->statut==0)
                                                    <a class="btn btn-sm btn-primary mx-1" href="{{ route('incident.encours',['id'=>$value->incident_id]) }}" title="Marquer comme en cours"><i class="fa fa-check"></i></a>
                                                @elseif($value->statut==1)
                                                    <a class="btn btn-sm btn-secondary mx-1" href="{{ route('incident.done',['id'=>$value->incident_id]) }}" title="Marquer comme effectue"><i class="fa fa-database"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="print-modal{{ $value->incident_id }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Imprimer un document</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('incident.print') }}" method="get" id="product-form{{ $value->incident_id }}">
                                                        @csrf
                                                        <input type="hidden" name="incident_id" id="incident_id{{ $value->incident_id }}" value="{{ $value->incident_id }}" required>

                                                        <div class="form-group">
                                                            <label class="text-left pl-3">Type du document</label>
                                                            <div class="col-md-15 form-group">
                                                                <select   class="form-control" id="type{{ $value->incident_id }}" name="type">
                                                                    <option value="1">La proformat</option>
                                                                    <option value="2">Rapport d'intervention</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-primary" id="addFields">Imprimer</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@include('incident.modal')
@endsection
@section('script')
    <script>
        function deleteFun(id) {
            swal.fire({
                title: "Supprimer cet incident?",
                icon: 'question',
                text: "Cet incident sera supprimé de façon définitive.",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Oui, supprimer!",
                cancelButtonText: "Non, annuler !",
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    // if (confirm("Supprimer cette tâches?") == true) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('incident.delete') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res) {
                                swal.fire("Effectué!", "Supprimé avec succès!", "success")

                            } else {
                                sweetAlert("Désolé!", "Erreur lors de la suppression!", "error")
                            }

                        },
                        error: function(resp) {
                            sweetAlert("Désolé!", "Une erreur s'est produite.", "error");
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function(dismiss) {
                return false;
            })
        }
    </script>
 <!-- Datatable -->
 <script src="{{asset('template/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('template/js/plugins-init/datatables.init.js')}}"></script>
 <script src="{{asset('template/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
 <!-- Selet search -->
 <script src="{{asset('template/vendor/select2/js/select2.full.min.js')}}"></script>
 <script src="{{asset('template/js/plugins-init/select2-init.js')}}"></script>
@endsection
