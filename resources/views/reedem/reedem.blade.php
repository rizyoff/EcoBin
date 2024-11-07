<link rel="stylesheet" href="bootstrap.min.css">


<x-app-layout>

    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-light overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-center ">
                    <h1 class="h1 font-italic">{{ __('Halo ' . Auth::user()->name) }},mau tukarkan apa</h1>

                </div>


               <!-- Modal Pop-Up -->
                    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="responseModalLabel">Informasi Penukaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ session('message') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>


                <div class="container text-center">
                    <div class="row">
                        {{-- <div class="col m-1">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Card title</h5>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                              <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                          </div>
                      </div>
                      <div class="col m-1">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('https://www.pngwing.com/id/free-png-zlrdq') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h2 class="card-title h2">Token Listrik</h2>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                              <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                          </div>
                      </div> --}}
                        <div class="col m-1">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('https://upload.wikimedia.org/wikipedia/commons/thumb/9/97/Logo_PLN.png/438px-Logo_PLN.png') }}"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title h2">Token Listrik Rp.10.000</h5>
                                    <p class="card-text">Tukarkan kan sampah anda menjadi anda untuk kepentingan alam
                                    </p>
                                    <form action="{{ route('reedem.point') }}" method="POST">
                                        @csrf
                                        <input id="nominal" type="hidden" name="nominal" value=10000 readonly>
                                        <button type="submit" href="#" class="btn btn-primary">Tukarkan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- Modal Konfirmasi --}}
                <div id="confirmationModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Penukaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin menukarkan poin Anda sebesar Rp. <span
                                        id="nominalDisplay">0</span>?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" onclick="proceedReedem()">Ya,
                                    Tukarkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('tensor.js') }}"></script>
        <script src="bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if(session('status'))
                    // Tampilkan modal jika ada pesan status di sesi
                    var responseModal = new bootstrap.Modal(document.getElementById('responseModal'));
                    responseModal.show();
                @endif
            });
        </script>

</x-app-layout>
