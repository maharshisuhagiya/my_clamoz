<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxpayer;
use App\Models\Spouse;
use App\Models\Dependent;
use App\Models\Address;
use App\Models\TaxNote;
use App\Models\UploadDocument;
use App\Models\BankDetail;
use App\Models\OtherIncomeEntry;
use App\Models\OtherExpenseEntry;
use App\Models\RequiredStateEntry;

class OnlineTaxController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $taxpayer  = Taxpayer::where('user_id', $userId)->first();
        $spouse    = Spouse::where('user_id', $userId)->first();
        $dependent = Dependent::where('user_id', $userId)->first();
        $addresses = Address::where('user_id', $userId)->get();
        $taxnotes = TaxNote::where('user_id', $userId)->first();
        $documents = UploadDocument::where('user_id', $userId)->get();
        $bank = BankDetail::where('user_id', $userId)->first();
        $otherIncomeEntries = OtherIncomeEntry::where('user_id', $userId)->get()->keyBy('question_no');
        $otherExpenseEntries = OtherExpenseEntry::where('user_id', $userId)->get()->keyBy('question_no');
        $stateEntries = RequiredStateEntry::where('user_id', $userId)->get()->keyBy('question_no');

        return view('pages.online_tax.index', compact('taxpayer','spouse','dependent','addresses','taxnotes','documents','bank','otherIncomeEntries', 'otherExpenseEntries', 'stateEntries'));
    }

    // ---------------------- TAXPAYER ----------------------
    public function saveTaxpayer(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'mobile'     => 'required|digits:10',
            'alt_mobile' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = Taxpayer::updateOrCreate(
            ['user_id' => auth()->id()],
            array_merge($request->all(), [
                'user_id' => auth()->id()
            ])
        );

        return response()->json([
            'status'  => true,
            'message' => 'Taxpayer Information Saved!',
            'data'    => $data
        ]);
    }

    // ---------------------- SPOUSE ----------------------
    public function saveSpouse(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = Spouse::updateOrCreate(
            ['user_id' => auth()->id()],
            array_merge($request->all(), [
                'user_id' => auth()->id()
            ])
        );

        return response()->json([
            'status'  => true,
            'message' => 'Spouse Information Saved!',
            'data'    => $data
        ]);
    }

    // ---------------------- DEPENDENT (one record for now) ----------------------
    public function saveDependent(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name'   => 'required',
            'last_name'    => 'required',
            'dob'          => 'required',
            'gender'       => 'required',
            'relationship' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $dependent = Dependent::updateOrCreate(
            ['user_id' => auth()->id()],
            array_merge($request->all(), [
                'user_id' => auth()->id()
            ])
        );

        return response()->json([
            'status'  => true,
            'message' => 'Dependent Information Saved Successfully!',
            'data'    => $dependent
        ]);
    }

    public function saveAddress(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'address_of.*'   => 'required',
            'from_date.*'    => 'required',
            'to_date.*'      => 'required',
            'full_address.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // DELETE old user addresses before inserting new ones
        Address::where('user_id', auth()->id())->delete();

        // INSERT multiple records
        foreach ($request->address_of as $index => $value) {

            Address::create([
                'user_id'      => auth()->id(),
                'address_of'   => $request->address_of[$index],
                'from_date'    => $request->from_date[$index],
                'to_date'      => $request->to_date[$index],
                'full_address' => $request->full_address[$index],
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Address Information Saved Successfully!'
        ]);
    }

    public function saveTaxNotes(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'date'  => 'required',
            'time'  => 'required',
            'zone'  => 'required',
            'query' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = TaxNote::updateOrCreate(
            ['user_id' => auth()->id()],
            array_merge($request->all(), [
                'user_id' => auth()->id()
            ])
        );

        return response()->json([
            'status'  => true,
            'message' => 'Scheduled Tax Note Saved!',
            'data'    => $data
        ]);
    }

    public function saveUploadDocuments(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'doc_type.*' => 'required',
            'document.*' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // SAVE MULTIPLE FILES
        foreach ($request->doc_type as $index => $type) {

            if ($request->hasFile('document.' . $index)) {

                $file = $request->file('document.' . $index);

                $path = $file->store('uploads/documents', 'public');

                UploadDocument::create([
                    'user_id'   => auth()->id(),
                    'doc_type'  => $type,
                    'file_path' => $path,
                ]);
            }
        }

        return response()->json([
            'status'  => true,
            'message' => 'Documents Uploaded Successfully!'
        ]);
    }

    public function saveBank(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'bank_name'      => 'required',
            'account_number' => 'required',
            'routing_number' => 'required',
            'account_type'   => 'required',
            'account_holder' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        BankDetail::updateOrCreate(
            ['user_id' => auth()->id()],
            array_merge($request->all(), ['user_id' => auth()->id()])
        );

        return response()->json([
            'status'  => true,
            'message' => 'Bank Information Saved Successfully!'
        ]);
    }

    public function saveIncome(Request $request)
    {
        $userId = auth()->id();

        // VALIDATION: Yes/No required
        $rules = [];
        for ($i = 1; $i <= 17; $i++) {
            $rules["q$i"] = 'required|in:Yes,No';
        }

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Delete old rows
        OtherIncomeEntry::where('user_id', $userId)->delete();

        // Insert 17 new rows
        for ($i = 1; $i <= 17; $i++) {

            $yesNo = $request->input("q$i");
            $text  = $request->input("extra_q$i");

            OtherIncomeEntry::create([
                'user_id'      => $userId,
                'question_no'  => $i,
                'yes_no'       => $yesNo,
                'text'         => $yesNo == "Yes" ? $text : null,
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Other Income Details Saved Successfully!'
        ]);
    }

    public function saveExpenses(Request $request)
    {
        $userId = auth()->id();

        // VALIDATION for 19 questions
        $rules = [];
        for ($i = 1; $i <= 19; $i++) {
            $rules["ex$i"] = 'required|in:Yes,No';
        }

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Remove old rows
        OtherExpenseEntry::where('user_id', $userId)->delete();

        // Insert new rows
        for ($i = 1; $i <= 19; $i++) {

            $yesNo = $request->input("ex$i");
            $text  = $request->input("extra_ex$i");

            OtherExpenseEntry::create([
                'user_id'     => $userId,
                'question_no' => $i,
                'yes_no'      => $yesNo,
                'text'        => $yesNo == "Yes" ? $text : null
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Other Expenses Saved Successfully!'
        ]);
    }

    public function saveStateInfo(Request $request)
    {
        $userId = auth()->id();

        // VALIDATION
        $rules = [];
        for ($i = 1; $i <= 8; $i++) {
            $rules["s$i"] = 'required|in:Yes,No';
        }

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // DELETE old data
        RequiredStateEntry::where('user_id', $userId)->delete();

        // INSERT new records
        for ($i = 1; $i <= 8; $i++) {

            $yesNo = $request->input("s$i");
            $text  = $request->input("extra_s$i");

            RequiredStateEntry::create([
                'user_id'     => $userId,
                'question_no' => $i,
                'yes_no'      => $yesNo,
                'text'        => $yesNo == "Yes" ? $text : null,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Required State Information Saved Successfully!'
        ]);
    }
}
