<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230407152430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation des tables commune et province';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, province_id INT NOT NULL, nom VARCHAR(100) NOT NULL, code_postal VARCHAR(4) NOT NULL, INDEX IDX_E2E2D1EEE946114A (province_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE province (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEE946114A FOREIGN KEY (province_id) REFERENCES province (id)');
        $this->addSql('ALTER TABLE user ADD commune_id INT NOT NULL');
       // $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
       // $this->addSql('CREATE INDEX IDX_8D93D649131A4F72 ON user (commune_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649131A4F72');
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EEE946114A');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE province');
        $this->addSql('DROP INDEX IDX_8D93D649131A4F72 ON user');
        $this->addSql('ALTER TABLE user DROP commune_id');
    }
}
