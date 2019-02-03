<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190202151856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31683DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD31683DA5256D ON articles (image_id)');
        $this->addSql('ALTER TABLE blog ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C01551433DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C01551433DA5256D ON blog (image_id)');
        $this->addSql('ALTER TABLE image ADD gallery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F4E7AF8F ON image (gallery_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4E7AF8F');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31683DA5256D');
        $this->addSql('DROP INDEX UNIQ_BFDD31683DA5256D ON articles');
        $this->addSql('ALTER TABLE articles DROP image_id');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551433DA5256D');
        $this->addSql('DROP INDEX UNIQ_C01551433DA5256D ON blog');
        $this->addSql('ALTER TABLE blog DROP image_id');
        $this->addSql('DROP INDEX IDX_C53D045F4E7AF8F ON image');
        $this->addSql('ALTER TABLE image DROP gallery_id');
    }
}
