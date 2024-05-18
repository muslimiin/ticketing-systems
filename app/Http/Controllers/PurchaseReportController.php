<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Event;

class PurchaseReportController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua event untuk dropdown filter
        $events = Event::all();

        // Query dasar untuk transaksi
        $query = Transaction::with(['event']);

        // Filter berdasarkan event jika ada
        if ($request->has('event') && $request->event != '') {
            $query->where('event_id', $request->event);
        }

        // Filter berdasarkan tanggal mulai jika ada
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        // Filter berdasarkan tanggal selesai jika ada
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Dapatkan hasil filter
        $transactions = $query->get();

        return view('reports.purchases', [
            'transactions' => $transactions,
            'events' => $events,
        ]);
    }
}
