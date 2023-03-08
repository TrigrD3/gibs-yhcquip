<x-app-layout>
    @push('styles')
    <style>
    .img-custom img {
        max-width: 300px;
        max-height: 200px;
        margin: 0;
        padding: 0;
    }
    </style>

        
    @endpush
    
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Event</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.event.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Events Data</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Poster</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-align-middle">
                            @forelse ($events as $event)
                                <tr>
                                    <td scope="row">{{ $event->title }}</td>
                                    <td style="white-space: pre-wrap; max-width: 200px">{{ Str::limit($event->description, 50) }}</td>
                                    

                                    <td>{{ $event->location }}</td>
                                    <td>{{ $event->date }}</td>
                                    <td class="img-custom">@if ($event->getFirstMedia('images'))
                                        <img src="{{ $event->getFirstMediaUrl('images') }}" class="img-thumbnail" alt="">
                                    @endif</td>
                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.event.edit', $event) }}">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="{{ route('admin.event.show', $event) }}">Show</a>
                                        <form action="{{ route('admin.event.destroy', $event) }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                    </td>
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
        </div>
    </div>
    <!-- End Content -->
    
    @include('scripts.delete')
</x-app-layout>
