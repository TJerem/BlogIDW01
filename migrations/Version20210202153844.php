<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210202153844 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(80) NOT NULL, content LONGTEXT DEFAULT NULL, published_at DATETIME NOT NULL, created_at DATETIME NOT NULL, picture VARCHAR(255) DEFAULT NULL, valid TINYINT(1) DEFAULT NULL, INDEX IDX_23A0E66A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_has_category (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, category_id INT DEFAULT NULL, INDEX IDX_C46694647294869C (article_id), INDEX IDX_C466946412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(80) NOT NULL, picture VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, valid TINYINT(1) DEFAULT NULL, parent INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, response_to_id INT DEFAULT NULL, pseudo VARCHAR(45) NOT NULL, email VARCHAR(45) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, valid TINYINT(1) NOT NULL, INDEX IDX_9474526C7294869C (article_id), INDEX IDX_9474526C20439135 (response_to_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(45) NOT NULL, firstname VARCHAR(80) NOT NULL, lastname VARCHAR(80) NOT NULL, avatar VARCHAR(45) DEFAULT NULL, valid TINYINT(1) DEFAULT NULL, birthday DATETIME DEFAULT NULL, role VARCHAR(45) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article_has_category ADD CONSTRAINT FK_C46694647294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_has_category ADD CONSTRAINT FK_C466946412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C20439135 FOREIGN KEY (response_to_id) REFERENCES comment (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_has_category DROP FOREIGN KEY FK_C46694647294869C');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C');
        $this->addSql('ALTER TABLE article_has_category DROP FOREIGN KEY FK_C466946412469DE2');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C20439135');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_has_category');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE user');
    }
}
