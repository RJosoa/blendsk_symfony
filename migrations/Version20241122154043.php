<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241122154043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favourite ADD user_id INT NOT NULL, ADD post_id INT NOT NULL');
        $this->addSql('ALTER TABLE favourite ADD CONSTRAINT FK_62A2CA19A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favourite ADD CONSTRAINT FK_62A2CA194B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_62A2CA19A76ED395 ON favourite (user_id)');
        $this->addSql('CREATE INDEX IDX_62A2CA194B89032C ON favourite (post_id)');
        $this->addSql('ALTER TABLE `like` ADD user_id INT NOT NULL, ADD post_id INT NOT NULL');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B34B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_AC6340B3A76ED395 ON `like` (user_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B34B89032C ON `like` (post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3A76ED395');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B34B89032C');
        $this->addSql('DROP INDEX IDX_AC6340B3A76ED395 ON `like`');
        $this->addSql('DROP INDEX IDX_AC6340B34B89032C ON `like`');
        $this->addSql('ALTER TABLE `like` DROP user_id, DROP post_id');
        $this->addSql('ALTER TABLE favourite DROP FOREIGN KEY FK_62A2CA19A76ED395');
        $this->addSql('ALTER TABLE favourite DROP FOREIGN KEY FK_62A2CA194B89032C');
        $this->addSql('DROP INDEX IDX_62A2CA19A76ED395 ON favourite');
        $this->addSql('DROP INDEX IDX_62A2CA194B89032C ON favourite');
        $this->addSql('ALTER TABLE favourite DROP user_id, DROP post_id');
    }
}
