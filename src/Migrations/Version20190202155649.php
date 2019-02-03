<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190202155649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gallery ADD articles_id INT DEFAULT NULL, ADD blog_id INT DEFAULT NULL, ADD nom VARCHAR(255) NOT NULL, ADD alt VARCHAR(255) NOT NULL, ADD image_size INT NOT NULL');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783ADAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('CREATE INDEX IDX_472B783A1EBAF6CC ON gallery (articles_id)');
        $this->addSql('CREATE INDEX IDX_472B783ADAE07E97 ON gallery (blog_id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4E7AF8F');
        $this->addSql('DROP INDEX IDX_C53D045F4E7AF8F ON image');
        $this->addSql('ALTER TABLE image DROP gallery_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783A1EBAF6CC');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783ADAE07E97');
        $this->addSql('DROP INDEX IDX_472B783A1EBAF6CC ON gallery');
        $this->addSql('DROP INDEX IDX_472B783ADAE07E97 ON gallery');
        $this->addSql('ALTER TABLE gallery DROP articles_id, DROP blog_id, DROP nom, DROP alt, DROP image_size');
        $this->addSql('ALTER TABLE image ADD gallery_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F4E7AF8F ON image (gallery_id)');
    }
}
