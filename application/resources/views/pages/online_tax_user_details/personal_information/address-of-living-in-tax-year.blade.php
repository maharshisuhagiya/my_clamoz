<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="mb-3">Addresses Lived During Tax Year</h4>

        @if(isset($addresses) && count($addresses) > 0)

            @foreach($addresses as $a)

            <div class="border-bottom pb-3 mb-3">

                <div class="row">

                    <div class="col-md-4 mb-2">
                        <label class="fw-bold">Address Of:</label>
                        <div>{{ $a->address_of }}</div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <label class="fw-bold">From:</label>
                        <div>{{ $a->from_date }}</div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <label class="fw-bold">To:</label>
                        <div>{{ $a->to_date }}</div>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Complete Address:</label>
                        <div>{{ $a->full_address }}</div>
                    </div>

                </div>

            </div>

            @endforeach

        @else

            <div class="text-center py-4">
                <h6 class="text-muted mb-0">No address found</h6>
            </div>

        @endif

    </div>
</div>
