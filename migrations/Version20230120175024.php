<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120175024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE opening_hours (id INT AUTO_INCREMENT NOT NULL, day_id INT NOT NULL, opening_hours_id INT DEFAULT NULL, open_minutes_id INT DEFAULT NULL, close_hours_id INT DEFAULT NULL, close_minutes_id INT DEFAULT NULL, open TINYINT(1) NOT NULL, INDEX IDX_2640C10B9C24126 (day_id), INDEX IDX_2640C10BCE298D68 (opening_hours_id), INDEX IDX_2640C10B9CF098E5 (open_minutes_id), INDEX IDX_2640C10B54EA8D07 (close_hours_id), INDEX IDX_2640C10BF33AD6C8 (close_minutes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE opening_hours ADD CONSTRAINT FK_2640C10B9C24126 FOREIGN KEY (day_id) REFERENCES days (id)');
        $this->addSql('ALTER TABLE opening_hours ADD CONSTRAINT FK_2640C10BCE298D68 FOREIGN KEY (opening_hours_id) REFERENCES hours (id)');
        $this->addSql('ALTER TABLE opening_hours ADD CONSTRAINT FK_2640C10B9CF098E5 FOREIGN KEY (open_minutes_id) REFERENCES minutes (id)');
        $this->addSql('ALTER TABLE opening_hours ADD CONSTRAINT FK_2640C10B54EA8D07 FOREIGN KEY (close_hours_id) REFERENCES hours (id)');
        $this->addSql('ALTER TABLE opening_hours ADD CONSTRAINT FK_2640C10BF33AD6C8 FOREIGN KEY (close_minutes_id) REFERENCES minutes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opening_hours DROP FOREIGN KEY FK_2640C10B9C24126');
        $this->addSql('ALTER TABLE opening_hours DROP FOREIGN KEY FK_2640C10BCE298D68');
        $this->addSql('ALTER TABLE opening_hours DROP FOREIGN KEY FK_2640C10B9CF098E5');
        $this->addSql('ALTER TABLE opening_hours DROP FOREIGN KEY FK_2640C10B54EA8D07');
        $this->addSql('ALTER TABLE opening_hours DROP FOREIGN KEY FK_2640C10BF33AD6C8');
        $this->addSql('DROP TABLE opening_hours');
    }
}
