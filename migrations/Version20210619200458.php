<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619200458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE services_available_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE services_available (id INT NOT NULL, provider VARCHAR(255) NOT NULL, action VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE services_available_user (services_available_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(services_available_id, user_id))');
        $this->addSql('CREATE INDEX IDX_1CC5862D5BA6CA7C ON services_available_user (services_available_id)');
        $this->addSql('CREATE INDEX IDX_1CC5862DA76ED395 ON services_available_user (user_id)');
        $this->addSql('ALTER TABLE services_available_user ADD CONSTRAINT FK_1CC5862D5BA6CA7C FOREIGN KEY (services_available_id) REFERENCES services_available (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE services_available_user ADD CONSTRAINT FK_1CC5862DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE services_available_user DROP CONSTRAINT FK_1CC5862D5BA6CA7C');
        $this->addSql('DROP SEQUENCE services_available_id_seq CASCADE');
        $this->addSql('DROP TABLE services_available');
        $this->addSql('DROP TABLE services_available_user');
    }
}
