<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tiket Penerbangan</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('user/assets/img/favicon.ico')}}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- Third party plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('user/css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<style type="text/css">
    header.masthead {
        padding-top: 10rem;
        padding-bottom: calc(10rem - 4.5rem);
        background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%),
        url("{{asset('user/assets/img/bg-header.jpg')}}");
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-size: cover;
    }

    .text-white-75 {
        color: #FFFF;
    }
</style>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Tiket Penerbangan</a>

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Kontak Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold">Jadwal Tiket Penerbangan</h1>
                    <hr class="divider my-4" />
                </div>

                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 font-weight-light mb-5">Tiper adalah sebuah website platform yang memberikan informasi tentang jadwal penerbangan pesawat.</p>
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Pelajari Lebih Lanjut</a>
                    <a class="btn btn-secondary btn-xl" href="{{ url('login') }}" style="background-color: #fff; color: #000;">Login</a>
                </div>
            </div>
        </div>
    </header>

    <!-- About-->
    <section class="page-section" id="about" style="background-color: #0278ae;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">Kami menyediakan berbagai macam tiket penerbangan ke seluruh dunia!</h2>

                    <hr class="divider light my-4" />

                    <p class="text-white-50 mb-4">Kami menyediakan berbagai macam tiket penerbangan dengan harga yang relatif murah yang bisa mengantarkan anda ke seluruh dunia.</p>

                    <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Layanan Kami</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <h2 class="text-center mt-0">Layanan Kami</h2>

            <hr class="divider my-4" />

            <form id="frmSearch" action="{{ url()->current() . '/get_jadwal' }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-5">
                        <select class="form-control" name="bandara_asal" required>
                            <option value="" selected disabled>-- Bandara Asal --</option>

                            @foreach($bandara as $b)
                            <option value="{{$b->id_bandara}}">{{$b->nama_bandara}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-5">
                        <select class="form-control" name="bandara_tujuan" required>
                            <option value="" selected disabled>-- Bandara Tujuan --</option>

                            @foreach($bandara as $b)
                            <option value="{{$b->id_bandara}}">{{$b->nama_bandara}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>

                    <div class="col-md-12" id="content_result">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Contact-->
    <section class="page-section" id="contact" style="background-color: #eee;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0">Kontak Kami</h2>

                    <hr class="divider my-4" />

                    <p class="text-muted mb-5">Kami bersedia memberikan anda prioritas yang terbaik dengan cara menghubungi kami melalui kontak dibawah ini!</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                    <div>+1 (555) 123-4567</div>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>

                    <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                    <a class="d-block" href="mailto:contact@yourwebsite.com">contact@yourwebsite.com</a>
                </div>
            </div>
        </div>
    </section>

    <div id="ModalGlobal" class="modal modal-fade" tabindex="-1" role="dialog"></div>

    <!-- Footer-->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">Copyright &copy; {{ date('Y') }} - Tiket Penerbangan</div>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <!-- Core theme JS-->
    <script src="{{asset('user/js/scripts.js')}}"></script>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script>
        $('#frmSearch').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let elementsForm = $(this).find('button, select');

            elementsForm.attr('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    elementsForm.removeAttr('disabled');

                    if (response.RESULT == 'OK') {
                        $('#content_result').html(response.CONTENT);
                    }
                }
            }).fail(function() {
                elementsForm.removeAttr('disabled');

                alert('Have an error! Please contact developers');
            });
        });

        function btnOrder(id_jadwal) {
            $.ajax({
                url: '{{ url("order") }}',
                method: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_jadwal: id_jadwal
                },
                success: function(response) {
                    if (response.RESULT == 'OK') {
                        $('#ModalGlobal').html(response.CONTENT);
                        $('#ModalGlobal').modal('show');
                    } else {
                        alert(response.MESSAGE);
                    }
                }
            }).fail(function() {
                alert('Have an error! Please contact developers');
            });
        }
    </script>
</body>

</html>