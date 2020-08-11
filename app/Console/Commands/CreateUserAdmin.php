<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CreateUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert data to User with role equal admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $userName = $this->ask('User Name?');
        $email = $this->ask('Email ?');
        $password = $this->secret('Password ?');
        $password_confirmation = $this->secret('Confirm Password ?');
        $this->InsertDataAdmin($userName, $email, $password, $password_confirmation);
    }

    public function InsertDataAdmin($userName, $email, $password,$password_confirmation )
    {
        $validate = $this->Validate($userName, $email, $password,$password_confirmation);
        if ($validate->fails()) {
            $this->info('User admin not created. See error messages below:');
            foreach ($validate->errors()->all() as $error) {
                $this->error($error);
            }
            return false;
        }
        try {

            //insertData
            $user = new User();
            $user->name = $userName;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->role = 'admin';
            $user->remember_token = Str::random(20);
            $user->save();

            $this->info('Staff Account created.');
            return 0;
        } catch (\Exception $exception) {

            Log::error('Message : ' . $exception->getMessage() . "---------Line :" . $exception->getLine());
        }

    }

    public function Validate($userName, $email, $password,$password_confirmation)
    {
        return Validator::make([
            'user_name' => $userName,
            'email' => $email,
            'password' => $password,
            'password_confirmation' =>$password_confirmation
        ], [
            'user_name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|max:191|min:6|confirmed',
        ]);

    }

}
