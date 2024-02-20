<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

class passSet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:pass-set';

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
        $userList = User::all();
        
        foreach ($userList as $user) {
        	$user->password = \Hash::make($user->profile_password1);
        	if (empty($user->profile_del)) {
	        	$user->profile_del = '0';
			}
			$user->save();
		}
    }
}
