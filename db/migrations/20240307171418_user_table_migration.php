<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserTableMigration extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table("USER", ['id' => 'USER_ID']);
        $table->addColumn('NAME', 'string', ['limit' => 80, 'null' => true]);
        $table->addColumn('USERNAME', 'string', ['limit' => 50, 'null' => false]);
        $table->addColumn('EMAIL', 'string', ['limit' => 100, 'null' => false]);
        $table->addColumn('PASSWORD', 'string', ['limit' => 100, 'null' => false]);
        $table->addColumn('SPOTIFY_ID', 'string', ['limit' => 255, 'null' => false]);
        $table->addColumn('SPOTIFY_AVATAR', 'string', ['limit' => 255, 'null' => true]);
        $table->addColumn('IS_VERIFIED', 'boolean', ['default' => false, 'null' => false]);
        $table->addColumn('BIOGRAPHY', 'string', ['limit' => 255, 'null' => false]);
        $table->create();
    }
}

