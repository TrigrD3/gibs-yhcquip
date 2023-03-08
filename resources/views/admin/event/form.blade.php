<x-app-layout>

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
                    <a class="btn btn-primary" href="{{ route('admin.event.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div>
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3 card-title">{{ @$event ? 'Edit' : 'Create' }} Event</h4>
                    <form action="{{ $url }}" method="POST">
                        @if (@$event)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title"
                                placeholder="Title of event" value="{{ @$event->title}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Textarea field" rows="4">{{ @$event->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="location">Location</label>
                            <input type="text" id="location" name="location" class="form-control" placeholder="Location" value="{{ @$event->location }}"></input>
                        </div>
                        
                        <!-- Flatpickr -->
                        <div class="mb-3">
                            <label class="form-label" for="date">Date</label>
                            <input type="text" name="date" class="js-flatpickr form-control flatpickr-custom" placeholder="Select date" value="{{ @$event->date }}"
                            data-hs-flatpickr-options='{
                                "dateFormat": "d/m/Y"
                            }'>

                        </div>
                        
                        <!-- End Flatpickr -->

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End Content -->
    @include('scripts.datepicker')
</x-app-layout>
