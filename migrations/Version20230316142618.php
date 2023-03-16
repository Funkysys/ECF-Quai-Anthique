<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316142618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_formulas DROP FOREIGN KEY FK_AD870873CCD7E912');
        $this->addSql('ALTER TABLE menu_formulas DROP FOREIGN KEY FK_AD870873E30F9153');
        $this->addSql('DROP TABLE menu_formulas');
        $this->addSql('DROP TABLE menu');
        $this->addSql('ALTER TABLE formulas ADD price INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_formulas (menu_id INT NOT NULL, formulas_id INT NOT NULL, INDEX IDX_AD870873CCD7E912 (menu_id), INDEX IDX_AD870873E30F9153 (formulas_id), PRIMARY KEY(menu_id, formulas_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu_formulas ADD CONSTRAINT FK_AD870873CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE menu_formulas ADD CONSTRAINT FK_AD870873E30F9153 FOREIGN KEY (formulas_id) REFERENCES formulas (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formulas DROP price');
    }
}
