<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240922232058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE domovskastranka RENAME INDEX fk_ac11ebb6eee05533 TO IDX_AC11EBB6EEE05533');
        $this->addSql('ALTER TABLE domovskastranka RENAME INDEX fk_ac11ebb6fc55fadd TO IDX_AC11EBB6FC55FADD');
        $this->addSql('ALTER TABLE domovskastranka RENAME INDEX fk_ac11ebb644e99db8 TO IDX_AC11EBB644E99DB8');
        $this->addSql('ALTER TABLE guide CHANGE employment employment VARCHAR(255) DEFAULT NULL, CHANGE language language VARCHAR(255) DEFAULT NULL, CHANGE certificate certificate VARCHAR(255) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE photo CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE popisek popisek VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE program_dne CHANGE nazev nazev VARCHAR(255) DEFAULT NULL, CHANGE popisek popisek LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE program_dne ADD CONSTRAINT FK_FD06509A761CF49A FOREIGN KEY (zajezd_id) REFERENCES zajezdy (id)');
        $this->addSql('ALTER TABLE program_dne RENAME INDEX fk_program_dne_zajezd TO IDX_FD06509A761CF49A');
        $this->addSql('ALTER TABLE tipy DROP FOREIGN KEY FK_ZAJEZD_ID');
        $this->addSql('ALTER TABLE tipy CHANGE popisek popisek LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE tipy ADD CONSTRAINT FK_84F9A816761CF49A FOREIGN KEY (zajezd_id) REFERENCES zajezdy (id)');
        $this->addSql('ALTER TABLE tipy RENAME INDEX fk_zajezd_id TO IDX_84F9A816761CF49A');
        $this->addSql('ALTER TABLE zajezdy DROP INDEX slug_idx, ADD UNIQUE INDEX UNIQ_B8886E84989D9B62 (slug)');
        $this->addSql('ALTER TABLE zajezdy ADD carousel_image1 VARCHAR(255) DEFAULT NULL, ADD carousel_image2 VARCHAR(255) DEFAULT NULL, ADD carousel_image3 VARCHAR(255) DEFAULT NULL, DROP carouselImage1, DROP carouselImage2, DROP carouselImage3, CHANGE nazev nazev VARCHAR(80) NOT NULL, CHANGE destinace destinace VARCHAR(100) DEFAULT NULL, CHANGE typ typ VARCHAR(20) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE podnazev podnazev VARCHAR(80) DEFAULT NULL, CHANGE uvodniNadpis uvodniNadpis VARCHAR(255) DEFAULT NULL, CHANGE uvodniPopisek uvodniPopisek LONGTEXT DEFAULT NULL, CHANGE poznamky poznamky LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE domovskastranka RENAME INDEX idx_ac11ebb6eee05533 TO FK_AC11EBB6EEE05533');
        $this->addSql('ALTER TABLE domovskastranka RENAME INDEX idx_ac11ebb6fc55fadd TO FK_AC11EBB6FC55FADD');
        $this->addSql('ALTER TABLE domovskastranka RENAME INDEX idx_ac11ebb644e99db8 TO FK_AC11EBB644E99DB8');
        $this->addSql('ALTER TABLE guide CHANGE employment employment VARCHAR(255) DEFAULT \'NULL\', CHANGE language language VARCHAR(255) DEFAULT \'NULL\', CHANGE certificate certificate VARCHAR(255) DEFAULT \'NULL\', CHANGE image image VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE photo CHANGE popisek popisek VARCHAR(255) DEFAULT \'NULL\', CHANGE image image VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE program_dne DROP FOREIGN KEY FK_FD06509A761CF49A');
        $this->addSql('ALTER TABLE program_dne CHANGE nazev nazev VARCHAR(255) DEFAULT \'NULL\', CHANGE popisek popisek TEXT NOT NULL');
        $this->addSql('ALTER TABLE program_dne RENAME INDEX idx_fd06509a761cf49a TO FK_program_dne_zajezd');
        $this->addSql('ALTER TABLE tipy DROP FOREIGN KEY FK_84F9A816761CF49A');
        $this->addSql('ALTER TABLE tipy CHANGE popisek popisek TEXT NOT NULL');
        $this->addSql('ALTER TABLE tipy ADD CONSTRAINT FK_ZAJEZD_ID FOREIGN KEY (zajezd_id) REFERENCES zajezdy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tipy RENAME INDEX idx_84f9a816761cf49a TO FK_ZAJEZD_ID');
        $this->addSql('ALTER TABLE zajezdy DROP INDEX UNIQ_B8886E84989D9B62, ADD INDEX slug_idx (slug)');
        $this->addSql('ALTER TABLE zajezdy ADD carouselImage1 VARCHAR(255) DEFAULT \'NULL\', ADD carouselImage2 VARCHAR(255) DEFAULT \'NULL\', ADD carouselImage3 VARCHAR(255) DEFAULT \'NULL\', DROP carousel_image1, DROP carousel_image2, DROP carousel_image3, CHANGE nazev nazev VARCHAR(60) NOT NULL, CHANGE podnazev podnazev VARCHAR(255) DEFAULT \'NULL\', CHANGE destinace destinace VARCHAR(100) DEFAULT \'NULL\', CHANGE typ typ VARCHAR(20) DEFAULT \'NULL\', CHANGE image image VARCHAR(255) DEFAULT \'NULL\', CHANGE uvodniNadpis uvodniNadpis VARCHAR(255) DEFAULT \'NULL\', CHANGE uvodniPopisek uvodniPopisek TEXT DEFAULT NULL, CHANGE poznamky poznamky TEXT DEFAULT NULL');
    }
}
