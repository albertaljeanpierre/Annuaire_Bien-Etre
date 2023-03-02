<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224161340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation table catégorie';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, en_avant TINYINT(1) NOT NULL, validite TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire_categorie (prestataire_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_80B50294BE3DB2B7 (prestataire_id), INDEX IDX_80B50294BCF5E72D (categorie_id), PRIMARY KEY(prestataire_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestataire_categorie ADD CONSTRAINT FK_80B50294BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_categorie ADD CONSTRAINT FK_80B50294BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire_categorie DROP FOREIGN KEY FK_80B50294BE3DB2B7');
        $this->addSql('ALTER TABLE prestataire_categorie DROP FOREIGN KEY FK_80B50294BCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE prestataire_categorie');
    }
}
