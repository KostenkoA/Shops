<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180731113823 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE main_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO main_category (name) VALUES
(\'Digital Cameras\'),
(\'Phones\'),
(\'Tablet\'),
(\'NoteBook\'),
(\'Other\')');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(150) NOT NULL, price DOUBLE PRECISION NOT NULL, comment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO `product` (`type_id`, `name`, `price`, `comment`) VALUES
(2, \'HTC\', 1200, \'HTC Aspire\'),
(3, \'tablet Asus\', 5000, \'tablet Asus for users\'),
(5, \'Phillips\', 17000, \'TV Phillips 12000 \'),
(1, \'Sony\', 750, \'Sony DSC-W830 Digital Camera\'),
(1, \'Nikon\', 1250, \'Refurbished Nikon COOLPIX A900 \'),
(4, \'Acer\', 12000, \'Acer Aspire 3-000\'),
(5, \'All\', 1200, \'All tovars\'),
(4, \'Macbook\', 2300, \'Mac book PRO  \'),
(2, \'Iphone 5s\', 2500, \'Iphone 5s\'),
(5, \'HP\', 2300, \'HP is the best solution for you\'),
(4, \'MacBook Pro\', 3000, \'MacBook Pro \r\nExcellent choice\'),
(5, \'iMac\', 4500, \'iMac - very nice\'),
(5, \'Watch\', 340, \'Apple watch very nice\'),
(2, \'Samsung\', 1500, \'Galaxy S9\')');
        $this->addSql('CREATE TABLE product_image (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO product_image (product_id, image_path) VALUES
(4, \'images/Camera_sony.jpg\'),
(5, \'images/Camera_Nikon.png\'),
(1, \'images/Phone_htc.jpg\'),
(2, \'images/Tablet_asus.png\'),
(3, \'images/TV_Phillips.jpg\'),
(6, \'images/Acer.jpeg\'),
(7, \'uploads/images/clothe.jpg\'),
(8, \'uploads/images/30026842b.jpg\'),
(9, \'uploads/images/iphone-5s.jpg\'),
(10, \'uploads/images/HP8000.png\'),
(11, \'uploads/images/339392-apple-macbook-pro-15-inch-2013.jpg\'),
(12, \'uploads/images/apple-imac-27-core-i5-3-1ghz-mc814rs-a.jpg\'),
(13, \'uploads/images/42-alu-silver-sport-white-s1-grid.jpg\'),
(13, \'uploads/images/Best-Apple-Watch-apps-have-your-Watch-achieve-its-full-potential.jpg\'),
(13, \'uploads/images/X-Doria_Defense_Edge_Apple_Watch__RoseGold_Lavender_Hero.jpg\'),
(14, \'uploads/images/0914-GI-GS9-PDP-Front-Blue.jpg\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE main_category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_image');
    }
}
