<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'create:admin';

    protected $description = 'Creates admin';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $user = new User();
        $user->email = $this->ask('Email?');
        $pwd = $this->secret('Password?');
        $user->password = Hash::make($pwd);
        $user->save();

        echo 'Admin Created';
        return 'admin created';
    }
}
