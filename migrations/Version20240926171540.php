<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240926171540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE domovskastranka DROP FOREIGN KEY FK_AC11EBB644E99DB8');
        $this->addSql('ALTER TABLE domovskastranka DROP FOREIGN KEY FK_AC11EBB6EEE05533');
        $this->addSql('ALTER TABLE domovskastranka DROP FOREIGN KEY FK_AC11EBB6FC55FADD');
        $this->addSql('DROP INDEX fk_ac11ebb6eee05533 ON domovskastranka');
        $this->addSql('CREATE INDEX IDX_AC11EBB6EEE05533 ON domovskastranka (vystaveny_zajezd1_id)');
        $this->addSql('DROP INDEX fk_ac11ebb6fc55fadd ON domovskastranka');
        $this->addSql('CREATE INDEX IDX_AC11EBB6FC55FADD ON domovskastranka (vystaveny_zajezd2_id)');
        $this->addSql('DROP INDEX fk_ac11ebb644e99db8 ON domovskastranka');
        $this->addSql('CREATE INDEX IDX_AC11EBB644E99DB8 ON domovskastranka (vystaveny_zajezd3_id)');
        $this->addSql('ALTER TABLE domovskastranka ADD CONSTRAINT FK_AC11EBB644E99DB8 FOREIGN KEY (vystaveny_zajezd3_id) REFERENCES zajezdy (id)');
        $this->addSql('ALTER TABLE domovskastranka ADD CONSTRAINT FK_AC11EBB6EEE05533 FOREIGN KEY (vystaveny_zajezd1_id) REFERENCES zajezdy (id)');
        $this->addSql('ALTER TABLE domovskastranka ADD CONSTRAINT FK_AC11EBB6FC55FADD FOREIGN KEY (vystaveny_zajezd2_id) REFERENCES zajezdy (id)');
        $this->addSql('ALTER TABLE photo_tag DROP FOREIGN KEY photo_tag_ibfk_2');
        $this->addSql('DROP INDEX tag_id ON photo_tag');
        $this->addSql('CREATE INDEX IDX_8C2D8E57BAD26311 ON photo_tag (tag_id)');
        $this->addSql('ALTER TABLE photo_tag ADD CONSTRAINT photo_tag_ibfk_2 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_dne CHANGE popisek popisek LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE program_dne ADD CONSTRAINT FK_FD06509A761CF49A FOREIGN KEY (zajezd_id) REFERENCES zajezdy (id)');
        $this->addSql('DROP INDEX fk_program_dne_zajezd ON program_dne');
        $this->addSql('CREATE INDEX IDX_FD06509A761CF49A ON program_dne (zajezd_id)');
        $this->addSql('ALTER TABLE tipy DROP FOREIGN KEY FK_ZAJEZD_ID');
        $this->addSql('ALTER TABLE tipy DROP FOREIGN KEY FK_ZAJEZD_ID');
        $this->addSql('ALTER TABLE tipy CHANGE popisek popisek LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE tipy ADD CONSTRAINT FK_84F9A816761CF49A FOREIGN KEY (zajezd_id) REFERENCES zajezdy (id)');
        $this->addSql('DROP INDEX fk_zajezd_id ON tipy');
        $this->addSql('CREATE INDEX IDX_84F9A816761CF49A ON tipy (zajezd_id)');
        $this->addSql('ALTER TABLE tipy ADD CONSTRAINT FK_ZAJEZD_ID FOREIGN KEY (zajezd_id) REFERENCES zajezdy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zajezdy CHANGE nazev nazev VARCHAR(80) NOT NULL, CHANGE podnazev podnazev VARCHAR(80) DEFAULT NULL, CHANGE uvodniPopisek uvodniPopisek LONGTEXT DEFAULT NULL, CHANGE poznamky poznamky LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE domovskastranka DROP FOREIGN KEY FK_AC11EBB6EEE05533');
        $this->addSql('ALTER TABLE domovskastranka DROP FOREIGN KEY FK_AC11EBB6FC55FADD');
        $this->addSql('ALTER TABLE domovskastranka DROP FOREIGN KEY FK_AC11EBB644E99DB8');
        $this->addSql('DROP INDEX idx_ac11ebb644e99db8 ON domovskastranka');
        $this->addSql('CREATE INDEX FK_AC11EBB644E99DB8 ON domovskastranka (vystaveny_zajezd3_id)');
        $this->addSql('DROP INDEX idx_ac11ebb6eee05533 ON domovskastranka');
        $this->addSql('CREATE INDEX FK_AC11EBB6EEE05533 ON domovskastranka (vystaveny_zajezd1_id)');
        $this->addSql('DROP INDEX idx_ac11ebb6fc55fadd ON domovskastranka');
        $this->addSql('CREATE INDEX FK_AC11EBB6FC55FADD ON domovskastranka (vystaveny_zajezd2_id)');
        $this->addSql('ALTER TABLE domovskastranka ADD CONSTRAINT FK_AC11EBB6EEE05533 FOREIGN KEY (vystaveny_zajezd1_id) REFERENCES zajezdy (id)');
        $this->addSql('ALTER TABLE domovskastranka ADD CONSTRAINT FK_AC11EBB6FC55FADD FOREIGN KEY (vystaveny_zajezd2_id) REFERENCES zajezdy (id)');
        $this->addSql('ALTER TABLE domovskastranka ADD CONSTRAINT FK_AC11EBB644E99DB8 FOREIGN KEY (vystaveny_zajezd3_id) REFERENCES zajezdy (id)');
        $this->addSql('ALTER TABLE photo_tag DROP FOREIGN KEY FK_8C2D8E57BAD26311');
        $this->addSql('DROP INDEX idx_8c2d8e57bad26311 ON photo_tag');
        $this->addSql('CREATE INDEX tag_id ON photo_tag (tag_id)');
        $this->addSql('ALTER TABLE photo_tag ADD CONSTRAINT FK_8C2D8E57BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE program_dne DROP FOREIGN KEY FK_FD06509A761CF49A');
        $this->addSql('ALTER TABLE program_dne DROP FOREIGN KEY FK_FD06509A761CF49A');
        $this->addSql('ALTER TABLE program_dne CHANGE popisek popisek TEXT NOT NULL');
        $this->addSql('DROP INDEX idx_fd06509a761cf49a ON program_dne');
        $this->addSql('CREATE INDEX FK_program_dne_zajezd ON program_dne (zajezd_id)');
        $this->addSql('ALTER TABLE program_dne ADD CONSTRAINT FK_FD06509A761CF49A FOREIGN KEY (zajezd_id) REFERENCES zajezdy (id)');
        $this->addSql('ALTER TABLE tipy DROP FOREIGN KEY FK_84F9A816761CF49A');
        $this->addSql('ALTER TABLE tipy DROP FOREIGN KEY FK_84F9A816761CF49A');
        $this->addSql('ALTER TABLE tipy CHANGE popisek popisek TEXT NOT NULL');
        $this->addSql('ALTER TABLE tipy ADD CONSTRAINT FK_ZAJEZD_ID FOREIGN KEY (zajezd_id) REFERENCES zajezdy (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_84f9a816761cf49a ON tipy');
        $this->addSql('CREATE INDEX FK_ZAJEZD_ID ON tipy (zajezd_id)');
        $this->addSql('ALTER TABLE tipy ADD CONSTRAINT FK_84F9A816761CF49A FOREIGN KEY (zajezd_id) REFERENCES zajezdy (id)');
        $this->addSql('ALTER TABLE zajezdy CHANGE nazev nazev VARCHAR(60) NOT NULL, CHANGE podnazev podnazev VARCHAR(255) DEFAULT NULL, CHANGE uvodniPopisek uvodniPopisek TEXT DEFAULT NULL, CHANGE poznamky poznamky TEXT DEFAULT NULL');
    }
}
