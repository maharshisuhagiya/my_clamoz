<form id="uploadDocumentsForm" enctype="multipart/form-data">
@csrf

<h4 class="text-primary mb-2">UPLOAD THE DOCUMENTS</h4>
<p style="font-size:14px;color:#555;">
    Download Document and Fill information and upload under Upload Files options like W2.
</p>

<div id="upload-wrapper">

    <div class="upload-block border p-3 mb-3">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Document Type *</label>

                @php
                    $docTypes = [
                        "W2 - Wage Income",
                        "Interview Document",
                        "1099-INT Interest Income",
                        "1099-DIV - Dividend Income",
                        "1099-G - State Tax Refunds",
                        "1099 MISC - Miscellaneous Income",
                        "1099 R - Retirement Income",
                        "1099-B - Stock/Shares Documents",
                        "1095-A Health Insurance",
                        "1098 - Home Mortgage Statement",
                        "1098-E Student Loan Interest Statement",
                        "1098-T Tuition Fee Statement",
                        "Real Estate and Personal Property Taxes Paid",
                        "Foreign Income Certificate",
                        "IRA Contribution",
                        "HSA Contribution",
                        "Other"
                    ];
                @endphp

                <select name="doc_type[]" class="form-control">
                    <option value="">Select Doc Type</option>

                    @foreach($docTypes as $type)
                        <option value="{{ $type }}"
                            {{ old('doc_type', $selectedType ?? '') == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>

                <small class="error-text doc_type_error"></small>
            </div>

            <div class="col-md-6 mb-3">
                <label>Document Upload *</label>
                <input type="file" name="document[]" class="form-control">
                <small class="error-text document_error"></small>
            </div>

        </div>

        <button type="button" class="btn btn-danger btn-sm remove-block d-none">Remove</button>

    </div>

</div>

</form>

@if(isset($documents) && count($documents) > 0)

<h5 class="mt-4 mb-3 text-primary">Uploaded Documents</h5>

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
                <a href="{{ 'storage/' . $d->file_path }}" target="_blank" class="btn btn-info btn-sm">
                    Download
                </a>
            </td>
            <td>{{ $d->created_at->format('d-m-Y h:i A') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif
