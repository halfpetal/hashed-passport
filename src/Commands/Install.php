<?php

namespace Halfpetal\HashedPassport\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Halfpetal\HashedPassport\Traits\HandlesEncryptedSecrets;

class Install extends Command
{
    use HandlesEncryptedSecrets;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hashed_passport:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypts all the Laravel Passport client secrets.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->encrypt_client_secrets();
        $this->secrets_encrypted();

        $this->info('Hashed Passport installation completed.');
        $this->info('');
        $this->info('');
    }


}
