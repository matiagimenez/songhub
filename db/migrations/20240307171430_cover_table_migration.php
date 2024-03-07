<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CoverTableMigration extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table("COVER", ['id' => 'COVER_ID']);
        $table->addColumn('COVER_URL', 'string', ['limit' => 255]);
        $table->create();
    }
}
