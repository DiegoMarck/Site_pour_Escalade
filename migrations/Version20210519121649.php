<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210519121649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media ADD maj DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE site CHANGE nombrede_voie nombrede_voie VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE topo DROP maj');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP maj');
        $this->addSql('ALTER TABLE site CHANGE nombrede_voie nombrede_voie LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE topo ADD maj DATETIME DEFAULT NULL');
    }
}
