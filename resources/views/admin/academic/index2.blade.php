<x-app-layout>
    @push('styles')
    <style>
.page-header {
    /* Set the background image */
    background-image: url("../img/banner.png");
    background-size: 100% auto; /* Stretch the image horizontally */
    background-position: center; /* Center the image vertically and horizontally */
    padding: 50px; /* Add some padding to the element */
    color: #fff; /* Set the text color to white */
    text-align: left; /* Set the text alignment to left */
    height: 352px; /* Set the height to 352px */
    display: flex; /* Use flexbox to center the content */
    flex-direction: column; /* Stack the content vertically */
    justify-content: center; /* Center the content vertically */
    align-items: flex-start; /* Align the content to the left */
    font-size: 36px; /* Increase the font size to 36px */
}






    .academics-article img {
        max-width: 100%;
        height: auto;
    }

    </style>

        
    @endpush
    
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <h3>Information</h3>
            </div>
            
            <div class="row">
                <h1>GIBS Outreach Education System</h1>
            </div>

            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-sm btn-primary">See More</button>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        {{-- <div class="card">
            <div class="card-body">
                <h4 class="card-title">Academics Data</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-align-middle">
                            @forelse ($academics as $academic)
                                <tr>
                                    <td scope="row">{{ $academic->title }}</td>
                                    <td style="white-space: pre-wrap; max-width: 200px">{{ Str::limit($academic->description, 50) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        <div class="container academics-article">
            @foreach ($academics as $key => $academic)
            <div class="row align-items-center mb-3">
                <div class="col-md-6 order-md-{{ $key % 2 == 0 ? '1' : '2' }}">
                    @if ($academic->getFirstMedia('image'))
                        <div class="image-container position-relative">
                            <img src="{{ $academic->getFirstMediaUrl('image') }}" class="img-thumbnail rounded-4 shadow-sm" alt="">
                            <img src="{{ asset('img/vector.png') }}" class="img-overlay position-absolute top-0 end-0" alt="">
                            <img src="{{ asset('img/vector.png') }}" class="img-overlay position-absolute bottom-0 start-0" alt="">

                        </div>
                    @endif
                </div>
                <div class="col-md-6 order-md-{{ $key % 2 == 0 ? '2' : '1' }}">
                    <div class="row">
                        <h1>{{ $academic->title }}</h1>
                    </div>
                    <div class="row">
                        <p>{{ $academic->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        

        </div>
        

    </div>
    <!-- End Content -->
    
    @include('scripts.delete')
</x-app-layout>
