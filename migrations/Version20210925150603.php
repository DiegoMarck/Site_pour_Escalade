<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210925150603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carousel (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, imagescarousel VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CC35D01CB');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CC35D01CB FOREIGN KEY (photo_site_id) REFERENCES site (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE carousel');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CC35D01CB');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CC35D01CB FOREIGN KEY (photo_site_id) REFERENCES site (id) ON DELETE SET NULL');
    }
}
