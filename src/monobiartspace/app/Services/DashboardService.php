<?php

namespace App\Services;

use App\Models\Pendaftaran;
use App\Models\PembayaranBooking;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getPembayaranSummary(): \stdClass
    {
        $data = PembayaranBooking::select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as total'))
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        return (object)[
            'pemasukan' => $data['settlement']->total ?? 0,
            'success'   => $data['settlement']->count ?? 0,
            'pending'   => ($data['pending']->count ?? 0) + ($data['']->count ?? 0),
        ];
    }

    public function getPendaftaranSummary(): \Illuminate\Support\Collection
    {
        $grouped = Pendaftaran::select('type', DB::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->get();

        $total = $grouped->sum('count');

        $pendaftaran = $grouped->mapWithKeys(function ($item) use ($total) {
            return [
                $item->type => (object)[
                    'name'       => ucfirst($item->type),
                    'count'      => $item->count,
                    'percentage' => round(($item->count / $total) * 100, 2),
                ]
            ];
        });

        $pendaftaran->put('total', $total);
        return $pendaftaran;
    }

    public function getChartSeries(int $tahun): array
    {
        $chart = Pendaftaran::selectRaw('type, MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', $tahun)
            ->groupBy('type', 'bulan')
            ->orderBy('bulan')
            ->get();

        $types = ['artspace', 'kids'];
        $monthly = collect($types)->mapWithKeys(fn($t) => [$t => array_fill(1, 12, 0)]);

        foreach ($chart as $row) {
            $monthly = $monthly->map(function ($value, $key) use ($row) {
                if ($key === $row->type) {
                    $value[$row->bulan] = $row->total;
                }
                return $value;
            });
        }

        return $monthly->map(fn($v, $k) => [
            'name' => ucfirst($k),
            'data' => array_values($v),
        ])->values()->toArray();
    }
}
