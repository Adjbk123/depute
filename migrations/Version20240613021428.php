<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240613021428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_parlementaire ADD legislature_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupe_parlementaire ADD CONSTRAINT FK_A9E294BAFD560F4C FOREIGN KEY (legislature_id) REFERENCES legislature (id)');
        $this->addSql('CREATE INDEX IDX_A9E294BAFD560F4C ON groupe_parlementaire (legislature_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_parlementaire DROP FOREIGN KEY FK_A9E294BAFD560F4C');
        $this->addSql('DROP INDEX IDX_A9E294BAFD560F4C ON groupe_parlementaire');
        $this->addSql('ALTER TABLE groupe_parlementaire DROP legislature_id');
    }
}
