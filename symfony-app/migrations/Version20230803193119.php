<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230803193119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE developer (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, ide_environments VARCHAR(255) DEFAULT NULL, programming_languages VARCHAR(255) DEFAULT NULL, mysql_knowledge TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_65FB8B9A9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_manager (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, project_management_methods VARCHAR(255) DEFAULT NULL, report_systems VARCHAR(255) DEFAULT NULL, scrum_knowledge TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_6C3A29DC9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tester (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, testing_systems VARCHAR(255) DEFAULT NULL, report_systems VARCHAR(255) DEFAULT NULL, selenium_knowledge TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_FC5056459D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, describe_user VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE developer ADD CONSTRAINT FK_65FB8B9A9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project_manager ADD CONSTRAINT FK_6C3A29DC9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tester ADD CONSTRAINT FK_FC5056459D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE developer DROP FOREIGN KEY FK_65FB8B9A9D86650F');
        $this->addSql('ALTER TABLE project_manager DROP FOREIGN KEY FK_6C3A29DC9D86650F');
        $this->addSql('ALTER TABLE tester DROP FOREIGN KEY FK_FC5056459D86650F');
        $this->addSql('DROP TABLE developer');
        $this->addSql('DROP TABLE project_manager');
        $this->addSql('DROP TABLE tester');
        $this->addSql('DROP TABLE user');
    }
}
