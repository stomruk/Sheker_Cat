<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109085804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, skin_id INT NOT NULL, head_id INT NOT NULL, INDEX IDX_1677722FF404637F (skin_id), INDEX IDX_1677722FF41A619E (head_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar_color (id INT AUTO_INCREMENT NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar_part (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FF404637F FOREIGN KEY (skin_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FF41A619E FOREIGN KEY (head_id) REFERENCES avatar_part (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FF404637F');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FF41A619E');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE avatar_color');
        $this->addSql('DROP TABLE avatar_part');
    }
}
