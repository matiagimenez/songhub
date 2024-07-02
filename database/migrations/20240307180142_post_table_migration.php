<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PostTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table("POST", ['id' => 'POST_ID']);
        $table->addColumn('DATETIME', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'null' => false]);
        $table->addColumn('DESCRIPTION', 'string', ['limit' => 255, 'null' => false]);
        $table->addColumn('LIKES', 'integer', ['default' => 0, 'null' => false]);
        $table->addColumn('RATING', 'float', ['null' => false]);
        $table->addColumn('CONTENT_ID', 'string', ['limit' => 255, 'null' => false]);
        $table->addColumn('USER_ID', 'integer', ['signed' => false, 'null' => false]);
        $table->addForeignKey('CONTENT_ID', 'CONTENT', 'CONTENT_ID');
        $table->addForeignKey('USER_ID', 'USER', 'USER_ID');
        $table->create();
    }
}

