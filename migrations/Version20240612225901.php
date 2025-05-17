<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240612225901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE biographie (id INT AUTO_INCREMENT NOT NULL, depute_id INT DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, INDEX IDX_C726C6B251A07B9C (depute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE circonscription (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depute (id INT AUTO_INCREMENT NOT NULL, circonscription_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenoms VARCHAR(255) NOT NULL, date_naissance DATE DEFAULT NULL, lieu_naissance VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, biographie LONGTEXT DEFAULT NULL, INDEX IDX_3CFB37D0755DBAE (circonscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depute_groupe_parlementaire (id INT AUTO_INCREMENT NOT NULL, depute_id INT DEFAULT NULL, groupe_parlementaire_id INT DEFAULT NULL, debut_mandat DATE NOT NULL, fin_mandat DATE DEFAULT NULL, INDEX IDX_A5DFFAE451A07B9C (depute_id), INDEX IDX_A5DFFAE4F5A17215 (groupe_parlementaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_parlementaire (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, chef_groupe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE legislature (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mandat (id INT AUTO_INCREMENT NOT NULL, depute_id INT DEFAULT NULL, parti_politique_id INT DEFAULT NULL, groupe_parlementaire_id INT DEFAULT NULL, legislature_id INT DEFAULT NULL, debut_mandat DATE NOT NULL, fin_mandat DATE DEFAULT NULL, INDEX IDX_1E53EFD551A07B9C (depute_id), INDEX IDX_1E53EFD5C5A704F (parti_politique_id), INDEX IDX_1E53EFD5F5A17215 (groupe_parlementaire_id), INDEX IDX_1E53EFD5FD560F4C (legislature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parti_politique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, fondation VARCHAR(255) DEFAULT NULL, historique LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suppleant (id INT AUTO_INCREMENT NOT NULL, depute_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenoms VARCHAR(255) NOT NULL, INDEX IDX_99E466C651A07B9C (depute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_mandat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE biographie ADD CONSTRAINT FK_C726C6B251A07B9C FOREIGN KEY (depute_id) REFERENCES depute (id)');
        $this->addSql('ALTER TABLE depute ADD CONSTRAINT FK_3CFB37D0755DBAE FOREIGN KEY (circonscription_id) REFERENCES circonscription (id)');
        $this->addSql('ALTER TABLE depute_groupe_parlementaire ADD CONSTRAINT FK_A5DFFAE451A07B9C FOREIGN KEY (depute_id) REFERENCES depute (id)');
        $this->addSql('ALTER TABLE depute_groupe_parlementaire ADD CONSTRAINT FK_A5DFFAE4F5A17215 FOREIGN KEY (groupe_parlementaire_id) REFERENCES groupe_parlementaire (id)');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT FK_1E53EFD551A07B9C FOREIGN KEY (depute_id) REFERENCES depute (id)');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT FK_1E53EFD5C5A704F FOREIGN KEY (parti_politique_id) REFERENCES parti_politique (id)');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT FK_1E53EFD5F5A17215 FOREIGN KEY (groupe_parlementaire_id) REFERENCES groupe_parlementaire (id)');
        $this->addSql('ALTER TABLE mandat ADD CONSTRAINT FK_1E53EFD5FD560F4C FOREIGN KEY (legislature_id) REFERENCES legislature (id)');
        $this->addSql('ALTER TABLE suppleant ADD CONSTRAINT FK_99E466C651A07B9C FOREIGN KEY (depute_id) REFERENCES depute (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biographie DROP FOREIGN KEY FK_C726C6B251A07B9C');
        $this->addSql('ALTER TABLE depute DROP FOREIGN KEY FK_3CFB37D0755DBAE');
        $this->addSql('ALTER TABLE depute_groupe_parlementaire DROP FOREIGN KEY FK_A5DFFAE451A07B9C');
        $this->addSql('ALTER TABLE depute_groupe_parlementaire DROP FOREIGN KEY FK_A5DFFAE4F5A17215');
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY FK_1E53EFD551A07B9C');
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY FK_1E53EFD5C5A704F');
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY FK_1E53EFD5F5A17215');
        $this->addSql('ALTER TABLE mandat DROP FOREIGN KEY FK_1E53EFD5FD560F4C');
        $this->addSql('ALTER TABLE suppleant DROP FOREIGN KEY FK_99E466C651A07B9C');
        $this->addSql('DROP TABLE biographie');
        $this->addSql('DROP TABLE circonscription');
        $this->addSql('DROP TABLE depute');
        $this->addSql('DROP TABLE depute_groupe_parlementaire');
        $this->addSql('DROP TABLE groupe_parlementaire');
        $this->addSql('DROP TABLE legislature');
        $this->addSql('DROP TABLE mandat');
        $this->addSql('DROP TABLE parti_politique');
        $this->addSql('DROP TABLE suppleant');
        $this->addSql('DROP TABLE type_mandat');
    }
}
