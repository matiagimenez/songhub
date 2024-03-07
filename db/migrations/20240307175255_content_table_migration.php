<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ContentTableMigration extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table("CONTENT", ['id' => 'CONTENT_ID']);
        $table->addColumn('AVERAGE_RATING', 'float', ['null' => true]);
        $table->addColumn('YEAR', 'string', ['limit' => 4]);
        $table->addColumn('SPOTIFY_ID', 'string', ['limit' => 255]);
        $table->addColumn('TITLE', 'string', ['limit' => 120]);
        $table->addColumn('TYPE', 'char', ['limit' => 1]);
        $table->addColumn('COVER_ID', 'integer', ['signed' => false]);
        $table->addColumn('ARTIST_ID', 'integer', ['signed' => false]);
        $table->addForeignKey('COVER_ID', 'COVER', 'COVER_ID');
        $table->addForeignKey('ARTIST_ID', 'ARTIST', 'ARTIST_ID');
        $table->create();
    }
}
