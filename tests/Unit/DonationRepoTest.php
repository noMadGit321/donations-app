<?php

namespace Tests\Unit;

use App\Models\Donation;
use App\Repositories\DonationRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DonationRepoTest extends TestCase
{
    use RefreshDatabase;

    private $repo;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo = resolve(DonationRepository::class);
    }

    public function test_max_donation_works_correctly()
    {
        $collection = Donation::factory()->count(3)->create();

        $max = 0;

        foreach($collection as $item) {
            $max = ($item->donation > $max) ? $item->donation : $max;
        }

        $maxDonation = $this->repo->getMaxDonation();

        $this->assertEquals($max , $maxDonation['donation']);
    }

    public function test_get_day_donations_works_correctly() {
        $collection = Donation::factory()->count(3)->create();

        $item = $collection[0];
        $item->created_at = new \DateTime('2022-02-01');
        $item->save();

        $sum = 0;

        foreach($collection as $item) {
            $diff = date_diff(new \DateTime(), $item->created_at);
            if ($diff->days <= 1) {
                $sum += $item->donation;
            }
        }

        $sumDonation = $this->repo->getDonationsDay();

        $this->assertEquals($sum , $sumDonation);
    }

    public function test_get_last_month_donations_works_correctly() {
        $collection = Donation::factory()->count(5)->create();

        $item1 = $collection[0];
        $item2 = $collection[1];

        $item1->created_at = new \DateTime('2022-01-01');
        $item1->save();

        $item2->created_at = new \DateTime('2022-01-01');
        $item2->save();

        $sum = 0;

        foreach($collection as $item) {
            $diff = date_diff(new \DateTime(), $item->created_at);
            $months = 12 * $diff->y + $diff->m;
            if ($months == 1) {
                $sum += $item->donation;
            }
        }

        $sumLastMonth = $this->repo->getDonationsLastMonth();

        $this->assertEquals($sum, $sumLastMonth);
    }

    public function test_get_donations_group_by_day_works_correctly() {
        $collection = Donation::factory()->count(5)->create();

        $sum = 0;

        foreach($collection as $item) {
            $diff = date_diff(new \DateTime(), $item->created_at);
            if ($diff->days <= 1) {
                $sum += $item->donation;
            }
        }

        $currentDate = new \DateTime();
        $dateStr = date_format($currentDate, 'Y-m-d');

        $array = [['date', 'donations']];
        array_push($array, [$dateStr, $sum]);

        $arrGrpBy = $this->repo->getDonationsGroupByDay();
        $this->assertEquals($array, $arrGrpBy);
    }
}
