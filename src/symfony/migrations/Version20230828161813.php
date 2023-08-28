<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230828161813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE content_item_media (content_item_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_D9B20C2ECD678BED (content_item_id), INDEX IDX_D9B20C2EEA9FDD75 (media_id), PRIMARY KEY(content_item_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content_item_media ADD CONSTRAINT FK_D9B20C2ECD678BED FOREIGN KEY (content_item_id) REFERENCES content_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_item_media ADD CONSTRAINT FK_D9B20C2EEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_item DROP image, CHANGE content content LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD avatar VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content_item_media DROP FOREIGN KEY FK_D9B20C2ECD678BED');
        $this->addSql('ALTER TABLE content_item_media DROP FOREIGN KEY FK_D9B20C2EEA9FDD75');
        $this->addSql('DROP TABLE content_item_media');
        $this->addSql('ALTER TABLE content_item ADD image LONGTEXT DEFAULT NULL, CHANGE content content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user DROP avatar');
    }
}
