<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ArtistTableMigration extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table("ARTIST", ['id' => 'ARTIST_ID']);
        $table->addColumn('NAME', 'string', ['limit' => 120]);
        $table->addColumn('AVATAR_URL', 'string', ['limit' => 255]);
        $table->create();
    }
}
