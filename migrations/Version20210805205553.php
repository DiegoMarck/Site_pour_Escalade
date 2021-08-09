<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210805205553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media ADD topo_id INT NOT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C7F7E8D71 FOREIGN KEY (topo_id) REFERENCES topo (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C7F7E8D71 ON media (topo_id)');
        $this->addSql('ALTER TABLE site CHANGE difficulte difficulte VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C7F7E8D71');
        $this->addSql('DROP INDEX IDX_6A2CA10C7F7E8D71 ON media');
        $this->addSql('ALTER TABLE media DROP topo_id');
        $this->addSql('ALTER TABLE site CHANGE difficulte difficulte LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
