<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230810112812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, begin_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', description LONGTEXT DEFAULT NULL, max_participant INT DEFAULT NULL, min_participant INT DEFAULT NULL, current_participant INT DEFAULT NULL, speaker VARCHAR(255) DEFAULT NULL, is_active VARBINARY(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, notice VARCHAR(255) DEFAULT NULL, code VARCHAR(20) DEFAULT NULL, category_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ch_cookieconsent_log (id INT AUTO_INCREMENT NOT NULL, ip_address VARCHAR(255) NOT NULL, cookie_consent_key VARCHAR(255) NOT NULL, cookie_name VARCHAR(255) NOT NULL, cookie_value VARCHAR(255) NOT NULL, timestamp DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event CHANGE beschreibung beschreibung TEXT DEFAULT NULL, CHANGE minteilnehmer minteilnehmer VARCHAR(255) DEFAULT NULL, CHANGE active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE ch_cookieconsent_log');
        $this->addSql('ALTER TABLE event CHANGE beschreibung beschreibung LONGTEXT DEFAULT NULL, CHANGE minteilnehmer minteilnehmer INT DEFAULT NULL, CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
