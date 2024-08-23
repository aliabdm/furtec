<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;


class TruncateAllTables extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        foreach ($this->getTargetTableNames() as $tableName) {
            DB::table($tableName)->truncate();
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * @return mixed
     */
    private function getTargetTableNames(): array
    {
        $excludes = ['migrations'];
        return array_diff($this->getAllTableNames(), $excludes);
    }

    /**
     * @return array
     */
    private function getAllTableNames(): array
    {
        return array_map(fn($item) => $item->{array_keys(get_object_vars($item))[0]}, DB::select('SHOW TABLES'));
    }
}
