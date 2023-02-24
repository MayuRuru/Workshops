<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222173623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE organizer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start_date INT NOT NULL, description VARCHAR(255) DEFAULT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workshop_organizer (workshop_id INT NOT NULL, organizer_id INT NOT NULL, INDEX IDX_6FEEC6E21FDCE57C (workshop_id), INDEX IDX_6FEEC6E2876C4DDA (organizer_id), PRIMARY KEY(workshop_id, organizer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workshop_organizer ADD CONSTRAINT FK_6FEEC6E21FDCE57C FOREIGN KEY (workshop_id) REFERENCES workshop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE workshop_organizer ADD CONSTRAINT FK_6FEEC6E2876C4DDA FOREIGN KEY (organizer_id) REFERENCES organizer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workshop_organizer DROP FOREIGN KEY FK_6FEEC6E21FDCE57C');
        $this->addSql('ALTER TABLE workshop_organizer DROP FOREIGN KEY FK_6FEEC6E2876C4DDA');
        $this->addSql('DROP TABLE organizer');
        $this->addSql('DROP TABLE workshop');
        $this->addSql('DROP TABLE workshop_organizer');
    }
}
