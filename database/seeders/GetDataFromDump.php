<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GetDataFromDump extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directory = database_path('dumps/');

        if (!File::exists($directory))
        {
            $this->command->error("Katalog dumps/ nie istnieje.");
            return;
        }

        $files = File::files($directory);

        foreach ($files as $file)
        {
            if ($file->getExtension() === 'dump')
            {
                $sql = File::get($file->getRealPath());

                DB::unprepared($sql);

                $this->command->info("Plik został zaimportowany: {$file->getFilename()}");
            }
        }
    }
}
