{{-- <link rel="stylesheet" href="bootstrap.min.css"> --}}

<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 text-dark ">
                    {{ __("You're logged in admin!") }}
                </div>
                <div >
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                     @include('admin.view')
                </div>
            </div>

        </div>

    </div>
</x-app-layout>


