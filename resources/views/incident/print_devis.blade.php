<!DOCTYPE html>
<html>
<head>
    <title>Presentation devis</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<style>
    * {
        font-family: "Roboto", sans-serif;
    }

    table {
        border-collapse: collapse;
    }


    header table .for-logo img {
        width: 100px;
    }

    header table .for-name {
        text-align: center;
    }

    header table .for-name p {
        font-size: 12px;
    }

    header table .for-name h3 {
        font-family: "Arial Black";
        color: #0c85d0;
    }
    .for-date{
        width: 200px;
        justify-content: right;
        text-align: center;
    }
    .for-infos table {
        min-width: 100%;
        font-size: 13px;
    }

    .client-details, .devis-details {
        padding: 10px;
        line-height: 1.4;
    }

    .client-details {
        border: 1px solid #2A2C32;
        border-radius: 10px;
        padding: 5px;
        width: 200px;
    }

    td.devis-info {
        width: 445px;
    }

    .for-objet, .for-complement label {
        margin: 15px 0;
    }

    .for-produit table, .for-complement table {
        width: 100%;
        font-size: 12px;
    }

    .for-produit table thead tr th, .for-produit table tbody tr td {
        border: #000000 1px solid;
        padding: 5px;
    }

    .for-complement {
        margin: 20px 0
    }

    .for-complement table thead tr th, .for-complement table tbody tr td {
        border: #000000 1px solid;
        padding: 5px;
    }

    .bg-primary {
        background-color: #0c85d0;
        padding: 2em;
        text-align: center;
        color: #ffffff;
    }

    .number {
        text-align: right;
    }

    .total {
        font-weight: 700;
    }

    .for-garentie {
        width: 100%;
        margin-top: 20px;
    }

    .for-garentie tr td div {
        font-size: 12px;
        line-height: 1.6;
        padding: 8px;
        border: #a5a3a3 solid 1px;
        height: 50px;
        width: 155px;
    }

    .for-garentie tr td div .titre {
        font-weight: 700;
    }
    .space-for-footer{
        height: 200px;
    }
    footer {
        position: fixed;
        bottom: -70px;
        left: 0px;
        right: 0px;
        height: 200px;
        text-align: center;
        line-height: 1;
        font-size: 12px;
    }

    footer table {
        width: 100%;
    }

    footer table tr td {
        width: 33%;
    }

    footer table tr div {
        width: 158px;
        background-color: #0c85d0;
        padding: 10px;
        border-radius: 10px;
        color: #ffffff;
        font-size: 9px;
    }
</style>
<body style="margin-left: 7px; margin-right: 5px;">
<header class="forhead">
    <table class="heading-table">
        <tr>
            <td class="for-logo">
                @php
                    $ImagePath = $_SERVER["DOCUMENT_ROOT"] . '/images/logo/logo_gssc.png';
                @endphp

                {{--                    <img src="{{ asset('images/logo/logo_gssc.png') }}" class="logo" alt="Logo not found">--}}
                <img src="{{ $ImagePath }}" class="logo" alt="Logo not found">
                {{--                <img src="{{ asset('images/logo/logo_gssc.png') }}" class="logo" alt="Logo not found">--}}
            </td>
            <td class="for-name">
                <h3>{{ 'GLOBAL SOFT & COMMUNICATION Sarl' }}</h3>
                <p>
                    <strong>GSC:</strong> Rue Castelnau face direction commerciale MTN derrière Akwa Palace, DOUALA CAMEROUN <br>
                    <strong style="padding-top: 8px; text-transform: uppercase">DSP: {{ $data[0]->firstname }} {{ $data[0]->lastname }} {{ $data[0]->phone }} </strong>
                </p>

            </td>
            <td class="for-date">

{{--                <strong>{{ (new DateTime($data[0]->date_devis))->format('d').' '.$mois.' '.(new DateTime($data[0]->date_devis))->format('Y') }}</strong>--}}
            </td>
        </tr>
    </table>
</header>

<div class="for-infos">
    <table class="devis-info">
        <tr>
            <td class="devis-info">
                <div class="devis-details">
                    <strong style="text-decoration: underline">PROFORMAT</strong><br>
                    <strong>{{ $data[0]->reference}}</strong><br>
                    <strong>Contibibuable N°: </strong><strong>M06191391224E</strong><br>
                    <strong>NC: RC/DLA/2019/B/2977</strong><br>
                </div>

            </td>
            <td>
                <div class="client-details">
                    <strong style="text-decoration: underline">COORDONNEES CLIENT</strong><br>
                    <strong style="text-transform: uppercase">{{ $data[0]->nom_client }} {{ $data[0]->prenom_client }} {{ $data[0]->raison_s_client }}</strong><br>
                    <strong>Tel: {{ $data[0]->phone_1_client }}  {{ isset($data[0]->phone_2_client)?'/'.$data[0]->phone_2_client:''  }}</strong><br>
                    <strong>BP: {{ $data[0]->postale }}  </strong><br>
                    @if ($data[0]->type_client==1)
                        <strong>{{ $data[0]->contribuable }}  </strong><br>
                        <strong>NC: {{ $data[0]->rcm }}  </strong><br>
                    @endif
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="for-objet"><strong>Objet:</strong> {{ $data[0]->objet }}</div>
<div class="for-produit">
    <table class="table-produit">
        <thead class="bg-primary text-white text-center">
        <tr class="text-white">
            <th>Num Serie</th>
            <th>Marque</th>
            <th>Modele</th>
            <th>Pane</th>
            <th>Accessoires</th>
            <th>Montant</th>

        </tr>
        </thead>
        <tbody style="color: #000000!important;">
        @php
            $montantHT = 0;
        @endphp

        @foreach($pocedes as $p)
            @php
                $montantHT += $p->montant ;

            @endphp
            <tr class="text-black  produit-input">

                <td>{{ $p->num_serie }}</td>
                <td>
                    <strong>{{ $p->marque }}</strong> <br>

                </td>
                <td>{{ $p->modele }}</td>
                <td class="number"><small>{{ $p->probleme }}</small></td>
                <td class="number"><small>{{ $p->accessoirs }}</small></td>
                <td class="number">{{ $p->montant }}</td>
            </tr>
        @endforeach

        <tr>
            <th colspan="4" rowspan="3"></th>
            <td class="total">Total</td>
            <td class="number total">{{ number_format($montantHT,2,'.','') }}</td>
        </tr>

        </tbody>
    </table>
</div>
<div class="for-prix" style="height: 120px; margin-top: 5px">

    <div style="justify-content: right">
        @php
            $ImagePath = $_SERVER["DOCUMENT_ROOT"] . '/images/logo/gsc_cachet.jpg';
        @endphp
{{--        <img class="cachet-img" style="float: right; width: 240px;" src="{{ $ImagePath }}" alt="Cachet introuvable.">--}}
        {{--  <img class="cachet-img" style="float: right; width: 250px;" src="{{ asset('images/logo/gsc_cachet.jpg') }}" alt="Cachet introuvable.">--}}
    </div>
</div>

<table class="for-garentie">

</table>

<footer class="for-footer">
    @php

        $ImagePath = $_SERVER["DOCUMENT_ROOT"] . '/images/logo/logo-partenaire-gsc.png';

    @endphp

    <img style="width: 100%;"  src="{{ $ImagePath }}" alt="Logo Partenaire non trouvable">


    {{--  <img style="width: 100%;" src="{{ asset('images/logo/logo-partenaire-gsc.png') }}" alt="logo Partenaire non trouvable">--}}
    <table class="table-footer">
        <tr>
            <td>
                <div>
                    <strong>Douala</strong>-
                    AKWA rue Castelneau face direction commerciale MTN derrière Akwa Palace,  DOUALA CAMEROUN<br>
                    gscdla@gsc-technology.com
                </div>
            </td>
            <td>
                <div>
                    <strong>Yaounde</strong>, Rond pointNlongkak immeuble Pharmacie Lumiere
                    <br>
                    gscyde@gsc-technology.com
                </div>
            </td>
            <td>
                <div>
                    <strong>Garoua</strong>, centre Commercial face Direction PMUC<br>
                    gscgaroua@gsc-technology.com
                </div>
            </td>
            <td>
                <div>
                    <strong>Ndjamena, Tchad</strong> - avenue Ngarterie Mathias axe<br>
                    gsctchad@gsc-technology.com
                </div>
            </td>
        </tr>
    </table>
</footer>
</body>
</html>
