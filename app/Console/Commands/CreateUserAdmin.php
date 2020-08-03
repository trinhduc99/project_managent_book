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
        $this->Validate($userName, $email, $password);
        $this->InsertDataAdmin($userName, $email, $password);
    }

    public function InsertDataAdmin($userName, $email, $password)
    {
        try {
            DB::beginTransaction();
            //insertData
            $user = new User();
            $user->name = $userName;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->role = 'admin';
            $user->remember_token = Str::random(20);
            DB::commit();
            $user->save();
            $this->info('Staff Account created.');
            return 0;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . "---------Line :" . $exception->getLine());
        }

    }

    public function Validate($userName, $email, $password)
    {
        $validator = Validator::make([
            'first_name' => $userName,
            'email' => $email,
            'password' => $password,
        ], [
            'first_name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|max:191|min:6'
        ]);
        if ($validator->fails()) {
            $this->info('User admin not created. See error messages below:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
        }
    }

}
