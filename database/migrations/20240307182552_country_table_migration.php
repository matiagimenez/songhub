<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CountryTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table("COUNTRY", ['id' => 'COUNTRY_ID']);
        $table->addColumn('NAME', 'string', ['limit' => 255, 'null' => false]);
        $table->create();
    }
}
