<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationRequest;
use App\Jobs\ProcessNewDonation;
use App\Services\DonationService;

class DonationController extends Controller
{
    public function __construct(DonationService $donationService)
    {
        $this->service = $donationService;
    }

    public function showDashboard()
    {
        $maxDonation = $this->service->getMaxDonation();
        $donationsSumCurrentDay = $this->service->getDonationsDay();
        $donationsSumLastMonth = $this->service->getDonationsLastMonth();
        $donationsGroupByDay = $this->service->getDonationsGroupByDay();
        $allItems = $this->service->getAllPagintion();

        return view(
            'dashboard',
            [
                'maxDonationName'   => (!empty($maxDonation['name'])) ? $maxDonation['name'] : '',
                'maxDonation'       => (!empty($maxDonation['donation'])) ? $maxDonation['donation'] : 0,
                'sumCurrentDay'     => $donationsSumCurrentDay,
                'sumLastMonth'      => $donationsSumLastMonth,
                'sumByDays'         => $donationsGroupByDay,
                'allItems'          => $allItems
            ]
        )->render();
    }

    public function showDonationForm()
    {
        return view('make_donation')->render();
    }

    public function createDonation(StoreDonationRequest $request)
    {
        $validated = $request->validated();

        $newEntry = $this->service->create(
            [
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'donation'  => $validated['donation'],
                'message'   => $validated['message']
            ]
        );

        ProcessNewDonation::dispatch($newEntry);

        return redirect()->route('donation.form');
    }
}
