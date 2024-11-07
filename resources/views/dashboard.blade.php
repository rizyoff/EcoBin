<x-app-layout>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <div class="py-12 bg-white">
        {{-- <link rel="stylesheet" href="style.css"> --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 container">
            <div class="bg-light overflow-hidden shadow sm:rounded-lg row">
                <div class="p-6 col-sm">
                    <h1 class="p-2">{{ __('Halo ' . Auth::user()->name) }}</h1>
                    <p class="p-2">jagalingkungan lebih baik dan tukarkan dengan berbagai hal menarik
                    </p>
                    <div>
                        <img src="{{ asset('aktifitas-peduli-lingkungan.jpg')}}" alt="">
                    </div>

                </div>
                <div class="p-6 col-sm ">

                    <div class="text-center">
                        <h1>ayo scan sampah mu disini</h1>
                    </div>
                    <div id="frame_foto" class="container">
                        <div class=" bg-white border p-5 mb-4 d-flex align-items-center justify-content-center"
                            style="width: 600px; height:500px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                class="bi bi-camera" viewBox="0 0 16 16">
                                <path
                                    d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
                                <path
                                    d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                            </svg>
                        </div>

                    </div>

                    <div id="webcam-container"></div>
                    <div id="label-container"></div>
                    <div id="result" class="text-body-secondary text-center"></div>
                    <div class="container">
                        <div class="row">
                            <button class="btn btn-primary col m-3" type="button" onclick="init()">mulai scan</button>
                            <button class="btn btn-success col m-3" type="button" onclick="stopScan()">Selesai</button>
                        </div>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
                    <script src="tensor.js"></script>
                </div>
            </div>
        </div>

        <!-- Popup Overlay -->
        <div class="popup-overlay" id="popupOverlay">
            <div class="popup-card">
                <button class="close-btn p-2" id="closeBtn" onclick="back()">&times;</button>
                <h2>Konfirmasi sampah</h2>
                <p>Pastikan sesuai dengan sampah</p>
                <form action="{{ route('points.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis-sampah" class="form-label">Jenis Sampah</label>
                        <input type="text" class="form-control" name="jenis_sampah" id="jenis-sampah" readonly value="anorganik">
                    </div>
                    <div class="mb-3">
                        <label for="number-berat" class="form-label">Berat</label>
                        <input type="number" class="form-control" name="berat" id="number-berat" required>
                        <p>*dalam satuan kg</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


        <script text="text/javascript" src="{{ asset('bootstrap.bundle.min.js') }}"></script>
</x-app-layout>
