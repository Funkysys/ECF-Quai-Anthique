<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119175453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE dish CHANGE sub_cat_id sub_cat_id INT DEFAULT NULL');

        $allergns = array('Gluten', 'Peanuts', 'Milk', 'Eggs', 'Nuts', 'Mollusc', 'Seafood', 'Mustard', 'Fish', 'Celery', 'Soy', 'Sulphites', 'Sesame', 'Lupine');
        
        foreach ($allergns as $allergn) {
            $this->addSql('INSERT INTO allergy (name) VALUES (?)', array($allergn));
        }
    }

    public function postUp(Schema $schema): void
    {
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dish CHANGE sub_cat_id sub_cat_id INT NOT NULL');
    }
}
