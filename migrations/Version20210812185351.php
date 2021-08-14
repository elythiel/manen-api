<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812185351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id UUID NOT NULL, title VARCHAR(255) NOT NULL, youtube VARCHAR(255) DEFAULT NULL, spotify VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, released_at DATE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN album.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE concert (id UUID NOT NULL, title VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, location VARCHAR(255) DEFAULT NULL, purchase_link VARCHAR(255) DEFAULT NULL, more_link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN concert.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE song (id UUID NOT NULL, album_id UUID NOT NULL, title VARCHAR(255) NOT NULL, youtube VARCHAR(255) DEFAULT NULL, spotify VARCHAR(255) DEFAULT NULL, lyrics TEXT NOT NULL, track_id INT NOT NULL, authors TEXT DEFAULT NULL, guests TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_33EDEEA11137ABCF ON song (album_id)');
        $this->addSql('COMMENT ON COLUMN song.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN song.album_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN song.authors IS \'(DC2Type:simple_array)\'');
        $this->addSql('COMMENT ON COLUMN song.guests IS \'(DC2Type:simple_array)\'');
        $this->addSql('CREATE TABLE "user" (id UUID NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA11137ABCF FOREIGN KEY (album_id) REFERENCES album (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE song DROP CONSTRAINT FK_33EDEEA11137ABCF');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE concert');
        $this->addSql('DROP TABLE song');
        $this->addSql('DROP TABLE "user"');
    }
}
