<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Services\DonationService;

class DonationController extends Controller
{
    public function __construct(DonationService $donationService)
    {
        $this->service = $donationService;
    }

    public function showDashboard() {
        $maxDonation = $this->service->getMaxDonation();
        $donationsSumCurrentDay = $this->service->getDonationsDay();
        $donationsSumLastMonth = $this->service->getDonationsLastMonth();
        $donationsGroupByDay = $this->service->getDonationsGroupByDay();
        $allItems = $this->service->getAllPagintion();


        return view('dashboard', [
            'maxDonationName' => (!empty($maxDonation['name']))? $maxDonation['name'] : '',
            'maxDonation' => (!empty($maxDonation['donation']))? $maxDonation['donation'] : 0,
            'sumCurrentDay' => $donationsSumCurrentDay,
            'sumLastMonth' => $donationsSumLastMonth,
            'sumByDays' => $donationsGroupByDay,
            'allItems' => $allItems
        ])->render();
    }

    public function showDonationForm() {
        return view('make_donation')->render();
    }

    public function createDonation(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'donation' => 'required|numeric|between:1,999999',
            'message' => 'nullable|max:2000'
        ]);

        $this->service->create([
            'name' => $request->name,
            'email' => $request->email,
            'donation' => $request->donation,
            'message' => $request->message
        ]);

        return redirect()->route('donation form');
    }
}
