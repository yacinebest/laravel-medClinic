<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='UTF-8'>
    <title></title>
    <style>
        * {
            margin: 0;
            padding: 0
        }

        body {
            font: 18px/1.4 Georgia, serif
        }

        #page-wrap {
            width: 800px;
            margin: 0 auto
        }

        textarea {
            border: 0;
            font: 14px Georgia, Serif;
            overflow: hidden;
            resize: none
        }

        table {
            border-collapse: collapse
        }

        table td,
        table th {
            border: 1px solid #000;
            padding: 5px
        }

        #header {
            height: 15px;
            width: 100%;
            margin: 20px 0;
            background: #222;
            text-align: center;
            color: #fff;
            font: 700 15px Helvetica, Sans-Serif;
            text-decoration: uppercase;
            letter-spacing: 20px;
            padding: 8px 0
        }

        #address {
            width: 250px;
            height: 150px;
            float: left
        }

        #customer {
            overflow: hidden
        }

        #logo {
            text-align: right;
            float: right;
            position: relative;
            margin-top: 25px;
            border: 1px solid #fff;
            max-width: 540px;
            max-height: 100px;
            overflow: hidden
        }

        #logo:hover,
        #logo.edit {
            border: 1px solid #000;
            margin-top: 0;
            max-height: 125px
        }

        #logoctr {
            display: none
        }

        #logo:hover #logoctr,
        #logo.edit #logoctr {
            display: block;
            text-align: right;
            line-height: 25px;
            background: #eee;
            padding: 0 5px
        }
        .edit #save-logo,
        .edit #cancel-logo {
            display: inline
        }

        .edit #image,
        #save-logo,
        #cancel-logo,
        .edit #change-logo,
        .edit #delete-logo {
            display: none
        }

        #customer-title {
            font-size: 20px;
            font-weight: 700;
            float: left
        }

        #meta {
            margin-top: 1px;
            width: 300px;
            float: right
        }

        #meta td {
            text-align: right
        }

        #meta td.meta-head {
            text-align: left;
            background: #eee
        }

        #meta td textarea {
            width: 100%;
            height: 20px;
            text-align: right
        }

        #items {
            clear: both;
            width: 100%;
            margin: 30px 0 0;
            border: 1px solid #000
        }

        #items th {
            background: #eee
        }

        #items textarea {
            width: 80px;
            height: 50px
        }

        #items tr.item-row td {
            border: 0;
            vertical-align: top
        }

        #items td.description {
            width: 300px
        }

        #items td.item-name {
            width: 175px
        }

        #items td.description textarea,
        #items td.item-name textarea {
            width: 100%
        }

        #items td.total-line {
            border-right: 0;
            text-align: right
        }

        #items td.total-value {
            border-left: 0;
            padding: 10px
        }

        #items td.total-value textarea {
            height: 20px;
            background: 0 0
        }

        #items td.balance {
            background: #eee
        }

        #items td.blank {
            border: 0
        }

        #terms {
            text-align: center;
            margin: 20px 0 0
        }

        #terms h5 {
            text-transform: uppercase;
            font: 13px Helvetica, Sans-Serif;
            letter-spacing: 10px;
            border-bottom: 1px solid #000;
            padding: 0 0 8px;
            margin: 0 0 8px
        }

    </style>
</head>

<body>
    <div id="page-wrap">
        <h1 style="text-align: center;">{{ $type . ' :' }}</h1>
        <br>
        <div style="clear:both"></div>
        <div id="customer">

            @if(isset($clinic) && $clinic!=null)
                <label for="">Clinique :</label>
                <label for="">{{ $clinic->name }}</label>
                <br>

                <label for="">Addresse :</label>
                <label for="">{{ $clinic->address }}</label>
                <br>

                <label for="">Numero de telephone :</label>
                <label for="">{{ $clinic->phone_number }}</label>
                <br>
                <br>
            @endif

                <h5>Information Medecin :</h5>
                <label for="">Medecin :</label>
                <label for="">{{ 'Dr.' .$doctor->last_name . ' ' . $doctor->first_name }}</label>
                <br>
                @if($doctor->specialty!="")
                    <label for="">Spécialite :</label>
                    <label for="">{{ $doctor->specialty }}</label>
                    <br>
                @endif
                <label for="">Email :</label>
                <label for="">{{ $doctor->email }}</label>
                <br>
                <br>


                <h5>Information Patient :</h5>
                <label for="">Patient :</label>
                <label for="">{{ $patient->last_name . ' ' . $patient->first_name }}</label>
                <br>
                @if($patient->social_security_number!="")
                    <label for="">SSN :</label>
                    <label for="">{{ $patient->social_security_number }}</label>
                    <br>
                @endif
                <label for="">Numero de telephone :</label>
                <label for="">{{ $patient->phone_number }}</label>
                <br>
                <label for="">Email :</label>
                <label for="">{{ $patient->email }}</label>
                <br>
                <label for="">Addresse :</label>
                <label for="">{{ $patient->address }}</label>
                <br>
                <br>
        </div>


        @yield('printContent')

    </div>
</body>
</html>
