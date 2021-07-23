<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518095712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, site_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_6A2CA10CF6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region_topo (region_id INT NOT NULL, topo_id INT NOT NULL, INDEX IDX_AD0676C298260155 (region_id), INDEX IDX_AD0676C27F7E8D71 (topo_id), PRIMARY KEY(region_id, topo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, grande_ville_proche VARCHAR(255) DEFAULT NULL, ville_la_plus_proche VARCHAR(255) DEFAULT NULL, exposition LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', altitude_aux_piedsdes_voies INT DEFAULT NULL, duree_marche_aproche INT DEFAULT NULL, profil_marche_approche LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', practicabiite_piedsdes_voies LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', latitude NUMERIC(20, 16) NOT NULL, longitude NUMERIC(20, 16) NOT NULL, nombre_falaise INT DEFAULT NULL, hauteur_max INT DEFAULT NULL, type_escalade LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', type_equipement LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', nombrede_voie LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', difficulte LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', site_interessantpour_grimpeur LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', type_rocher LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', profile_falaise LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', typede_prise LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', restriction LONGTEXT DEFAULT NULL, info_suplementaire LONGTEXT DEFAULT NULL, site_internet VARCHAR(255) DEFAULT NULL, voie_mythique LONGTEXT DEFAULT NULL, nomprenompseudo VARCHAR(255) DEFAULT NULL, adresse_mail VARCHAR(255) DEFAULT NULL, meilleurperiode LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topo (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, region VARCHAR(255) DEFAULT NULL, datede_parution DATE DEFAULT NULL, datede_miseajour DATE DEFAULT NULL, prix NUMERIC(7, 2) DEFAULT NULL, auteur VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, type LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', image VARCHAR(255) NOT NULL, maj DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topo_site (topo_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_A503D7267F7E8D71 (topo_id), INDEX IDX_A503D726F6BD1646 (site_id), PRIMARY KEY(topo_id, site_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voie (id INT AUTO_INCREMENT NOT NULL, nom_id INT NOT NULL, hauteur INT DEFAULT NULL, equipeur VARCHAR(255) DEFAULT NULL, INDEX IDX_A57CE978C8121CE9 (nom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE region_topo ADD CONSTRAINT FK_AD0676C298260155 FOREIGN KEY (region_id) REFERENCES region (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE region_topo ADD CONSTRAINT FK_AD0676C27F7E8D71 FOREIGN KEY (topo_id) REFERENCES topo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE topo_site ADD CONSTRAINT FK_A503D7267F7E8D71 FOREIGN KEY (topo_id) REFERENCES topo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE topo_site ADD CONSTRAINT FK_A503D726F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voie ADD CONSTRAINT FK_A57CE978C8121CE9 FOREIGN KEY (nom_id) REFERENCES site (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE region_topo DROP FOREIGN KEY FK_AD0676C298260155');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CF6BD1646');
        $this->addSql('ALTER TABLE topo_site DROP FOREIGN KEY FK_A503D726F6BD1646');
        $this->addSql('ALTER TABLE voie DROP FOREIGN KEY FK_A57CE978C8121CE9');
        $this->addSql('ALTER TABLE region_topo DROP FOREIGN KEY FK_AD0676C27F7E8D71');
        $this->addSql('ALTER TABLE topo_site DROP FOREIGN KEY FK_A503D7267F7E8D71');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE region_topo');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE topo');
        $this->addSql('DROP TABLE topo_site');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voie');
    }
}
