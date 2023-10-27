<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027093046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE emotion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE need_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sensation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE emotion (id INT NOT NULL, id_feeling_id INT NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DEBC776E189415 ON emotion (id_feeling_id)');
        $this->addSql('CREATE TABLE need (id INT NOT NULL, content VARCHAR(510) NOT NULL, picture VARCHAR(510) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE need_feeling (need_id INT NOT NULL, feeling_id INT NOT NULL, PRIMARY KEY(need_id, feeling_id))');
        $this->addSql('CREATE INDEX IDX_DEA1A838624AF264 ON need_feeling (need_id)');
        $this->addSql('CREATE INDEX IDX_DEA1A838CB9214C2 ON need_feeling (feeling_id)');
        $this->addSql('CREATE TABLE sensation (id INT NOT NULL, id_feeling_id INT NOT NULL, content VARCHAR(510) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AE75AF186E189415 ON sensation (id_feeling_id)');
        $this->addSql('ALTER TABLE emotion ADD CONSTRAINT FK_DEBC776E189415 FOREIGN KEY (id_feeling_id) REFERENCES feeling (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling ADD CONSTRAINT FK_DEA1A838624AF264 FOREIGN KEY (need_id) REFERENCES need (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE need_feeling ADD CONSTRAINT FK_DEA1A838CB9214C2 FOREIGN KEY (feeling_id) REFERENCES feeling (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sensation ADD CONSTRAINT FK_AE75AF186E189415 FOREIGN KEY (id_feeling_id) REFERENCES feeling (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE emotion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE need_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sensation_id_seq CASCADE');
        $this->addSql('ALTER TABLE emotion DROP CONSTRAINT FK_DEBC776E189415');
        $this->addSql('ALTER TABLE need_feeling DROP CONSTRAINT FK_DEA1A838624AF264');
        $this->addSql('ALTER TABLE need_feeling DROP CONSTRAINT FK_DEA1A838CB9214C2');
        $this->addSql('ALTER TABLE sensation DROP CONSTRAINT FK_AE75AF186E189415');
        $this->addSql('DROP TABLE emotion');
        $this->addSql('DROP TABLE need');
        $this->addSql('DROP TABLE need_feeling');
        $this->addSql('DROP TABLE sensation');
    }
}
