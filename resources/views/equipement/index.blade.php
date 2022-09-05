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
                            class="btn btn-primary mb-3 float-right">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Ajouter
                        </a>

                        <div class="table-responsive">
                            <table id="example" class="display text-center w-100">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom client</th>
                                        <th>Téléphone</th>
                                        <th>marque</th>
                                        <th>numero serie</th>
                                        <th>probleme</th>
                                        <th>date entree</th>
                                        <th>date sortie</th>
                                        <th>accessoirs</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection