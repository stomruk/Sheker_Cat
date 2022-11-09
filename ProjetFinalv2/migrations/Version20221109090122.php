<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109090122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar ADD hair_id INT NOT NULL');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F2A89600A FOREIGN KEY (hair_id) REFERENCES avatar_part (id)');
        $this->addSql('CREATE INDEX IDX_1677722F2A89600A ON avatar (hair_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F2A89600A');
        $this->addSql('DROP INDEX IDX_1677722F2A89600A ON avatar');
        $this->addSql('ALTER TABLE avatar DROP hair_id');
    }
}
