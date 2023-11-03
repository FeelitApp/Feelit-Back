<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103110416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE need_feeling_id_seq CASCADE');
        $this->addSql('ALTER TABLE need_feeling_feeling DROP CONSTRAINT fk_d01efd7c8b36d459');
        $this->addSql('ALTER TABLE need_feeling_feeling DROP CONSTRAINT fk_d01efd7ccb9214c2');
        $this->addSql('ALTER TABLE need_feeling_need DROP CONSTRAINT fk_655e01348b36d459');
        $this->addSql('ALTER TABLE need_feeling_need DROP CONSTRAINT fk_655e0134624af264');
        $this->addSql('DROP TABLE need_feeling_feeling');
        $this->addSql('DROP TABLE need_feeling_need');
        $this->addSql('ALTER TABLE need_feeling DROP CONSTRAINT need_feeling_pkey');
        $this->addSql('ALTER TABLE need_feeling ADD feeling_id INT NOT NULL');
        $this->addSql('ALTER TABLE need_feeling RENAME COLUMN id TO need_id');
        $this->addSql('ALTER TABLE need_feeling ADD CONSTRAINT FK_DEA1A838624AF264 FOREIGN KEY (need_id) REFERENCES need (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling ADD CONSTRAINT FK_DEA1A838CB9214C2 FOREIGN KEY (feeling_id) REFERENCES feeling (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DEA1A838624AF264 ON need_feeling (need_id)');
        $this->addSql('CREATE INDEX IDX_DEA1A838CB9214C2 ON need_feeling (feeling_id)');
        $this->addSql('ALTER TABLE need_feeling ADD PRIMARY KEY (need_id, feeling_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE need_feeling_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE need_feeling_feeling (need_feeling_id INT NOT NULL, feeling_id INT NOT NULL, PRIMARY KEY(need_feeling_id, feeling_id))');
        $this->addSql('CREATE INDEX idx_d01efd7ccb9214c2 ON need_feeling_feeling (feeling_id)');
        $this->addSql('CREATE INDEX idx_d01efd7c8b36d459 ON need_feeling_feeling (need_feeling_id)');
        $this->addSql('CREATE TABLE need_feeling_need (need_feeling_id INT NOT NULL, need_id INT NOT NULL, PRIMARY KEY(need_feeling_id, need_id))');
        $this->addSql('CREATE INDEX idx_655e0134624af264 ON need_feeling_need (need_id)');
        $this->addSql('CREATE INDEX idx_655e01348b36d459 ON need_feeling_need (need_feeling_id)');
        $this->addSql('ALTER TABLE need_feeling_feeling ADD CONSTRAINT fk_d01efd7c8b36d459 FOREIGN KEY (need_feeling_id) REFERENCES need_feeling (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling_feeling ADD CONSTRAINT fk_d01efd7ccb9214c2 FOREIGN KEY (feeling_id) REFERENCES feeling (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling_need ADD CONSTRAINT fk_655e01348b36d459 FOREIGN KEY (need_feeling_id) REFERENCES need_feeling (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling_need ADD CONSTRAINT fk_655e0134624af264 FOREIGN KEY (need_id) REFERENCES need (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling DROP CONSTRAINT FK_DEA1A838624AF264');
        $this->addSql('ALTER TABLE need_feeling DROP CONSTRAINT FK_DEA1A838CB9214C2');
        $this->addSql('DROP INDEX IDX_DEA1A838624AF264');
        $this->addSql('DROP INDEX IDX_DEA1A838CB9214C2');
        $this->addSql('DROP INDEX need_feeling_pkey');
        $this->addSql('ALTER TABLE need_feeling ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE need_feeling DROP need_id');
        $this->addSql('ALTER TABLE need_feeling DROP feeling_id');
        $this->addSql('ALTER TABLE need_feeling ADD PRIMARY KEY (id)');
    }
}
