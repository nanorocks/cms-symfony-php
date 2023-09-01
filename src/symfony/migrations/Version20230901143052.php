<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230901143052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, image_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_64C19C1727ACA70 (parent_id), UNIQUE INDEX UNIQ_64C19C13DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, content_item_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9474526CCD678BED (content_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_user (comment_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_ABA574A5F8697D13 (comment_id), INDEX IDX_ABA574A5A76ED395 (user_id), PRIMARY KEY(comment_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_item (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, excerpt LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, published TINYINT(1) NOT NULL, published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', video_url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D279C8DBF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_item_category (content_item_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_319BF71BCD678BED (content_item_id), INDEX IDX_319BF71B12469DE2 (category_id), PRIMARY KEY(content_item_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_item_media (content_item_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_D9B20C2ECD678BED (content_item_id), INDEX IDX_D9B20C2EEA9FDD75 (media_id), PRIMARY KEY(content_item_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_item_tag (content_item_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_B62B265ECD678BED (content_item_id), INDEX IDX_B62B265EBAD26311 (tag_id), PRIMARY KEY(content_item_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, size VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_389B7835E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, username VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C13DA5256D FOREIGN KEY (image_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CCD678BED FOREIGN KEY (content_item_id) REFERENCES content_item (id)');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_user ADD CONSTRAINT FK_ABA574A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_item ADD CONSTRAINT FK_D279C8DBF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE content_item_category ADD CONSTRAINT FK_319BF71BCD678BED FOREIGN KEY (content_item_id) REFERENCES content_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_item_category ADD CONSTRAINT FK_319BF71B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_item_media ADD CONSTRAINT FK_D9B20C2ECD678BED FOREIGN KEY (content_item_id) REFERENCES content_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_item_media ADD CONSTRAINT FK_D9B20C2EEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_item_tag ADD CONSTRAINT FK_B62B265ECD678BED FOREIGN KEY (content_item_id) REFERENCES content_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_item_tag ADD CONSTRAINT FK_B62B265EBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C13DA5256D');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CCD678BED');
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5F8697D13');
        $this->addSql('ALTER TABLE comment_user DROP FOREIGN KEY FK_ABA574A5A76ED395');
        $this->addSql('ALTER TABLE content_item DROP FOREIGN KEY FK_D279C8DBF675F31B');
        $this->addSql('ALTER TABLE content_item_category DROP FOREIGN KEY FK_319BF71BCD678BED');
        $this->addSql('ALTER TABLE content_item_category DROP FOREIGN KEY FK_319BF71B12469DE2');
        $this->addSql('ALTER TABLE content_item_media DROP FOREIGN KEY FK_D9B20C2ECD678BED');
        $this->addSql('ALTER TABLE content_item_media DROP FOREIGN KEY FK_D9B20C2EEA9FDD75');
        $this->addSql('ALTER TABLE content_item_tag DROP FOREIGN KEY FK_B62B265ECD678BED');
        $this->addSql('ALTER TABLE content_item_tag DROP FOREIGN KEY FK_B62B265EBAD26311');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE comment_user');
        $this->addSql('DROP TABLE content_item');
        $this->addSql('DROP TABLE content_item_category');
        $this->addSql('DROP TABLE content_item_media');
        $this->addSql('DROP TABLE content_item_tag');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user');
    }
}
