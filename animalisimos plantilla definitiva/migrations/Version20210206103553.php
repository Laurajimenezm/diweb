<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210206103553 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE raza ADD gatoperro_id INT NOT NULL');
        $this->addSql('ALTER TABLE raza ADD CONSTRAINT FK_4602D6AE805E7747 FOREIGN KEY (gatoperro_id) REFERENCES gatoperro (id)');
        $this->addSql('CREATE INDEX IDX_4602D6AE805E7747 ON raza (gatoperro_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE raza DROP FOREIGN KEY FK_4602D6AE805E7747');
        $this->addSql('DROP INDEX IDX_4602D6AE805E7747 ON raza');
        $this->addSql('ALTER TABLE raza DROP gatoperro_id');
    }
}
