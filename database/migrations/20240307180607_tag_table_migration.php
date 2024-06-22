<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TagTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table("TAG", ['id' => false, 'primary_key' => ['POST_ID', 'TEXT']]);
        $table->addColumn('POST_ID', 'integer', ['signed' => false, 'null' => false]);
        $table->addColumn('TEXT', 'string', ['limit' => 60, 'null' => false]);
        $table->addForeignKey('POST_ID', 'POST', 'POST_ID');
        $table->create();
    }
}
