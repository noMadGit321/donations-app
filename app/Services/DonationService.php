<?php

namespace App\Services;

use App\Repositories\DonationRepository;

class DonationService extends BaseService{

    public function __construct(DonationRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getMaxDonation()
    {
        return $this->repo->getMaxDonation();
    }

    public function getDonationsDay()
    {
        return $this->repo->getDonationsDay();
    }

    public function getDonationsLastMonth()
    {
        return $this->repo->getDonationsLastMonth();
    }

    public function getDonationsGroupByDay()
    {
        return $this->repo->getDonationsGroupByDay();
    }

    public function getAllPagintion(int $size = 10)
    {
        return $this->repo->getAllPagintion($size);
    }
}
