@if(isset($documents) && count($documents) > 0)

<div class="card shadow-sm mt-4">
    <div class="card-body">

        <h5 class="mb-3 text-primary">Uploaded Documents</h5>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Document Type</th>
                    <th>File</th>
                    <th>Uploaded At</th>
                </tr>
            </thead>

            <tbody>
                @foreach($documents as $d)
                <tr>
                    <td>{{ $d->doc_type }}</td>
                    <td>
                        <a href="{{ 'storage/' . $d->file_path }}" target="_blank"
                           class="btn btn-info btn-sm">Download</a>
                    </td>
                    <td>{{ $d->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@else

<div class="card shadow-sm mt-4">
    <div class="card-body text-center py-4">
        <h6 class="text-muted mb-0">No documents found</h6>
    </div>
</div>

@endif
