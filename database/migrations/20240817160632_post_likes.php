<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PostLikes extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table("POST_LIKE", ['id' => false, 'primary_key' => ['USER_ID', 'POST_ID']]);
        $table->addColumn('USER_ID', 'integer', ['signed' => false, 'null' => false])
              ->addColumn('POST_ID', 'integer', ['signed' => false, 'null' => false])
              ->addForeignKey('USER_ID', 'USER', 'USER_ID')
              ->addForeignKey('POST_ID', 'POST', 'POST_ID')
              ->create();
    }
}
