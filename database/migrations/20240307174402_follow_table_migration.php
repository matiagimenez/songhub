<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class FollowTableMigration extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table("FOLLOW", ['id' => false, 'primary_key' => ['FOLLOWER_ID', 'FOLLOWED_ID']]);
        $table->addColumn('FOLLOWER_ID', 'integer', ['signed' => false, 'null' => false]);
        $table->addColumn('FOLLOWED_ID', 'integer', ['signed' => false, 'null' => false]);
        $table->addForeignKey('FOLLOWER_ID', 'USER', 'USER_ID');
        $table->addForeignKey('FOLLOWED_ID', 'USER', 'USER_ID');
        $table->create();
    }
}
