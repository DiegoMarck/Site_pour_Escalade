<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250119222839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(20) DEFAULT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voie DROP FOREIGN KEY FK_A57CE978C8121CE9');
        $this->addSql('ALTER TABLE region_topo DROP FOREIGN KEY FK_AD0676C27F7E8D71');
        $this->addSql('ALTER TABLE region_topo DROP FOREIGN KEY FK_AD0676C298260155');
        $this->addSql('DROP TABLE voie');
        $this->addSql('DROP TABLE region_topo');
        $this->addSql('DROP TABLE region');
        $this->addSql('ALTER TABLE entrainement ADD niveau VARCHAR(255) DEFAULT NULL, ADD duree VARCHAR(255) DEFAULT NULL, ADD date DATETIME DEFAULT NULL, ADD heure VARCHAR(255) DEFAULT NULL, ADD lieu VARCHAR(255) DEFAULT NULL, ADD organisateur VARCHAR(255) DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP phonenumber');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voie (id INT AUTO_INCREMENT NOT NULL, nom_id INT NOT NULL, hauteur INT DEFAULT NULL, equipeur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_A57CE978C8121CE9 (nom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE region_topo (region_id INT NOT NULL, topo_id INT NOT NULL, INDEX IDX_AD0676C298260155 (region_id), INDEX IDX_AD0676C27F7E8D71 (topo_id), PRIMARY KEY(region_id, topo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE voie ADD CONSTRAINT FK_A57CE978C8121CE9 FOREIGN KEY (nom_id) REFERENCES site (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE region_topo ADD CONSTRAINT FK_AD0676C27F7E8D71 FOREIGN KEY (topo_id) REFERENCES topo (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE region_topo ADD CONSTRAINT FK_AD0676C298260155 FOREIGN KEY (region_id) REFERENCES region (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE user ADD phonenumber VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entrainement DROP niveau, DROP duree, DROP date, DROP heure, DROP lieu, DROP organisateur, CHANGE description description VARCHAR(255) DEFAULT NULL');
    }
}
