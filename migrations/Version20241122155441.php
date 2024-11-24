<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241122155441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD report TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D8AF08774');
        $this->addSql('DROP INDEX IDX_5A8A6C8D8AF08774 ON post');
        $this->addSql('ALTER TABLE post DROP post_tag_id');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF0BAD26311');
        $this->addSql('DROP INDEX IDX_5ACE3AF0BAD26311 ON post_tag');
        $this->addSql('ALTER TABLE post_tag DROP tag_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP report');
        $this->addSql('ALTER TABLE post_tag ADD tag_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF0BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5ACE3AF0BAD26311 ON post_tag (tag_id)');
        $this->addSql('ALTER TABLE post ADD post_tag_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D8AF08774 FOREIGN KEY (post_tag_id) REFERENCES post_tag (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D8AF08774 ON post (post_tag_id)');
    }
}
