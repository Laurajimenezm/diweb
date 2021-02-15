<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210206105827 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedido ADD compra_id INT NOT NULL');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CEF2E704D7 FOREIGN KEY (compra_id) REFERENCES compra (id)');
        $this->addSql('CREATE INDEX IDX_C4EC16CEF2E704D7 ON pedido (compra_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CEF2E704D7');
        $this->addSql('DROP INDEX IDX_C4EC16CEF2E704D7 ON pedido');
        $this->addSql('ALTER TABLE pedido DROP compra_id');
    }
}
