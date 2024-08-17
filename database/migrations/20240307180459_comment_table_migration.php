<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CommentTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table("COMMENT", ['id' => 'COMMENT_ID']);
        $table->addColumn('TEXT', 'string', ['limit' => 255, 'null' => false]);
        $table->addColumn('DATETIME', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('LIKES', 'integer', ['default' => 0, 'null' => false]);
        $table->addColumn('POST_ID', 'integer', ['signed' => false, 'null' => false]);
        $table->addColumn('USER_ID', 'integer', ['signed' => false, 'null' => false]);
        $table->addForeignKey('POST_ID', 'POST', 'POST_ID', ['delete' => 'CASCADE', 'update' => 'NO_ACTION']);
        $table->addForeignKey('USER_ID', 'USER', 'USER_ID', ['delete' => 'CASCADE', 'update' => 'NO_ACTION']);
        $table->create();
    }
}
