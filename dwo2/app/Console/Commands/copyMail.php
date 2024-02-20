<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\MCcCust;


class copyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:copy-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
		$custList = MCcCust::join('DWO_profile_mt' ,'cust_num' , 'profile_cust_code')
			->whereNull('email')
			->orWhere('mail_address' ,'!=' ,'email')
			->selectRaw('cust_num ,mail_address')
			->get();

		foreach ($custList as $cust) {
			$user = User::selectRaw('profile_cust_code ,email ,profile_modified_id')->first();
            
			if (isset($user)) {
				$user->email = $cust->mail_address;
				$user->profile_modified_id = 'COPY_MAIL';
				$user->save();
			}
		}

	}
}
