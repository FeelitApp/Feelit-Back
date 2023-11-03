<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103110255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE need_feeling_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE need_feeling (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE need_feeling_feeling (need_feeling_id INT NOT NULL, feeling_id INT NOT NULL, PRIMARY KEY(need_feeling_id, feeling_id))');
        $this->addSql('CREATE INDEX IDX_D01EFD7C8B36D459 ON need_feeling_feeling (need_feeling_id)');
        $this->addSql('CREATE INDEX IDX_D01EFD7CCB9214C2 ON need_feeling_feeling (feeling_id)');
        $this->addSql('CREATE TABLE need_feeling_need (need_feeling_id INT NOT NULL, need_id INT NOT NULL, PRIMARY KEY(need_feeling_id, need_id))');
        $this->addSql('CREATE INDEX IDX_655E01348B36D459 ON need_feeling_need (need_feeling_id)');
        $this->addSql('CREATE INDEX IDX_655E0134624AF264 ON need_feeling_need (need_id)');
        $this->addSql('ALTER TABLE need_feeling_feeling ADD CONSTRAINT FK_D01EFD7C8B36D459 FOREIGN KEY (need_feeling_id) REFERENCES need_feeling (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling_feeling ADD CONSTRAINT FK_D01EFD7CCB9214C2 FOREIGN KEY (feeling_id) REFERENCES feeling (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling_need ADD CONSTRAINT FK_655E01348B36D459 FOREIGN KEY (need_feeling_id) REFERENCES need_feeling (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling_need ADD CONSTRAINT FK_655E0134624AF264 FOREIGN KEY (need_id) REFERENCES need (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE need_feeling_id_seq CASCADE');
        $this->addSql('ALTER TABLE need_feeling_feeling DROP CONSTRAINT FK_D01EFD7C8B36D459');
        $this->addSql('ALTER TABLE need_feeling_feeling DROP CONSTRAINT FK_D01EFD7CCB9214C2');
        $this->addSql('ALTER TABLE need_feeling_need DROP CONSTRAINT FK_655E01348B36D459');
        $this->addSql('ALTER TABLE need_feeling_need DROP CONSTRAINT FK_655E0134624AF264');
        $this->addSql('DROP TABLE need_feeling');
        $this->addSql('DROP TABLE need_feeling_feeling');
        $this->addSql('DROP TABLE need_feeling_need');
    }
}
