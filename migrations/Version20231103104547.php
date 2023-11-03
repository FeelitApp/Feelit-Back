<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103104547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE need_feeling DROP CONSTRAINT fk_dea1a838624af264');
        $this->addSql('ALTER TABLE need_feeling DROP CONSTRAINT fk_dea1a838cb9214c2');
        $this->addSql('DROP TABLE need_feeling');
        $this->addSql('ALTER TABLE emotion DROP CONSTRAINT fk_debc776e189415');
        $this->addSql('DROP INDEX idx_debc776e189415');
        $this->addSql('ALTER TABLE emotion RENAME COLUMN id_feeling_id TO feeling_id');
        $this->addSql('ALTER TABLE emotion ADD CONSTRAINT FK_DEBC77CB9214C2 FOREIGN KEY (feeling_id) REFERENCES feeling (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DEBC77CB9214C2 ON emotion (feeling_id)');
        $this->addSql('ALTER TABLE sensation DROP CONSTRAINT fk_ae75af186e189415');
        $this->addSql('DROP INDEX idx_ae75af186e189415');
        $this->addSql('ALTER TABLE sensation RENAME COLUMN id_feeling_id TO feeling_id');
        $this->addSql('ALTER TABLE sensation ADD CONSTRAINT FK_AE75AF18CB9214C2 FOREIGN KEY (feeling_id) REFERENCES feeling (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AE75AF18CB9214C2 ON sensation (feeling_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE need_feeling (need_id INT NOT NULL, feeling_id INT NOT NULL, PRIMARY KEY(need_id, feeling_id))');
        $this->addSql('CREATE INDEX idx_dea1a838cb9214c2 ON need_feeling (feeling_id)');
        $this->addSql('CREATE INDEX idx_dea1a838624af264 ON need_feeling (need_id)');
        $this->addSql('ALTER TABLE need_feeling ADD CONSTRAINT fk_dea1a838624af264 FOREIGN KEY (need_id) REFERENCES need (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling ADD CONSTRAINT fk_dea1a838cb9214c2 FOREIGN KEY (feeling_id) REFERENCES feeling (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sensation DROP CONSTRAINT FK_AE75AF18CB9214C2');
        $this->addSql('DROP INDEX IDX_AE75AF18CB9214C2');
        $this->addSql('ALTER TABLE sensation RENAME COLUMN feeling_id TO id_feeling_id');
        $this->addSql('ALTER TABLE sensation ADD CONSTRAINT fk_ae75af186e189415 FOREIGN KEY (id_feeling_id) REFERENCES feeling (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_ae75af186e189415 ON sensation (id_feeling_id)');
        $this->addSql('ALTER TABLE emotion DROP CONSTRAINT FK_DEBC77CB9214C2');
        $this->addSql('DROP INDEX IDX_DEBC77CB9214C2');
        $this->addSql('ALTER TABLE emotion RENAME COLUMN feeling_id TO id_feeling_id');
        $this->addSql('ALTER TABLE emotion ADD CONSTRAINT fk_debc776e189415 FOREIGN KEY (id_feeling_id) REFERENCES feeling (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_debc776e189415 ON emotion (id_feeling_id)');
    }
}
