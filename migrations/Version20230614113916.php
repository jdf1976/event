<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230614113916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anmeldung CHANGE status status VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE event CHANGE beschreibung beschreibung VARCHAR(255) DEFAULT NULL, CHANGE datum datum VARCHAR(255) DEFAULT NULL, CHANGE bild bild VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anmeldung CHANGE status status VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE event CHANGE beschreibung beschreibung VARCHAR(255) DEFAULT \'NULL\', CHANGE datum datum VARCHAR(255) DEFAULT \'NULL\', CHANGE bild bild VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
