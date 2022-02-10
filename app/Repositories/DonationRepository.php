<?php

namespace App\Repositories;

use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DonationRepository extends BaseRepository
{
    public function __construct(Donation $model)
    {
        $this->model = $model;
    }

    public function getMaxDonation()
    {
        $item = $this->model::orderBy('donation', 'desc')->first();

        return (!empty($item->name)) ? ['name' => $item->name, 'donation' => $item->donation] : [];
    }

    public function getDonationsDay()
    {
        return $this->model::whereDate('created_at', Carbon::today())->sum('donation');
    }

    public function getDonationsLastMonth()
    {
        $lastMonth = Carbon::today()->startOfMonth()->subMonth(1);
        $currentMonth = Carbon::today()->startOfMonth();
        return $this->model::whereBetween('created_at', [$lastMonth, $currentMonth])->sum('donation');
    }

    public function getDonationsGroupByDay()
    {
        $items = $this->model::orderBy('date')
            ->groupBy('date')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('SUM(donation) as donations')
            ));
        $result = [['date', 'donations']];
        foreach ($items as $key => $value) {
            $result[++$key] = [$value->date, (float)$value->donations];
        }

        return $result;
    }

    public function getAllPagintion(int $size = 10)
    {
        return $this->model::paginate($size);
    }
}
