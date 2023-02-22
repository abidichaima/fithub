<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230221102220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE particiation_seance (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participation_seance ADD participant_id INT NOT NULL, CHANGE seance_id seance_id INT NOT NULL');
        $this->addSql('ALTER TABLE participation_seance ADD CONSTRAINT FK_A5187B2B9D1C3019 FOREIGN KEY (participant_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A5187B2B9D1C3019 ON participation_seance (participant_id)');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CE3797A94');
        $this->addSql('DROP INDEX IDX_7CC7DA2CE3797A94 ON video');
        $this->addSql('ALTER TABLE video DROP seance_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE particiation_seance');
        $this->addSql('ALTER TABLE participation_seance DROP FOREIGN KEY FK_A5187B2B9D1C3019');
        $this->addSql('DROP INDEX IDX_A5187B2B9D1C3019 ON participation_seance');
        $this->addSql('ALTER TABLE participation_seance DROP participant_id, CHANGE seance_id seance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video ADD seance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CE3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CE3797A94 ON video (seance_id)');
    }
}
