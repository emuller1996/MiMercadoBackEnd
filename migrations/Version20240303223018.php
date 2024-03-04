<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303223018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_mercado (id INT AUTO_INCREMENT NOT NULL, mercado_id INT DEFAULT NULL, cantidad INT NOT NULL, unidad VARCHAR(255) NOT NULL, INDEX IDX_1B61D2D9D01315CD (mercado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_mercado_item (item_mercado_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_AAA553B26DA23DC7 (item_mercado_id), INDEX IDX_AAA553B2126F525E (item_id), PRIMARY KEY(item_mercado_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mercado (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, valor NUMERIC(20, 0) NOT NULL, estado TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedidos (id INT AUTO_INCREMENT NOT NULL, fecha DATE DEFAULT NULL, estado VARCHAR(255) DEFAULT NULL, valor NUMERIC(20, 0) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pedidos_mercado (pedidos_id INT NOT NULL, mercado_id INT NOT NULL, INDEX IDX_AAD95190213530F2 (pedidos_id), INDEX IDX_AAD95190D01315CD (mercado_id), PRIMARY KEY(pedidos_id, mercado_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_mercado ADD CONSTRAINT FK_1B61D2D9D01315CD FOREIGN KEY (mercado_id) REFERENCES mercado (id)');
        $this->addSql('ALTER TABLE item_mercado_item ADD CONSTRAINT FK_AAA553B26DA23DC7 FOREIGN KEY (item_mercado_id) REFERENCES item_mercado (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_mercado_item ADD CONSTRAINT FK_AAA553B2126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pedidos_mercado ADD CONSTRAINT FK_AAD95190213530F2 FOREIGN KEY (pedidos_id) REFERENCES pedidos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pedidos_mercado ADD CONSTRAINT FK_AAD95190D01315CD FOREIGN KEY (mercado_id) REFERENCES mercado (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_mercado DROP FOREIGN KEY FK_1B61D2D9D01315CD');
        $this->addSql('ALTER TABLE item_mercado_item DROP FOREIGN KEY FK_AAA553B26DA23DC7');
        $this->addSql('ALTER TABLE item_mercado_item DROP FOREIGN KEY FK_AAA553B2126F525E');
        $this->addSql('ALTER TABLE pedidos_mercado DROP FOREIGN KEY FK_AAD95190213530F2');
        $this->addSql('ALTER TABLE pedidos_mercado DROP FOREIGN KEY FK_AAD95190D01315CD');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_mercado');
        $this->addSql('DROP TABLE item_mercado_item');
        $this->addSql('DROP TABLE mercado');
        $this->addSql('DROP TABLE pedidos');
        $this->addSql('DROP TABLE pedidos_mercado');
    }
}
