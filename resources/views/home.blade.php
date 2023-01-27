<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    {{-- jquery ui --}}
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    {{-- bootstrap icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <style>
        .get-arsip {
            cursor: pointer;
        }
    </style>

</head>

<body>
    <!-- As a heading -->
    <nav class="navbar bg-body-tertiary shadow fixed-top">
        <div class="container">
            <a href="/" class="navbar-brand">
                <span class="navbar-brand mb-0 h1">Navbar</span>
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    @auth
                        <a class="nav-link active" href="/logout">
                            <i class="bi bi-box-arrow-left me-1"></i>
                            Keluar
                        </a>
                    @endauth
                    @guest
                        <a class="nav-link active" href="/login">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Masuk
                        </a>
                    @endguest
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="row mb-3">
            <div class="col-lg-6">
                <form>
                    <div class="input-group">
                        <input type="text" id="search_input" class="form-control"
                            value="{{ app('request')->input('search') }}">
                        <button class="btn btn-primary" type="submit" id="search_submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            @auth
                <div class="col-lg-6">
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal-data"
                        data-bs-target="#modal-data" id="modal-button">
                        Tambahkan Data
                    </button>
                </div>
            @endauth
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal-data" tabindex="-1" aria-labelledby="modal" aria-hidden="true">

        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-sm table-striped">
            <thead class="text-center justify-content-center table-primary">
                <tr>
                    <th scope="col" rowspan="2" class="align-middle">No</th>
                    <th scope="col" rowspan="2" class="align-middle">Kode Klasifikasi</th>
                    <th scope="col" rowspan="2" class="align-middle">Jenis Arsip</th>
                    <th scope="col" rowspan="2" class="align-middle">Deskripsi Arsip</th>
                    <th scope="col" rowspan="2" class="align-middle">Kurun Waktu Tahun</th>
                    <th scope="col" rowspan="2" class="align-middle">Tingkat Perkembangan</th>
                    <th scope="col" rowspan="2" class="align-middle">Jumlah</th>
                    <th scope="col" colspan="2" class="align-middle">Lokasi Simpan</th>
                    <th scope="col" colspan="2" class="align-middle">Nomor Definitif</th>
                    <th scope="col" rowspan="2" class="align-middle">Jangka Simpan dan Nasib Akhir</th>
                    <th scope="col" rowspan="2" class="align-middle">Kategori Arsip</th>
                </tr>
                <tr>
                    <th scope="col">Depot</th>
                    <th scope="col">Rak</th>
                    <th scope="col">Box</th>
                    <th scope="col">Folder</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arsip as $data)
                    @php
                        $no = $loop->iteration + $arsip->perPage() * ($arsip->currentPage() - 1);
                    @endphp
                    <tr @auth class="get-arsip" data-id="{{ $data->id }}" @endauth>
                        <th class="text-center">{{ $no }}
                        </th>
                        <td class="text-center">{{ $data->kode_klasifikasi }}</td>
                        <td class="text-center">{{ $data->jenis_arsip }}</td>
                        <td>{!! $data->deskripsi !!}</td>
                        <td class="text-center">{{ $data->tahun }}</td>
                        <td class="text-center">{{ $data->tingkat_perkembangan }}</td>
                        <td class="text-center">{{ $data->jumlah }}</td>
                        <td class="text-center">{{ $data->lokasi_depot }}</td>
                        <td class="text-center">{{ $data->lokasi_rak }}</td>
                        <td class="text-center">{{ $data->no_box }}</td>
                        <td class="text-center">{{ $data->no_folder }}</td>
                        <td>{{ $data->jangka_simpan }}</td>
                        <td>{{ $data->kategori_arsip }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex">
            {!! $arsip->withQueryString()->links('pagination::bootstrap-5') !!}

        </div>
    </div>

    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    {{-- jquery ui --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <script>
        $('#search_input').keyup(function() {
            $.get("/api/autocomplete", {
                    search: $(this).val()
                },
                function(data) {
                    let availableTags = [];
                    data.forEach(element => {
                        availableTags.push(element.deskripsi);
                    });

                    $("#search_input").autocomplete({
                        source: availableTags
                    });
                },
            );
        });

        $('#search_submit').click(function(e) {
            e.preventDefault();
            let search = $('#search_input').val();
            window.location.href = '/?search=' + search;
        });

        $('#modal-button').click(function() {
            $.get("/api/addarsip", {},
                function(data) {
                    $('#modal-data').html(data);
                    $('#modal-data').modal('toggle');
                },
            );
        });

        $('.get-arsip').click(function(e) {
            const id = $(this).data('id');
            $.get(`/api/getarsip/${id}`, {},
                function(data) {
                    $('#modal-data').html(data);
                    $('#modal-data').modal('toggle');
                },
            );
        });
    </script>
</body>

</html>
