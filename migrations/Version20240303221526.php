<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303221526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_mercado_item (item_mercado_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_AAA553B26DA23DC7 (item_mercado_id), INDEX IDX_AAA553B2126F525E (item_id), PRIMARY KEY(item_mercado_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_mercado_item ADD CONSTRAINT FK_AAA553B26DA23DC7 FOREIGN KEY (item_mercado_id) REFERENCES item_mercado (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_mercado_item ADD CONSTRAINT FK_AAA553B2126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_mercado_item DROP FOREIGN KEY FK_AAA553B26DA23DC7');
        $this->addSql('ALTER TABLE item_mercado_item DROP FOREIGN KEY FK_AAA553B2126F525E');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_mercado_item');
    }
}
