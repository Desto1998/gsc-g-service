@extends('layouts.app')
@section('css_before')
    <link href="{{ asset('template/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/vendor/select2/css/select2.min.css') }}">
    <style>
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
                    <h4>Modifié Clients</h4>
                    {{-- <p class="mb-0">Your business dashboard template</p> --}}
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Clients</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Index</a></li>
                </ol>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <span class="h4 float-left">Liste des clients</span>
                        <a href="{{ route('client.add') }}" title="Ajouter un utilisateur"
                            class="btn btn-primary mb-3 float-right">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Ajouter
                        </a>

                        <div class="table-responsive">
                            <table id="example" class="display text-center w-100">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Téléphone</th>
                                        <th>Email</th>
                                        <th>Ville</th>
                                        <th>Adresse</th>
                                        <th>Creer le</th>
                                        <th>Creer par</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $value)
                                        <tr id="table-row-{{ $value->id }}">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->nom_client }} {{ $value->prenom_client }}
                                                {{ $value->raison_s_client }}</td>
                                            <td>{{ $value->phone_1_client }}</td>
                                            <td>{{ $value->email_client }}</td>
                                            <td>{{ $value->ville_client }}</td>
                                            <td>{{ $value->adresse_client }}</td>
                                            <td>{{ $value->date_ajout }}</td>
                                            <td>{{ $value->firstname }}</td>
                                            <td class="d-flex">

                                                <a href="{{ route('client.edit', ['id' => $value->client_id]) }}"
                                                    class="btn btn-warning btn-sm" title="Modifier le compte"><i
                                                        class="fa fa-edit"></i></a>

                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm ml-1 "
                                                    title="Supprimer" onclick="deleteFun({{ $value->client_id }})"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // delete funtion
        function deleteFun(id) {
            swal.fire({
                title: "Supprimer ce client?",
                icon: 'question',
                text: "Ce client sera supprimé de façon définitive.",
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
                        url: "{{ route('client.delete') }}",
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
        // <!--Datatable -->
    <script src = "{{ asset('template/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('template/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    // <!-- Selet search -->
    <script src="{{ asset('template/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('template/js/plugins-init/select2-init.js') }}"></script>
@endsection
