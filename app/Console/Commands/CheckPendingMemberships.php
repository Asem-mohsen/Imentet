<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MembershipService;

class CheckPendingMemberships extends Command
{
    protected $signature = 'memberships:check-pending';
    protected $description = 'Check and suspend pending memberships that have exceeded their document submission deadline';

    protected $membershipService;

    public function __construct(MembershipService $membershipService)
    {
        parent::__construct();
        $this->membershipService = $membershipService;
    }

    public function handle()
    {
        $this->info('Checking pending memberships...');
        
        $this->membershipService->checkAndSuspendPendingMemberships();
        
        $this->info('Pending memberships check completed.');
    }
} 