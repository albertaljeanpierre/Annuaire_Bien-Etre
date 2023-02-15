<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210161747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de la possibilité d avoir des champs nullable';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE adresse_number adresse_number VARCHAR(5) DEFAULT NULL, CHANGE adresse_rue adresse_rue VARCHAR(255) DEFAULT NULL, CHANGE type_utilisateur type_utilisateur VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE adresse_number adresse_number VARCHAR(5) NOT NULL, CHANGE adresse_rue adresse_rue VARCHAR(255) NOT NULL, CHANGE type_utilisateur type_utilisateur VARCHAR(255) NOT NULL');
    }
}
