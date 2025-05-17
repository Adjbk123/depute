<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240612235750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE affiliation_parti_politique (id INT AUTO_INCREMENT NOT NULL, depute_id INT DEFAULT NULL, parti_politique_id INT DEFAULT NULL, date_affiliation DATE NOT NULL, date_fin_affiliation DATE DEFAULT NULL, INDEX IDX_D084312051A07B9C (depute_id), INDEX IDX_D0843120C5A704F (parti_politique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affiliation_parti_politique ADD CONSTRAINT FK_D084312051A07B9C FOREIGN KEY (depute_id) REFERENCES depute (id)');
        $this->addSql('ALTER TABLE affiliation_parti_politique ADD CONSTRAINT FK_D0843120C5A704F FOREIGN KEY (parti_politique_id) REFERENCES parti_politique (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affiliation_parti_politique DROP FOREIGN KEY FK_D084312051A07B9C');
        $this->addSql('ALTER TABLE affiliation_parti_politique DROP FOREIGN KEY FK_D0843120C5A704F');
        $this->addSql('DROP TABLE affiliation_parti_politique');
    }
}
