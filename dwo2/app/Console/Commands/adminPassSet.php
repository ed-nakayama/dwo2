<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Admin;

class adminPassSet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:admin-pass-set';

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
        $adminList = Admin::all();
        
        foreach ($adminList as $admin) {
        	$admin->password = \Hash::make($admin->operator_password1);
        	if (empty($admin->operator_del)) {
	        	$admin->operator_del = '0';
			}
        	$admin->operator_modified_id = 'PASS_SET';
			$admin->save();
		}
    }
}
