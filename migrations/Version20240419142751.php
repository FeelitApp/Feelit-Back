<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240419142751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE results_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE results (id INT NOT NULL, sensation_id_id INT NOT NULL, feeling_id_id INT NOT NULL, emotion_id_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, note VARCHAR(1312) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9FA3E4146789DABE ON results (sensation_id_id)');
        $this->addSql('CREATE INDEX IDX_9FA3E414C4C5A2E8 ON results (feeling_id_id)');
        $this->addSql('CREATE INDEX IDX_9FA3E414F0E7640D ON results (emotion_id_id)');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E4146789DABE FOREIGN KEY (sensation_id_id) REFERENCES sensation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E414C4C5A2E8 FOREIGN KEY (feeling_id_id) REFERENCES feeling (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE results ADD CONSTRAINT FK_9FA3E414F0E7640D FOREIGN KEY (emotion_id_id) REFERENCES emotion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE results_id_seq CASCADE');
        $this->addSql('ALTER TABLE results DROP CONSTRAINT FK_9FA3E4146789DABE');
        $this->addSql('ALTER TABLE results DROP CONSTRAINT FK_9FA3E414C4C5A2E8');
        $this->addSql('ALTER TABLE results DROP CONSTRAINT FK_9FA3E414F0E7640D');
        $this->addSql('DROP TABLE results');
    }
}
