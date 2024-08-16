<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CommentLike extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table("COMMENT_LIKE", ['id' => false, 'primary_key' => ['USER_ID', 'POST_ID', 'COMMENT_ID']]);
        $table->addColumn('USER_ID', 'integer', ['signed' => false, 'null' => false])
              ->addColumn('POST_ID', 'integer', ['signed' => false, 'null' => false])
              ->addColumn('COMMENT_ID', 'integer', ['signed' => false, 'null' => false])
              ->addForeignKey('USER_ID', 'USER', 'USER_ID')
              ->addForeignKey('COMMENT_ID', 'COMMENT', 'COMMENT_ID')
              ->addForeignKey('POST_ID', 'POST', 'POST_ID')
              ->create();
    }
}
