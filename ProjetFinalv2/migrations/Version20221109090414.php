<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109090414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FF404637F');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FF404637F FOREIGN KEY (skin_id) REFERENCES avatar_color (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FF404637F');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FF404637F FOREIGN KEY (skin_id) REFERENCES avatar_part (id)');
    }
}
