<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250118074247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media ADD carousel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CC1CE5B98 FOREIGN KEY (carousel_id) REFERENCES carousel (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CC1CE5B98 ON media (carousel_id)');
        $this->addSql('ALTER TABLE user DROP phonenumber');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD phonenumber VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CC1CE5B98');
        $this->addSql('DROP INDEX IDX_6A2CA10CC1CE5B98 ON media');
        $this->addSql('ALTER TABLE media DROP carousel_id');
    }
}
