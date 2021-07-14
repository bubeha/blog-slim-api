<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210714191609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "reset_password_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "reset_password" (id INT NOT NULL, email VARCHAR(180) NOT NULL, token VARCHAR(255) NOT NULL, expires_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B9983CE5E7927C74 ON "reset_password" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B9983CE55F37A13B ON "reset_password" (token)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B9983CE5F9D83E2 ON "reset_password" (expires_at)');
        $this->addSql('COMMENT ON COLUMN "reset_password".expires_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE users ALTER email SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "reset_password_id_seq" CASCADE');
        $this->addSql('DROP TABLE "reset_password"');
        $this->addSql('ALTER TABLE "users" ALTER email DROP NOT NULL');
    }
}
