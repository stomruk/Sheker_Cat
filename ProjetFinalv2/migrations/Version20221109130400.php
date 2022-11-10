<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109130400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar ADD eyes_id INT NOT NULL, ADD mouth_id INT NOT NULL, ADD nose_id INT NOT NULL, ADD cloth_id INT NOT NULL, ADD hair_color_id INT NOT NULL, ADD eye_color_id INT NOT NULL, ADD cloth_style_id INT NOT NULL');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FD9970B58 FOREIGN KEY (eyes_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F631D4FBC FOREIGN KEY (mouth_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F94CDD445 FOREIGN KEY (nose_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FE53266EE FOREIGN KEY (cloth_id) REFERENCES avatar_part (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F8345DCB5 FOREIGN KEY (hair_color_id) REFERENCES avatar_color (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722FCB96304E FOREIGN KEY (eye_color_id) REFERENCES avatar_color (id)');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F114717A6 FOREIGN KEY (cloth_style_id) REFERENCES avatar_color (id)');
        $this->addSql('CREATE INDEX IDX_1677722FD9970B58 ON avatar (eyes_id)');
        $this->addSql('CREATE INDEX IDX_1677722F631D4FBC ON avatar (mouth_id)');
        $this->addSql('CREATE INDEX IDX_1677722F94CDD445 ON avatar (nose_id)');
        $this->addSql('CREATE INDEX IDX_1677722FE53266EE ON avatar (cloth_id)');
        $this->addSql('CREATE INDEX IDX_1677722F8345DCB5 ON avatar (hair_color_id)');
        $this->addSql('CREATE INDEX IDX_1677722FCB96304E ON avatar (eye_color_id)');
        $this->addSql('CREATE INDEX IDX_1677722F114717A6 ON avatar (cloth_style_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FD9970B58');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F631D4FBC');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F94CDD445');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FE53266EE');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F8345DCB5');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722FCB96304E');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F114717A6');
        $this->addSql('DROP INDEX IDX_1677722FD9970B58 ON avatar');
        $this->addSql('DROP INDEX IDX_1677722F631D4FBC ON avatar');
        $this->addSql('DROP INDEX IDX_1677722F94CDD445 ON avatar');
        $this->addSql('DROP INDEX IDX_1677722FE53266EE ON avatar');
        $this->addSql('DROP INDEX IDX_1677722F8345DCB5 ON avatar');
        $this->addSql('DROP INDEX IDX_1677722FCB96304E ON avatar');
        $this->addSql('DROP INDEX IDX_1677722F114717A6 ON avatar');
        $this->addSql('ALTER TABLE avatar DROP eyes_id, DROP mouth_id, DROP nose_id, DROP cloth_id, DROP hair_color_id, DROP eye_color_id, DROP cloth_style_id');
    }
}
