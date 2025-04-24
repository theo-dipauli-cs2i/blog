<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424125945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP SEQUENCE comment_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE blog.comments (id SERIAL NOT NULL, post_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, content TEXT NOT NULL, comment_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, status INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_CC1B659B4B89032C ON blog.comments (post_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE blog.comments ADD CONSTRAINT FK_CC1B659B4B89032C FOREIGN KEY (post_id) REFERENCES blog.posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment DROP CONSTRAINT fk_9474526c4b89032c
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE comment
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SCHEMA post
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE comment (id SERIAL NOT NULL, post_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, content TEXT NOT NULL, comment_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, status INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_9474526c4b89032c ON comment (post_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE comment ADD CONSTRAINT fk_9474526c4b89032c FOREIGN KEY (post_id) REFERENCES blog.posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE blog.comments DROP CONSTRAINT FK_CC1B659B4B89032C
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE blog.comments
        SQL);
    }
}
