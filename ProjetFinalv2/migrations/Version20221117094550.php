<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221117094550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, head_id INT NOT NULL, hair_id INT NOT NULL, eyes_id INT NOT NULL, mouth_id INT NOT NULL, nose_id INT NOT NULL, cloth_id INT NOT NULL, skin_id INT NOT NULL, hair_color_id INT NOT NULL, eye_color_id INT NOT NULL, cloth_style_id INT NOT NULL, INDEX IDX_1677722FF41A619E (head_id), INDEX IDX_1677722F2A89600A (hair_id), INDEX IDX_1677722FD9970B58 (eyes_id), INDEX IDX_1677722F631D4FBC (mouth_id), INDEX IDX_1677722F94CDD445 (nose_id), INDEX IDX_1677722FE53266EE (cloth_id), INDEX IDX_1677722FF404637F (skin_id), INDEX IDX_1677722F8345DCB5 (hair_color_id), INDEX IDX_1677722FCB96304E (eye_color_id), INDEX IDX_1677722F114717A6 (cloth_style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar_color (id INT AUTO_INCREMENT NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar_part (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developper (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE games (id INT AUTO_INCREMENT NOT NULL, developper_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cover VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_FF232B31DA42B93 (developper_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, source VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6AE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, avatar_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64986383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FF41A619E FOREIGN KEY (head_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F2A89600A FOREIGN KEY (hair_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FD9970B58 FOREIGN KEY (eyes_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F631D4FBC FOREIGN KEY (mouth_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F94CDD445 FOREIGN KEY (nose_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FE53266EE FOREIGN KEY (cloth_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FF404637F FOREIGN KEY (skin_id) REFERENCES avatar_color (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F8345DCB5 FOREIGN KEY (hair_color_id) REFERENCES avatar_color (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FCB96304E FOREIGN KEY (eye_color_id) REFERENCES avatar_color (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F114717A6 FOREIGN KEY (cloth_style_id) REFERENCES avatar_color (id)');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B31DA42B93 FOREIGN KEY (developper_id) REFERENCES developper (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AE48FD905 FOREIGN KEY (game_id) REFERENCES games (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64986383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FF41A619E');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F2A89600A');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FD9970B58');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F631D4FBC');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F94CDD445');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FE53266EE');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FF404637F');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F8345DCB5');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FCB96304E');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F114717A6');
        $this->addSql('ALTER TABLE games DROP FOREIGN KEY FK_FF232B31DA42B93');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AE48FD905');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64986383B10');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE avatar_color');
        $this->addSql('DROP TABLE avatar_part');
        $this->addSql('DROP TABLE developper');
        $this->addSql('DROP TABLE games');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
