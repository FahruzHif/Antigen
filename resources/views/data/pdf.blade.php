<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style type="text/css">
        .center{
            text-align: center;
        }
        .right{
            text-align: right;
        }
        .left{
            text-align: left;
        }
        .full{
            width: 110%;
        }
        .half{
            width : 85%;
        }
        .small{
            width : 50%;
        }
        .middle{
            width : 78%;
        }
        .mid{
            width : 100%;
        }
        .wrapper{
            padding-left: 30px;
            padding-right: 30px;
        }
        .wrapper1{
            padding-right: 30px;
        }
        .col-md-{
            column-width: 30px;
            max-container-width: 720px;
        }
        .left-container{
            padding-left: 0px;
            padding-right: 20px;
        }
        .right-container{
            padding-left: 200px;
            padding-right: 15px;
        }
        .underline{
            text-decoration: underline;
        }
        .bt-1{
            border-top: 1px solid black;
        }
        .bb-1{
            border-bottom: 1px solid black;
        }
        .br-1{
            border-right: 1px solid black;
        }
        .bl-1{
            border-left: 1px solid black;
        }
        .mt-1{
            margin-top: 5px;
        }
        .mt-2{
            margin-top: 15px;
        }
        .mb-1{
            margin-bottom: 5px;
        }
        .pdl{
            padding-left: 35px;
        }
        table tr th,table tr td{
            text-align: left;
        }
        .table-borderless{  
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <img style="height:60px width: 140px; float:right;" src="img/logo.png">
        <h3 class="left">LAPORAN HASIL LABORATORIUM</h3><br>
    </div>

    <div class="wrapper">
        <div class="bt-1">
            <div class="mt-1">
                <table class="full left-container table table-borderless mt-1">
                    <tbody>
                    <tr>
                        <th>No. Lab</th>
                        <td>{{ $pasien->no_lab }}</td>
                        <th>Nama Dokter</th>
                        <td>{{ $pasien->nama_dok }}</td>
                    </tr>
                    <tr>
                        <th>No. Rekam Medis</th>
                        <td>{{ $pasien->no_rm }}</td>
                        <th>Lokasi</th>
                        <td>{{ $pasien->lokasi }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $pasien->nama }}</td>
                        <th>Tanggal Transaksi</th>
                        <td>{{ $pasien->updated_at }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ date('d-m-Y', strtotime($pasien->tgl_lahir)) }}</td>
                        <th>Hasil Selesai</th>
                        <td>{{ $pasien->updated_at }}</td>
                    </tr>
                    <tr>
                        <th>Umur</th>
                        <td>{{ $pasien->umur }}</td>
                        <th>Tanggal Cetak</th>
                        <td><?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d  H:i:s");?></td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td>{{ $pasien->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $pasien->alamat }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="wrapper1">
        <table class="full left-container table table-borderless mt-1 mb-1">
            <thead class="bt-1 bb-1 mb-1">
                <tr>
                    <th scope="col">PEMERIKSAAN</th>
                    <th scope="col">METODE</th>
                    <th scope="col" style="text-align:center;">Ig M</th>
                    <th scope="col" style="text-align:center;">Ig G</th>
                    <th scope="col" style="text-align:center;">HASIL</th>
                </tr>
            </thead>

            <tbody class="mt-2">
                <tr>
                    <td><i><b>IMUNOLOGI</b></i></td>
                <tr>
                    <td><b>SARS-Cov-2</b></td>
                    <td>{{ $pasien->metode }}</td>
                    <td style="text-align:center;">{{ $pasien->igm }}</td>
                    <td style="text-align:center;">{{ $pasien->igg }}</td>
                    <td style="text-align:center;">
                        @if ($pasien->igm == "Positif" && $pasien->igg == "Positif")
                            Positif
                        @elseif ($pasien->igm == "Positif" && $pasien->igg == "Negatif")
                            Positif
                        @elseif ($pasien->igm == "Negatif" && $pasien->igg == "Positif")
                            Negatif
                        @elseif ($pasien->igm == "Negatif" && $pasien->igg == "Negatif")
                            Positif
                        @endif
                    </td>
                <tr>
                    <td><b>Tanggal Tes</b></td>
                    <td>{{ date('d-m-Y', strtotime($pasien->tgl_tes)) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <tbody>
        </table>
    </div>

    {{-- <div class="wrapper mt-2"> --}}
        <div class = "bt-1 bb-1 br-1 bl-1">
            {{-- <div class="mt-1"> --}}
                <table class="full table table-borderless mt-2 mb-1" style="margin-bottom: 10px">
                    <tbody>
                        <tr>
                            <td><i><b>INTERPRETASI</b></i></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        <tr>
                            <div class="pdl" style="margin-bottom: 15px">
                                @if ($pasien -> igm == "Negatif" && $pasien -> igg == "Negatif")
                                    <li> Infeksi baru dimulai </li>
                                    <li> Infeksi biasanya hari ke 1-7 </li>
                                @elseif ($pasien -> igm == "Positif" && $pasien -> igg == "Negatif")
                                    <li> Menuju puncak infeksi di hari ke 7-14 </li>
                                @elseif ($pasien -> igm == "Positif" && $pasien -> igg == "Positif")
                                    <li> Infeksi di puncak </li>
                                    <li> Mulai menurun dan menuju sembuh </li>
                                    <li> Biasanya hari ke 14-21 </li>
                                    <li> Perlu isolasi selama 2 minggu </li>
                                @elseif ($pasien -> igm == "Negatif" && $pasien -> igg == "Positif")
                                    <li> Tidak Terkena infeksi atau berada pada masa inkubasi penyakit </li>
                                    <li> Antibodi belum berkembang </li>
                                @else
                                @endif
                            </div>
                        </tr>
                    </tbody>
                </table>
            {{-- </div> --}}
        </div>
    {{-- </div> --}}
    
    <div class="mt-2">
        <table class="full table table-borderless" style="margin-top: 25px">
            <thead>
            <tr>
                <th scope="col" style="padding-left: 2cm;"> Scan Me!</th>
                <th scope="col" style="text-align: right; padding-right: 3cm;">Dokter Penanggung Jawab</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row"><img style="width: 3cm height: 3cm; margin-left: 52px; margin-top:8px;" src="data:image/png;base64, {!! $qrcode !!}"></th>
                <th></th>
            </tr>
            <tbody>
                <th></th>
                <tr><h4 class="right" style="text-align: right; padding-right: 95px;">{{ $pasien->nama_dok }}</h4></tr>
            </tbody>
            </tbody>
        </table>
    </div>

    <br/>
    <br/>
    <hr/>
    <footer class="center mid">
        <p>&copy; <a href="http://127.0.0.1:8000/profile">www.antigentest.com</p>
    </footer>
</body>
</html>