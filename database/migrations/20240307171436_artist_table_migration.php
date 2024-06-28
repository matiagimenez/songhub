<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ArtistTableMigration extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table("ARTIST", ['id' => false, 'primary_key' => ['ARTIST_ID']]);
        $table->addColumn('ARTIST_ID', 'string', ['limit' => 255, 'null' => false]);
        $table->addColumn('NAME', 'string', ['limit' => 120, 'null' => false]);
        $table->addColumn('AVATAR_URL', 'string', ['limit' => 255, 'null' => false]);
        $table->addColumn('SPOTIFY_URL', 'string', ['limit' => 255, 'null' => false]);
        $table->addColumn('SPOTIFY_API_URL', 'string', ['limit' => 255, 'null' => false]);
        $table->create();
    }
}
