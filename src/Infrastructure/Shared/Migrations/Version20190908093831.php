<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * @codeCoverageIgnore
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190908093831 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE song (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , title VARCHAR(30) DEFAULT NULL, artist VARCHAR(30) DEFAULT NULL, price VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE shopping_basket (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , name VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE basket_item (shopping_basket_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , song_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , PRIMARY KEY(shopping_basket_id, song_id))');
        $this->addSql('CREATE INDEX IDX_D4943C2BE85C381 ON basket_item (shopping_basket_id)');
        $this->addSql('CREATE INDEX IDX_D4943C2BA0BDB2F3 ON basket_item (song_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE song');
        $this->addSql('DROP TABLE shopping_basket');
        $this->addSql('DROP TABLE basket_item');
    }
}
