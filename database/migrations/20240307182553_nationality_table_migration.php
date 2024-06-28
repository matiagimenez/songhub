<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class NationalityTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table("NATIONALITY", ['id' => false, 'primary_key' => ['COUNTRY_ID', 'USER_ID']]);
        $table->addColumn('USER_ID', 'integer', ['signed' => false, 'null' => false]);
        $table->addColumn('COUNTRY_ID', 'integer', ['signed' => false, 'null' => false]);
        $table->addForeignKey('USER_ID', 'USER', 'USER_ID');
        $table->addForeignKey('COUNTRY_ID', 'COUNTRY', 'COUNTRY_ID');
        $table->create();
    }
}
