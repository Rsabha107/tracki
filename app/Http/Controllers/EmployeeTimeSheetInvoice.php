<?php

namespace App\Http\Controllers;

use App\Models\EmployeeTimeSheet;
use App\Models\EmployeeTimeSheetEntry;
use App\Models\InvoiceNote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Seller;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\NumberFormatter;


// ...
class EmployeeTimeSheetInvoice extends Controller
{

    public function index()
    {
        //
        // dd($id);
        $invoice_note = InvoiceNote::all();
        // dd($emps);



        // dd(FacadesRoute::currentRouteName());
        // dd(FacadesRequest::url());
        return view('tracki.setting.invoice.notes.list', compact('invoice_note'));
    }

    public function get($id)
    {
        $op = InvoiceNote::findOrFail($id);
        return response()->json(['op' => $op]);
    }

    public function update(Request $request)
    {

        $rules = [
            'note_1' => 'sometimes|max:1000',
            'note_2' => 'sometimes|max:1000',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Log::info($validator->errors());
            $error = true;
            // $message = 'InvoiceNote not create.';
            $message = implode($validator->errors()->all());
        } else {
            $user_id = Auth::user()->id;
            $op = InvoiceNote::findOrFail($request->id);

            $error = false;
            $message = 'Gender created.';

            $op->note_1 = $request->note_1;
            $op->note_2 = $request->note_2;
            $op->created_by = $user_id;
            $op->updated_by = $user_id;
            $op->save();
        }

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function list()
    {

        // dd('test');
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $op = InvoiceNote::orderBy($sort, $order);


        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('address1', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%');
            });
        }
        $total = $op->count();

        $op = $op->paginate(request("limit"))->through(function ($op) {

            $actions_div = '<div class="font-sans-serif btn-reveal-trigger position-static">';

            $actions_edit =
                '<a href="javascript:void(0)" class="btn btn-sm" id="edit_invoice_notes" data-id="' . $op->id .
                '" data-table="invoice_note_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';

            $actions = $actions_div . $actions_edit;

            return [
                'id1' => '<div class="ms-3">' . $op->id . '</div>',
                'id' => $op->id,
                'note_1' => '<div class="ms-1">' . $op->note_1 . '</div>',
                'note_2' => '<div class="ms-1">' . $op->note_2 . '</div>',
                'actions' => $actions,
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $op->items(),
            "total" => $total,
        ]);
    }

    public function invoice($id)
    {
        $timesheet = EmployeeTimeSheet::findOrFail(decrypt($id));

        // $customer = new Buyer([
        //     'name'          => 'John Doe',
        //     'custom_fields' => [
        //         'email' => 'test@example.com',
        //     ],
        // ]);

        $customer = new Buyer([]);

        $client = new Party([
            'name'          => $timesheet->employees->full_name,
            'phone'         => $timesheet->employees->phone_number,
            'address'       => '123 street',
            // 'custom_fields' => [
            //     'note'        => 'IDDQD',
            //     'business id' => '365#GG',
            // ],
        ]);

        $bill_to = new Party([
            'name'          => 'Qatar Football Association',
            // 'phone'         => $timesheet->employees->phone_number,
            'address'       => '36th Floor, Al Bidda Tower',
            'address2'       => 'Corniche Street, PO Box 5333',
            // 'custom_fields' => [
            //     'note'        => 'IDDQD',
            //     'business id' => '365#GG',
            // ],
        ]);

        $note = InvoiceNote::first();

        $item = InvoiceItem::make($timesheet->timesheet_period . ' Freelancer service for the month')
            ->pricePerUnit(1)
            // ->discount(3)
            ->days_worked($timesheet->days_worked)
            ->leave_days_taken($timesheet->leave_taken)
            ->unpaid_leaves($timesheet->unpaid_leave_taken)
            ->total_days_eligible($timesheet->total_days_eligible_for_payment)
            ->daily_rate($timesheet->daily_rate)
            ->salary($timesheet->salary)
            ->payment($timesheet->total_payment);


        $invoice = Invoice::make()->template('timesheet')
            ->buyer($bill_to)
            ->seller($client)
            ->status('approved')
            ->currencyCode('QAR')
            ->currencySymbol('')
            ->notes($timesheet->note_1)
            ->notes2($timesheet->note_2)
            ->approvedBy($timesheet->performer?->full_name)
            ->totalAmount($timesheet->total_payment)
            ->series(str_pad((string) $timesheet->month_selected_id, 2, 0, STR_PAD_LEFT).''.$timesheet->year_selected)
            ->dateFormat('d/m/Y')
            ->sequence($timesheet->employees->id)
            ->currencyThousandsSeparator(',')
            ->filename($timesheet->employees->full_name.str_pad((string) $timesheet->month_selected_id, 2, 0, STR_PAD_LEFT).$timesheet->year_selected.$timesheet->employees->id)
            // ->discountByPercent(10)
            // ->taxRate(15)
            // ->shipping(1.99)
            ->addItem($item);

        return $invoice->stream();
        // return $invoice->stream();
    }
}
