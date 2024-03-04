<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240302195942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mercado (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, valor NUMERIC(20, 0) NOT NULL, estado TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_mercado ADD mercado_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item_mercado ADD CONSTRAINT FK_1B61D2D9D01315CD FOREIGN KEY (mercado_id) REFERENCES mercado (id)');
        $this->addSql('CREATE INDEX IDX_1B61D2D9D01315CD ON item_mercado (mercado_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_mercado DROP FOREIGN KEY FK_1B61D2D9D01315CD');
        $this->addSql('DROP TABLE mercado');
        $this->addSql('DROP INDEX IDX_1B61D2D9D01315CD ON item_mercado');
        $this->addSql('ALTER TABLE item_mercado DROP mercado_id');
    }
}
