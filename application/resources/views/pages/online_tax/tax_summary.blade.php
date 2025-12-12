<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="text-primary mb-2">MY SUMMARY</h4>

        <label><strong>Summary Description</strong></label>
        <div class="p-3 border rounded bg-light">
            {!! $summaryText->summary_text ?? 'No summary added yet.' !!}
        </div>

    </div>
</div>


<div class="card shadow-sm mt-4">
    <div class="card-body">
        <h5 class="text-primary mb-3">Uploaded Summary Files</h5>

        @if(isset($summaryFiles) && count($summaryFiles) > 0)

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>File</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($summaryFiles as $file)
                    <tr>
                        <td>
                            <a href="{{ asset('storage/' . $file->file_path) }}" 
                               target="_blank" 
                               class="btn btn-info btn-sm">
                                Download
                            </a>
                        </td>
                        <td>{{ $file->created_at->format('d-m-Y h:i A') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        @else

            <div class="alert alert-warning m-0">
                No summary files found.
            </div>

        @endif

    </div>
</div>
