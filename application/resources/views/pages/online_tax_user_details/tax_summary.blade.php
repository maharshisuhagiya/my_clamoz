<form id="summaryForm" enctype="multipart/form-data">
@csrf

<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="text-primary mb-2">MY SUMMARY</h4>

        <input type="hidden" name="user_id" value="{{ $userId }}">
        <label><strong>Summary Description</strong></label>
        <textarea id="summaryText" name="summary_text" class="form-control" rows="6">
            {{ $summaryText->summary_text ?? '' }}
        </textarea>
        <small class="error-text summary_text_error"></small>

        <div class="mt-3">
            <label><strong>Upload Files</strong></label>
            <input type="file" name="summary_files[]" class="form-control" multiple>
            <small class="error-text summary_files_error"></small>
        </div>

        <button class="btn btn-primary mt-3" id="saveSummaryBtn">Save Summary</button>
    </div>
</div>

@if(isset($summaryFiles) && count($summaryFiles) > 0)
<div class="card shadow-sm mt-4">
    <div class="card-body">
        <h5 class="text-primary mb-3">Uploaded Summary Files</h5>

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
                        <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank" class="btn btn-info btn-sm">
                            Download
                        </a>
                    </td>
                    <td>{{ $file->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

</form>