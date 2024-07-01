<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserTableMigration extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table("USER", ['id' => 'USER_ID']);
        $table->addColumn('NAME', 'string', ['limit' => 60, 'null' => false]);
        $table->addColumn('USERNAME', 'string', ['limit' => 30, 'null' => false]);
        $table->addColumn('EMAIL', 'string', ['limit' => 128, 'null' => false]);
        $table->addColumn('PASSWORD', 'string', ['limit' => 255, 'null' => false]);
        $table->addColumn('SPOTIFY_ID', 'string', ['limit' => 255, 'default' => null]);
        $table->addColumn('SPOTIFY_URL', 'string', ['limit' => 255, 'default' => null]);
        $table->addColumn('REFRESH_TOKEN', 'string', ['limit' => 255, 'default' => null]);
        $table->addColumn('SPOTIFY_AVATAR', 'string', ['limit' => 255, 'default' => null]);
        $table->addColumn('COUNTRY_ID', 'integer', ['signed' => false, 'default' => null]);
        $table->addColumn('BIOGRAPHY', 'string', ['limit' => 160, 'null' => false]);
        $table->addForeignKey('COUNTRY_ID', 'COUNTRY', 'COUNTRY_ID');
        $table->create();
    }
}
