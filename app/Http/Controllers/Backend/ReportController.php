<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use PDF;

class ReportController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('report.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Report !');
        }

        $events = Event::all();
        $query = Transaction::with('ticket', 'event');

        if ($request->has('event_id') && $request->event_id != '') {
            $query->where('event_id', $request->event_id);
        }

        if ($request->has('start_date') && $request->start_date != '' && $request->has('end_date') && $request->end_date != '') {
            $query->whereBetween('transaction_date', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->get();
        return view('backend.pages.reports.index', compact('transactions', 'events'));
    }

    public function generatePDF(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('report.generate')) {
            abort(403, 'Sorry !! You are Unauthorized to view any Report !');
        }

        $query = Transaction::with('ticket', 'event');

        if ($request->has('event_id') && $request->event_id != '') {
            $query->where('event_id', $request->event_id);
        }

        if ($request->has('start_date') && $request->start_date != '' && $request->has('end_date') && $request->end_date != '') {
            $query->whereBetween('transaction_date', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->get();

        $pdf = PDF::loadView('backend.pages.reports.pdf', compact('transactions'));
        return $pdf->download('laporan-pembelian-tiket.pdf');
    }
}
