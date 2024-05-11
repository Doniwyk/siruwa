<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified in the file app/Console/Comands/MigrateInOrder.php \n Drop all the table in db before execute the command.';

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
     * @return mixed
     */
    public function handle()
    {
        /** Specify the names of the migrations files in the order you want to 
         * loaded
         * $migrations =[ 
         *               'xxxx_xx_xx_000000_create_nameTable_table.php',
         *    ];
         */
        $migrations = [
            '2014_10_12_100000_create_password_reset_tokens_table.php',
            '2019_08_19_000000_create_failed_jobs_table.php',
            '2019_12_14_000001_create_personal_access_tokens_table.php',
            '2024_03_28_043857_create_penduduk_table.php',
            '2024_05_03_014726_temporary_penduduk.php',
            '2014_10_12_000000_create_users_table.php',
            '2024_03_28_045949_create_dokumen_table.php',
            '2024_03_28_050944_create_pembayaran_table.php',
            '2024_03_28_050508_create_berita_table.php',
            '2024_03_28_050516_create_agenda_table.php',
            '2024_03_28_051750_create_iuran_sampah_table.php',
            '2024_03_28_051744_create_iuran_kematian_table.php'

        ];

        foreach ($migrations as $migration) {
            $basePath = 'database/migrations/';
            $migrationName = trim($migration);
            $path = $basePath . $migrationName;
            $this->call('migrate:refresh', [
                '--path' => $path,
            ]);
        }
    }
}
