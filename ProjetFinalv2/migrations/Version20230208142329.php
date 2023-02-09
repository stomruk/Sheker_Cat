<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208142329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE code_promo (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, discount INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE code_promo_games (code_promo_id INT NOT NULL, games_id INT NOT NULL, INDEX IDX_5F4BFE17294102D4 (code_promo_id), INDEX IDX_5F4BFE1797FFC673 (games_id), PRIMARY KEY(code_promo_id, games_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE code_promo_games ADD CONSTRAINT FK_5F4BFE17294102D4 FOREIGN KEY (code_promo_id) REFERENCES code_promo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE code_promo_games ADD CONSTRAINT FK_5F4BFE1797FFC673 FOREIGN KEY (games_id) REFERENCES games (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE code_promo_games DROP FOREIGN KEY FK_5F4BFE17294102D4');
        $this->addSql('ALTER TABLE code_promo_games DROP FOREIGN KEY FK_5F4BFE1797FFC673');
        $this->addSql('DROP TABLE code_promo');
        $this->addSql('DROP TABLE code_promo_games');
    }
}
