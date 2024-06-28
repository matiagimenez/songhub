<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CoverTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table("COVER", ['id' => false, 'primary_key' => ['SMALL_COVER_URL']]);
        $table->addColumn('SMALL_COVER_URL', 'string', ['limit' => 255, 'null' => false]);
        $table->addColumn('MEDIUM_COVER_URL', 'string', ['limit' => 255, 'null' => false]);
        $table->addColumn('LARGE_COVER_URL', 'string', ['limit' => 255, 'null' => false]);
        $table->create();
    }
}
