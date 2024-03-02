<?php

declare (strict_types = 1);

use Phinx\Migration\AbstractMigration;

final class InitialUserTableMigration extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('USER');
        $table->addColumn('USERNAME', 'string', ['limit' => 20]);
        $table->addColumn('EMAIL', 'string', ['limit' => 100]);
        $table->addColumn('PASSWORD', 'string', ['limit' => 100]);
        $table->create();
    }
}