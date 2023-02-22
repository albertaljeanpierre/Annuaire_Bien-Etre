<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222133033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Modification champs nullable Prestataire et Date en datetime pour la date d\inscription';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE site_internet site_internet VARCHAR(255) DEFAULT NULL, CHANGE num_tel num_tel VARCHAR(255) DEFAULT NULL, CHANGE num_tva num_tva VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE inscription inscription DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE site_internet site_internet VARCHAR(255) NOT NULL, CHANGE num_tel num_tel VARCHAR(255) NOT NULL, CHANGE num_tva num_tva VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE inscription inscription DATE NOT NULL');
    }
}
