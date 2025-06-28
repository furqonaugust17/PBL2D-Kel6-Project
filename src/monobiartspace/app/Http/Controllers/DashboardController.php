<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Services\DashboardService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $service)
    {
        $this->dashboardService = $service;
    }

    public function index()
    {
        if (request()->ajax()) {
            $pendaftaran = Pendaftaran::select('pendaftarans.*', 'customers.nama_lengkap as nama_customer', 'customers.notelp', 'users.email')
                ->where('type', 'artspace')
                ->leftJoin('customers', 'customers.id', '=', 'pendaftarans.customer_id')
                ->leftJoin('users', 'users.id', '=', 'customers.user_id')->whereBetween('tanggal_reservasi', [
                    Carbon::today()->startOfDay(),
                    Carbon::today()->addDays(3)->endOfDay()
                ])
                ->latest();
            return DataTables::of($pendaftaran)->addColumn('tanggal_reservasi', function ($row) {
                return $row->tanggal_reservasi != null ? \Carbon\Carbon::parse($row->tanggal_reservasi)->translatedFormat('j F Y') : '-';
            })->filterColumn('pendaftarans.tanggal_reservasi', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_reservasi, '%j %M %Y') LIKE ?", ["%{$keyword}%"]);
            })->make();
        }
        $pembayaran = $this->dashboardService->getPembayaranSummary();
        $pendaftaran = $this->dashboardService->getPendaftaranSummary();
        $chart = $this->dashboardService->getChartSeries(now()->year);
        return view('backend.dashboard.index', compact('pembayaran', 'pendaftaran', 'chart'));
    }

    public function chart(Request $request)
    {
        $tahun = $request->get('tahun', now()->year);
        $series = $this->dashboardService->getChartSeries((int) $tahun);
        return response()->json(['series' => $series]);
    }
}
