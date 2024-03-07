<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CommentTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table("COMMENT", ['id' => 'COMMENT_ID']);
        $table->addColumn('TEXT', 'string', ['limit' => 255]);
        $table->addColumn('DATETIME', 'datetime');
        $table->addColumn('LIKES', 'integer', ['default' => 0]);
        $table->addColumn('POST_ID', 'integer', ['signed' => false]);
        $table->addColumn('USER_ID', 'integer', ['signed' => false]);
        $table->addForeignKey('POST_ID', 'POST', 'POST_ID');
        $table->addForeignKey('USER_ID', 'USER', 'USER_ID');
        $table->create();
    }
}
