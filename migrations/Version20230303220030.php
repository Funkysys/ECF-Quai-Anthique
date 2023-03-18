<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230303220030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        
        $allergns = array('Gluten', 'Arachide', 'Lait', 'Oeufs', 'Fruits à coque', 'Mollusques', 'Fruits de mer', 'Moutarde', 'Poisson', 'Céleri', 'Soja', 'Sulfites', 'Sésame', 'Lupin');
        foreach ($allergns as $allergn) {
            $this->addSql('INSERT INTO allergy (name) VALUES (?)', array($allergn));
        }

        $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        foreach ($days as $day) {
            $this->addSql('INSERT INTO days (day) VALUES (?)', array($day));
        }

        $hours = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24);
        foreach ($hours as $hour) {
            $this->addSql('INSERT INTO hours (hour) VALUES (?)', array($hour));
        }

        $minutes = array(0, 15, 30, 45);

        foreach ($minutes as $minute) {
            $this->addSql('INSERT INTO minutes (minutes) VALUES (?)', array($minute));
        }

        $categories = array('Entrées', 'Plats', 'Désserts', 'Boissons');

        foreach ($categories as $category) {
            $this->addSql('INSERT INTO category (title) VALUES (?)', array($category));
        }

        $this->addSql('INSERT INTO restaurant (capacity) VALUES 50');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE reset_password_request');
    }
}
